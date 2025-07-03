<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'contact_address' => 'nullable|string',
            'emergency_number' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'maintenance_mode' => 'boolean',
            'enable_registrations' => 'boolean',
            'primary_color' => 'nullable|string|regex:/^#[a-fA-F0-9]{6}$/',
            'secondary_color' => 'nullable|string|regex:/^#[a-fA-F0-9]{6}$/',
            'accent_color' => 'nullable|string|regex:/^#[a-fA-F0-9]{6}$/',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo
            $oldLogo = Setting::get('logo');
            if ($oldLogo && Storage::exists('public/' . str_replace(asset('storage/'), '', $oldLogo))) {
                Storage::delete('public/' . str_replace(asset('storage/'), '', $oldLogo));
            }

            $logoPath = $request->file('logo')->store('settings', 'public');
            Setting::set('logo', $logoPath, 'image', 'Site Logo', true);
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            // Delete old favicon
            $oldFavicon = Setting::get('favicon');
            if ($oldFavicon && Storage::exists('public/' . str_replace(asset('storage/'), '', $oldFavicon))) {
                Storage::delete('public/' . str_replace(asset('storage/'), '', $oldFavicon));
            }

            $faviconPath = $request->file('favicon')->store('settings', 'public');
            Setting::set('favicon', $faviconPath, 'image', 'Site Favicon', true);
        }

        // Update other settings
        $settingsData = [
            'site_name' => ['value' => $request->site_name, 'type' => 'text', 'description' => 'Site Name', 'public' => true],
            'site_description' => ['value' => $request->site_description, 'type' => 'text', 'description' => 'Site Description', 'public' => true],
            'contact_email' => ['value' => $request->contact_email, 'type' => 'text', 'description' => 'Contact Email', 'public' => true],
            'contact_phone' => ['value' => $request->contact_phone, 'type' => 'text', 'description' => 'Contact Phone', 'public' => true],
            'contact_address' => ['value' => $request->contact_address, 'type' => 'text', 'description' => 'Contact Address', 'public' => true],
            'emergency_number' => ['value' => $request->emergency_number, 'type' => 'text', 'description' => 'Emergency Number', 'public' => true],
            'maintenance_mode' => ['value' => $request->has('maintenance_mode'), 'type' => 'boolean', 'description' => 'Maintenance Mode', 'public' => false],
            'enable_registrations' => ['value' => $request->has('enable_registrations'), 'type' => 'boolean', 'description' => 'Enable User Registrations', 'public' => false],
            'primary_color' => ['value' => $request->primary_color, 'type' => 'text', 'description' => 'Primary Color', 'public' => true],
            'secondary_color' => ['value' => $request->secondary_color, 'type' => 'text', 'description' => 'Secondary Color', 'public' => true],
            'accent_color' => ['value' => $request->accent_color, 'type' => 'text', 'description' => 'Accent Color', 'public' => true],
        ];

        foreach ($settingsData as $key => $data) {
            if ($request->filled($key) || $data['type'] === 'boolean') {
                Setting::set($key, $data['value'], $data['type'], $data['description'], $data['public']);
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', __('messages.settings_updated_successfully'));
    }

    public function deleteLogo()
    {
        $logo = Setting::where('key', 'logo')->first();

        if ($logo && $logo->value) {
            // Delete file from storage
            $logoPath = str_replace(asset('storage/'), '', $logo->value);
            if (Storage::exists('public/' . $logoPath)) {
                Storage::delete('public/' . $logoPath);
            }

            // Delete setting
            $logo->delete();
            Setting::clearCache();
        }

        return redirect()->route('admin.settings.index')
            ->with('success', __('messages.logo_deleted_successfully'));
    }

    public function deleteFavicon()
    {
        $favicon = Setting::where('key', 'favicon')->first();

        if ($favicon && $favicon->value) {
            // Delete file from storage
            $faviconPath = str_replace(asset('storage/'), '', $favicon->value);
            if (Storage::exists('public/' . $faviconPath)) {
                Storage::delete('public/' . $faviconPath);
            }

            // Delete setting
            $favicon->delete();
            Setting::clearCache();
        }

        return redirect()->route('admin.settings.index')
            ->with('success', __('messages.favicon_deleted_successfully'));
    }
}
