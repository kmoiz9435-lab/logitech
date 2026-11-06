<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Models\Industry;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\WhyChooseItem;

class HomeController extends Controller
{
    public function __invoke()
    {
        $categories = ProductCategory::active()
            ->ordered()
            ->withCount(['products' => fn ($query) => $query->where('is_active', true)])
            ->get();

        $featuredProducts = Product::active()
            ->featured()
            ->with('category')
            ->ordered()
            ->take(3)
            ->get();

        $selectedCategory = request('category')
            ? $categories->firstWhere('slug', request('category'))
            : null;

        $products = Product::active()
            ->with('category')
            ->when($selectedCategory, fn ($query) => $query->where('product_category_id', $selectedCategory->id))
            ->ordered()
            ->take(9)
            ->get();

        $industries = Industry::active()->ordered()->get();
        $whyChoose = WhyChooseItem::active()->ordered()->get();
        $gallery = GalleryImage::active()->ordered()->take(8)->get();
        $inquiryProducts = Product::active()->ordered()->get(['id', 'name']);

        return view('home', [
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
            'products' => $products,
            'selectedCategory' => $selectedCategory,
            'industries' => $industries,
            'whyChoose' => $whyChoose,
            'gallery' => $gallery,
            'inquiryProducts' => $inquiryProducts,
            'metaTitle' => \setting('seo_title'),
            'metaDescription' => \setting('seo_description'),
            'metaKeywords' => \setting('seo_keywords'),
        ]);
    }
}
