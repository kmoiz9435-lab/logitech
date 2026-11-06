<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContentRequest;
use App\Models\WebsiteSection;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;

class WebsiteContentController extends Controller
{
    public const SECTION_KEYS = ['hero', 'about', 'products', 'industries', 'why_choose', 'gallery', 'cta', 'contact'];

    public function __construct(private readonly ImageService $images) {}

    public function edit()
    {
        $sections = collect(self::SECTION_KEYS)->mapWithKeys(function ($key) {
            $section = WebsiteSection::firstOrNew(
                ['key' => $key],
                [
                    'eyebrow' => config("website.sections.{$key}.eyebrow"),
                    'heading' => config("website.sections.{$key}.heading"),
                    'sub_heading' => config("website.sections.{$key}.sub_heading"),
                    'content' => config("website.sections.{$key}.content"),
                    'image' => config("website.sections.{$key}.image"),
                    'is_active' => true,
                ]
            );

            return [$key => $section];
        });

        return view('admin.content.edit', compact('sections'));
    }

    public function update(ContentRequest $request)
    {
        DB::transaction(function () use ($request) {
            foreach (self::SECTION_KEYS as $key) {
                $payload = $request->input("sections.{$key}");

                if (! is_array($payload)) {
                    continue;
                }

                $section = WebsiteSection::firstOrCreate(
                    ['key' => $key],
                    [
                        'heading' => config("website.sections.{$key}.heading"),
                        'is_active' => true,
                    ]
                );

                $oldImage = $section->image;
                $data = [
                    'eyebrow' => $payload['eyebrow'] ?? null,
                    'heading' => $payload['heading'] ?? null,
                    'sub_heading' => $payload['sub_heading'] ?? null,
                    'content' => $payload['content'] ?? null,
                ];

                $newImage = null;

                if ($request->hasFile("sections.{$key}.image")) {
                    $newImage = $this->images->storePhoto($request->file("sections.{$key}.image"), 'content', 2200, 1600);
                    $data['image'] = $newImage;
                }

                $section->update($data);

                if ($newImage) {
                    $this->images->deleteIfUnused($oldImage);
                }
            }
        });

        return redirect()->route('admin.content.edit')
            ->with('success', 'Website content updated. Changes are live on the website.');
    }
}
