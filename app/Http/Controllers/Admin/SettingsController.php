<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingsRequest;
use App\Models\WebsiteSetting;
use App\Services\ImageService;

class SettingsController extends Controller
{
    public function __construct(private readonly ImageService $images) {}

    public function edit()
    {
        $settings = array_merge(
            config('website.defaults'),
            WebsiteSetting::allCached()
        );

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(SettingsRequest $request)
    {
        $data = $request->safe()->except(['logo', 'favicon', 'remove_logo', 'remove_favicon']);

        foreach ($data as $key => $value) {
            $data[$key] = $value ?? '';
        }

        $oldLogo = WebsiteSetting::get('logo', '');
        $oldFavicon = WebsiteSetting::get('favicon', '');

        $newLogo = null;
        $newFavicon = null;

        if ($request->hasFile('logo')) {
            $newLogo = $this->images->storeBrandImage($request->file('logo'), 'branding', 800);
        }

        if ($request->hasFile('favicon')) {
            $newFavicon = $this->images->storeBrandImage($request->file('favicon'), 'branding', 256);
        }

        if ($newLogo) {
            $data['logo'] = $newLogo;
        } elseif ($request->boolean('remove_logo')) {
            $data['logo'] = '';
        } else {
            $data['logo'] = $oldLogo;
        }

        if ($newFavicon) {
            $data['favicon'] = $newFavicon;
        } elseif ($request->boolean('remove_favicon')) {
            $data['favicon'] = '';
        } else {
            $data['favicon'] = $oldFavicon;
        }

        WebsiteSetting::setMany($data);

        if ($newLogo || $request->boolean('remove_logo')) {
            $this->images->deleteIfUnused($oldLogo);
        }

        if ($newFavicon || $request->boolean('remove_favicon')) {
            $this->images->deleteIfUnused($oldFavicon);
        }

        return redirect()->route('admin.settings.edit')
            ->with('success', 'Company settings updated successfully.');
    }
}
