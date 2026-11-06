<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct(private readonly ImageService $images) {}

    public function index(Request $request)
    {
        $search = trim($request->string('q')->toString());
        $status = $request->string('status')->toString();
        $featured = $request->string('featured')->toString();
        $categoryId = $request->integer('category');

        $products = Product::with('category')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%")
                        ->orWhere('short_description', 'like', "%{$search}%");
                });
            })
            ->when($status === 'active', fn ($query) => $query->where('is_active', true))
            ->when($status === 'inactive', fn ($query) => $query->where('is_active', false))
            ->when($featured === 'yes', fn ($query) => $query->where('is_featured', true))
            ->when($featured === 'no', fn ($query) => $query->where('is_featured', false))
            ->when($categoryId, fn ($query) => $query->where('product_category_id', $categoryId))
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        $categories = ProductCategory::ordered()->get();

        return view('admin.products.index', compact('products', 'categories', 'search', 'status', 'featured', 'categoryId'));
    }

    public function create()
    {
        return view('admin.products.create', [
            'product' => new Product,
            'categories' => ProductCategory::ordered()->get(),
        ]);
    }

    public function store(ProductRequest $request)
    {
        $product = DB::transaction(function () use ($request) {
            $data = $this->productData($request);
            $data['main_image'] = $this->images->storePhoto($request->file('main_image'), 'products');

            $product = Product::create($data);
            $this->storeAdditionalImages($product, $request);
            $this->syncDetails($product, $request);

            return $product;
        });

        return redirect()
            ->route('admin.products.edit', $product)
            ->with('success', 'Product created successfully. It is now visible on the website when active.');
    }

    public function edit(Product $product)
    {
        $product->load(['images', 'specifications', 'features', 'applications']);

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => ProductCategory::ordered()->get(),
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $oldMainImage = $product->main_image;
        $newMainImage = $request->hasFile('main_image')
            ? $this->images->storePhoto($request->file('main_image'), 'products')
            : null;

        DB::transaction(function () use ($request, $product, $newMainImage) {
            $data = $this->productData($request);

            if ($newMainImage) {
                $data['main_image'] = $newMainImage;
            }

            $product->update($data);
            $this->storeAdditionalImages($product, $request);
            $this->syncDetails($product, $request);
        });

        if ($newMainImage) {
            $this->images->deleteIfUnused($oldMainImage);
        }

        return redirect()
            ->route('admin.products.edit', $product)
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $paths = $product->images()->pluck('image')->push($product->main_image)->filter()->all();

        $product->delete();

        foreach ($paths as $path) {
            $this->images->deleteIfUnused($path);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product and its associated images were deleted.');
    }

    public function destroyImage(Product $product, ProductImage $image)
    {
        abort_unless($image->product_id === $product->id, 404);

        $path = $image->image;
        $image->delete();
        $this->images->deleteIfUnused($path);

        return back()->with('success', 'Product image removed.');
    }

    public function toggleActive(Product $product)
    {
        $product->update(['is_active' => ! $product->is_active]);

        return back()->with('success', $product->is_active
            ? 'Product is now active and visible on the website.'
            : 'Product has been set to inactive and hidden from the website.');
    }

    public function toggleFeatured(Product $product)
    {
        $product->update(['is_featured' => ! $product->is_featured]);

        return back()->with('success', $product->is_featured
            ? 'Product added to featured machinery.'
            : 'Product removed from featured machinery.');
    }

    private function productData(ProductRequest $request): array
    {
        return [
            'name' => $request->string('name')->toString(),
            'slug' => $request->string('slug')->toString(),
            'product_category_id' => $request->integer('product_category_id'),
            'short_description' => $request->string('short_description')->toString(),
            'description' => $request->string('description')->toString(),
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active'),
            'seo_meta_title' => $request->input('seo_meta_title'),
            'seo_meta_description' => $request->input('seo_meta_description'),
            'sort_order' => $request->input('sort_order', 0),
        ];
    }

    private function storeAdditionalImages(Product $product, ProductRequest $request): void
    {
        $existingCount = $product->images()->count();

        foreach ($request->file('additional_images', []) as $index => $file) {
            if (! $file || ! $file->isValid()) {
                continue;
            }

            $product->images()->create([
                'image' => $this->images->storePhoto($file, 'products', 1800, 1800),
                'alt_text' => $product->name,
                'sort_order' => $existingCount + $index,
            ]);
        }
    }

    private function syncDetails(Product $product, ProductRequest $request): void
    {
        $product->specifications()->delete();
        $product->features()->delete();
        $product->applications()->delete();

        $labels = (array) $request->input('spec_labels', []);
        $values = (array) $request->input('spec_values', []);

        foreach ($labels as $index => $label) {
            if (! isset($values[$index]) || trim((string) $label) === '' || trim((string) $values[$index]) === '') {
                continue;
            }

            $product->specifications()->create([
                'label' => trim((string) $label),
                'value' => trim((string) $values[$index]),
                'sort_order' => $index,
            ]);
        }

        foreach (array_values((array) $request->input('features', [])) as $index => $feature) {
            $feature = trim((string) $feature);
            if ($feature !== '') {
                $product->features()->create(['title' => Str::limit($feature, 490, ''), 'sort_order' => $index]);
            }
        }

        foreach (array_values((array) $request->input('applications', [])) as $index => $application) {
            $application = trim((string) $application);
            if ($application !== '') {
                $product->applications()->create(['title' => Str::limit($application, 490, ''), 'sort_order' => $index]);
            }
        }
    }
}
