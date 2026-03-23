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
        $sections = array_keys(config('settings_sections', []));
        $first = 'mission';
        return redirect()->route('admin.settings.sections', $first);
    }

    public function create()
    {
        return view('admin.settings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'setting_key' => 'required|string|max:150|unique:site_settings,setting_key',
            'setting_value' => 'nullable|string',
            'type' => 'in:text,image,json,boolean',
        ]);
        SiteSetting::create($validated);
        return redirect()->route('admin.settings.index')->with('success', 'Setting created.');
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
        \Illuminate\Support\Facades\Cache::forget("site_setting_{$setting->setting_key}");
        return redirect()->route('admin.settings.index')->with('success', 'Setting updated.');
    }

    public function destroy(SiteSetting $setting)
    {
        $setting->delete();
        \Illuminate\Support\Facades\Cache::forget("site_setting_{$setting->setting_key}");
        return redirect()->route('admin.settings.index')->with('success', 'Setting deleted.');
    }

    public function editSection(string $section)
    {
        $sections = config('settings_sections', []);
        if (!isset($sections[$section])) {
            abort(404, 'Unknown section.');
        }
        $config = $sections[$section];
        $keys = array_keys($config['keys']);
        $settings = SiteSetting::whereIn('setting_key', $keys)->get()->keyBy('setting_key');
        $data = [];
        foreach ($keys as $key) {
            $raw = $settings->get($key)?->setting_value ?? '';
            if ($key === 'core_values' && $raw !== '') {
                $decoded = json_decode($raw, true);
                $data[$key] = is_array($decoded) ? implode("\n", $decoded) : $raw;
            } else {
                $data[$key] = $raw;
            }
        }
        return view('admin.settings.section_edit', [
            'section' => $section,
            'title' => $config['title'],
            'keys' => $config['keys'],
            'data' => $data,
        ]);
    }

    public function updateSection(Request $request, string $section)
    {
        $sections = config('settings_sections', []);
        if (!isset($sections[$section])) {
            abort(404, 'Unknown section.');
        }
        $config = $sections[$section];
        $keysConfig = $config['keys'];
        $rules = [];
        foreach (array_keys($keysConfig) as $key) {
            $type = $keysConfig[$key]['type'] ?? 'text';
            if ($type === 'image') {
                $rules[$key] = 'nullable|image|max:2048';
            } elseif ($type === 'file') {
                $rules[$key] = 'nullable|file|max:10240';
            } else {
                $rules[$key] = 'nullable|string';
            }
        }
        $validated = $request->validate($rules);

        foreach (array_keys($keysConfig) as $key) {
            $type = $keysConfig[$key]['type'] ?? 'text';
            $value = null;
            if ($type === 'image' || $type === 'file') {
                $existing = SiteSetting::where('setting_key', $key)->first();
                if ($request->hasFile($key)) {
                    if ($existing?->setting_value) {
                        \App\Services\ImageService::delete($existing->setting_value);
                    }
                    $value = \App\Services\ImageService::handleUpload($request->file($key), 'settings');
                } else {
                    $value = $existing?->setting_value ?? '';
                }
            } else {
                $value = $validated[$key] ?? '';
                if ($key === 'core_values' && is_string($value)) {
                    $lines = array_filter(array_map('trim', explode("\n", $value)));
                    $value = json_encode($lines);
                }
            }
            $dbType = $type === 'file' ? 'text' : $type;
            SiteSetting::updateOrCreate(
                ['setting_key' => $key],
                ['setting_value' => $value ?? '', 'type' => $dbType]
            );
            \Illuminate\Support\Facades\Cache::forget("site_setting_{$key}");
        }
        return redirect()->route('admin.settings.sections', $section)->with('success', 'Section updated.');
    }

    public function slides()
    {
        $slides = HomepageSlide::orderBy('display_order')->get();
        return view('admin.settings.slides.index', compact('slides'));
    }

    public function slidesCreate()
    {
        return view('admin.settings.slides.create');
    }

    public function formSlidesCreate()
    {
        return view('admin.settings.slides._form', ['slide' => null]);
    }

    public function formSlidesEdit(HomepageSlide $slide)
    {
        return view('admin.settings.slides._form', ['slide' => $slide]);
    }

    public function slidesStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:200',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'cta_text' => 'nullable|string|max:100',
            'cta_link' => 'nullable|string|max:255',
            'cta_secondary_text' => 'nullable|string|max:100',
            'cta_secondary_link' => 'nullable|string|max:255',
            'display_order' => 'nullable|integer',
            'status' => 'in:active,inactive',
        ]);
        $validated['display_order'] = $validated['display_order'] ?? 0;
        $validated['status'] = $validated['status'] ?? 'inactive';
        if ($request->hasFile('image')) {
            $validated['image_path'] = \App\Services\ImageService::handleUpload($request->file('image'), 'slides');
        } else {
            $validated['image_path'] = null;
        }
        unset($validated['image']);
        HomepageSlide::create($validated);
        return redirect()->route('admin.settings.slides')->with('success', 'Slide created.');
    }

    public function slidesEdit(HomepageSlide $slide)
    {
        return view('admin.settings.slides.edit', compact('slide'));
    }

    public function slidesUpdate(Request $request, HomepageSlide $slide)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:200',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'cta_text' => 'nullable|string|max:100',
            'cta_link' => 'nullable|string|max:255',
            'cta_secondary_text' => 'nullable|string|max:100',
            'cta_secondary_link' => 'nullable|string|max:255',
            'display_order' => 'nullable|integer',
            'status' => 'in:active,inactive',
        ]);
        if ($request->hasFile('image')) {
            if ($slide->image_path) {
                \App\Services\ImageService::delete($slide->image_path);
            }
            $validated['image_path'] = \App\Services\ImageService::handleUpload($request->file('image'), 'slides');
        }
        unset($validated['image']);
        $slide->update($validated);
        return redirect()->route('admin.settings.slides')->with('success', 'Slide updated.');
    }

    public function slidesDestroy(HomepageSlide $slide)
    {
        if ($slide->image_path) {
            \App\Services\ImageService::delete($slide->image_path);
        }
        $slide->delete();
        return redirect()->route('admin.settings.slides')->with('success', 'Slide deleted.');
    }
}
