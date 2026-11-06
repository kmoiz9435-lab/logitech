<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = ProductCategory::active()
            ->ordered()
            ->withCount(['products' => fn ($query) => $query->where('is_active', true)])
            ->get();

        $selectedCategory = $request->filled('category')
            ? $categories->firstWhere('slug', $request->string('category')->toString())
            : null;

        $search = trim($request->string('q')->toString());

        $products = Product::active()
            ->with('category')
            ->when($selectedCategory, fn ($query) => $query->where('product_category_id', $selectedCategory->id))
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('short_description', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->ordered()
            ->paginate(9)
            ->withQueryString();

        $metaTitle = $selectedCategory
            ? $selectedCategory->name.' | '.setting('company_name')
            : 'Induction Heating Products | '.setting('company_name');

        $metaDescription = $selectedCategory?->description
            ?: 'Browse induction heating machines, melting furnaces, forging systems, brazing equipment and heat treatment systems.';

        return view('products.index', compact(
            'categories',
            'selectedCategory',
            'products',
            'search',
            'metaTitle',
            'metaDescription'
        ));
    }

    public function show(Product $product)
    {
        $isAdminPreview = ! $product->is_active
            && Auth::check()
            && Auth::user()->is_admin;

        abort_unless($product->is_active || $isAdminPreview, 404);

        $product->load(['category', 'images', 'specifications', 'features', 'applications']);

        $relatedProducts = Product::active()
            ->where('id', '!=', $product->id)
            ->when($product->product_category_id, fn ($query) => $query->where('product_category_id', $product->product_category_id))
            ->with('category')
            ->ordered()
            ->take(3)
            ->get();

        if ($relatedProducts->count() < 3) {
            $relatedProducts = $relatedProducts->merge(
                Product::active()
                    ->where('id', '!=', $product->id)
                    ->whereNotIn('id', $relatedProducts->pluck('id'))
                    ->with('category')
                    ->ordered()
                    ->take(3 - $relatedProducts->count())
                    ->get()
            );
        }

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'metaTitle' => $product->seo_title.' | '.setting('company_name'),
            'metaDescription' => $product->seo_description,
            'metaImage' => $product->image_url,
            'isAdminPreview' => $isAdminPreview,
        ]);
    }
}
