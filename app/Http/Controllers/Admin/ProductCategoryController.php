<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\ProductCategory;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function __construct(private readonly ImageService $images) {}

    public function index(Request $request)
    {
        $search = trim($request->string('q')->toString());

        $categories = ProductCategory::withCount('products')
            ->when($search !== '', fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->ordered()
            ->paginate(12)
            ->withQueryString();

        return view('admin.categories.index', compact('categories', 'search'));
    }

    public function create()
    {
        return view('admin.categories.create', ['category' => new ProductCategory]);
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->safe()->only(['name', 'slug', 'description', 'is_active', 'sort_order']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->images->storePhoto($request->file('image'), 'categories');
        }

        ProductCategory::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(ProductCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, ProductCategory $category)
    {
        $oldImage = $category->image;
        $data = $request->safe()->only(['name', 'slug', 'description', 'is_active', 'sort_order']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->images->storePhoto($request->file('image'), 'categories');
        }

        $category->update($data);

        if (isset($data['image'])) {
            $this->images->deleteIfUnused($oldImage);
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(ProductCategory $category)
    {
        if ($category->products()->exists()) {
            return back()->with('error', 'This category still contains products. Reassign those products before deleting the category.');
        }

        $image = $category->image;
        $category->delete();
        $this->images->deleteIfUnused($image);

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
