<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\IndustryRequest;
use App\Models\Industry;
use App\Services\ImageService;

class IndustryController extends Controller
{
    public function __construct(private readonly ImageService $images) {}

    public function index()
    {
        $industries = Industry::ordered()->paginate(12);

        return view('admin.industries.index', compact('industries'));
    }

    public function create()
    {
        return view('admin.industries.create', ['industry' => new Industry]);
    }

    public function store(IndustryRequest $request)
    {
        $data = $request->safe()->only(['title', 'description', 'icon', 'is_active', 'sort_order']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->images->storePhoto($request->file('image'), 'industries');
        }

        Industry::create($data);

        return redirect()->route('admin.industries.index')->with('success', 'Industry created successfully.');
    }

    public function edit(Industry $industry)
    {
        return view('admin.industries.edit', compact('industry'));
    }

    public function update(IndustryRequest $request, Industry $industry)
    {
        $oldImage = $industry->image;
        $data = $request->safe()->only(['title', 'description', 'icon', 'is_active', 'sort_order']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->images->storePhoto($request->file('image'), 'industries');
        }

        $industry->update($data);

        if (isset($data['image'])) {
            $this->images->deleteIfUnused($oldImage);
        }

        return redirect()->route('admin.industries.index')->with('success', 'Industry updated successfully.');
    }

    public function destroy(Industry $industry)
    {
        $image = $industry->image;
        $industry->delete();
        $this->images->deleteIfUnused($image);

        return redirect()->route('admin.industries.index')->with('success', 'Industry deleted successfully.');
    }
}
