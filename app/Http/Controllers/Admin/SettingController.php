<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Display the system settings management portal.
     */
    public function index(): View
    {
        $settings = Setting::all()->keyBy('key');

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update system settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'site_title' => ['nullable', 'string', 'max:150'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'hero_headline' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string', 'max:500'],
            'hero_edition_label' => ['nullable', 'string', 'max:100'],
            'hero_cta_text' => ['nullable', 'string', 'max:80'],
            'hero_cta_url' => ['nullable', 'string', 'max:255'],
            'hero_bg_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'site_logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'site_icon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,ico,svg', 'max:1024'],
            'contact_email' => ['nullable', 'email', 'max:150'],
            'about_snippet' => ['nullable', 'string', 'max:1000'],
            'social_twitter' => ['nullable', 'string', 'max:255'],
            'social_instagram' => ['nullable', 'string', 'max:255'],
            'social_youtube' => ['nullable', 'string', 'max:255'],
        ]);

        $fields = [
            'site_title' => ['type' => 'text', 'group' => 'brand'],
            'site_tagline' => ['type' => 'text', 'group' => 'brand'],
            'hero_headline' => ['type' => 'text', 'group' => 'hero'],
            'hero_subtitle' => ['type' => 'textarea', 'group' => 'hero'],
            'hero_edition_label' => ['type' => 'text', 'group' => 'hero'],
            'hero_cta_text' => ['type' => 'text', 'group' => 'hero'],
            'hero_cta_url' => ['type' => 'text', 'group' => 'hero'],
            'contact_email' => ['type' => 'text', 'group' => 'contact'],
            'about_snippet' => ['type' => 'textarea', 'group' => 'editorial'],
            'social_twitter' => ['type' => 'text', 'group' => 'contact'],
            'social_instagram' => ['type' => 'text', 'group' => 'contact'],
            'social_youtube' => ['type' => 'text', 'group' => 'contact'],
        ];

        foreach ($fields as $key => $meta) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key), $meta['type'], $meta['group']);
            }
        }

        // Handle image uploads
        $imageFields = [
            'hero_bg_image' => 'hero',
            'site_logo' => 'brand',
            'site_icon' => 'brand',
        ];

        foreach ($imageFields as $imageKey => $group) {
            if ($request->hasFile($imageKey)) {
                $oldSetting = Setting::where('key', $imageKey)->first();
                if ($oldSetting && $oldSetting->value && ! str_starts_with($oldSetting->value, 'http')) {
                    Storage::disk('public')->delete($oldSetting->value);
                }

                $path = $request->file($imageKey)->store('settings', 'public');
                Setting::set($imageKey, $path, 'image', $group);
            }
        }

        // Handle image deletion if requested
        if ($request->boolean('remove_hero_bg_image')) {
            $oldSetting = Setting::where('key', 'hero_bg_image')->first();
            if ($oldSetting && $oldSetting->value && ! str_starts_with($oldSetting->value, 'http')) {
                Storage::disk('public')->delete($oldSetting->value);
            }
            Setting::set('hero_bg_image', null, 'image', 'hero');
        }

        Setting::clearCache();

        return redirect()->route('admin.settings.index')
            ->with('success', 'System settings & front-page visuals updated successfully.');
    }
}
