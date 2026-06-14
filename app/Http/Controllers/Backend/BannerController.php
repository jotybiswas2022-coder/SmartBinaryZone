<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $bannerPath = Setting::getValue('hero_banner');
        return view('backend.banner', compact('bannerPath'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        // Delete old banner if exists
        $oldPath = Setting::getValue('hero_banner');
        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        // Store new banner
        $path = $request->file('banner_image')->store('banners', 'public');
        Setting::setValue('hero_banner', $path);

        return redirect()->route('admin.banner')->with('success', 'Banner image uploaded successfully.');
    }

    public function remove()
    {
        $path = Setting::getValue('hero_banner');
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
        Setting::setValue('hero_banner', null);

        return redirect()->route('admin.banner')->with('success', 'Banner image removed successfully.');
    }
}
