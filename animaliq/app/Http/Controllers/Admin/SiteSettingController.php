<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSlide;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::orderBy('setting_key')->paginate(20);
        return view('admin.settings.index', compact('settings'));
    }

    public function edit(SiteSetting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, SiteSetting $setting)
    {
        $validated = $request->validate([
            'setting_value' => 'nullable|string',
        ]);
        $setting->update($validated);
        return redirect()->route('admin.settings.index')->with('success', 'Setting updated.');
    }

    public function slides()
    {
        $slides = HomepageSlide::orderBy('display_order')->get();
        return view('admin.settings.slides', compact('slides'));
    }
}
