<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Models\GalleryImage;
use App\Services\ImageService;

class GalleryController extends Controller
{
    public function __construct(private readonly ImageService $images) {}

    public function index()
    {
        $gallery = GalleryImage::ordered()->paginate(12);

        return view('admin.gallery.index', compact('gallery'));
    }

    public function create()
    {
        return view('admin.gallery.create', ['gallery' => new GalleryImage]);
    }

    public function store(GalleryRequest $request)
    {
        $data = $request->safe()->only(['title', 'alt_text', 'is_active', 'sort_order']);
        $data['image'] = $this->images->storePhoto($request->file('image'), 'gallery', 2000, 2000);

        GalleryImage::create($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image uploaded successfully.');
    }

    public function edit(GalleryImage $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(GalleryRequest $request, GalleryImage $gallery)
    {
        $oldImage = $gallery->image;
        $data = $request->safe()->only(['title', 'alt_text', 'is_active', 'sort_order']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->images->storePhoto($request->file('image'), 'gallery', 2000, 2000);
        }

        $gallery->update($data);

        if (isset($data['image'])) {
            $this->images->deleteIfUnused($oldImage);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image updated successfully.');
    }

    public function destroy(GalleryImage $gallery)
    {
        $image = $gallery->image;
        $gallery->delete();
        $this->images->deleteIfUnused($image);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image deleted successfully.');
    }
}
