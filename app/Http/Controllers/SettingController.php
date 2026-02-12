<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $site = Site::first() ?? new Site();
        $settings = Setting::all()->pluck('value', 'fieldname');
        return view('setting.index', compact('site', 'settings'));
    }

    public function update(Request $request)
    {
        $site = Site::first() ?? new Site();

        $request->validate([
            'title' => 'required|string|max:128',
            'phone' => 'nullable|string|max:25',
            'email' => 'nullable|email|max:40',
            'address' => 'nullable|string|max:200',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:png,ico|max:512',
        ]);

        $data = $request->only(['title', 'tagline', 'email', 'phone', 'address', 'footer', 'currency_code', 'currency_symbol', 'google_analytics', 'language']);

        if ($request->hasFile('logo')) {
            if ($site->logo && $site->logo != 'default.png') {
                Storage::disk('public')->delete('images/' . $site->logo);
            }
            $path = $request->file('logo')->store('images', 'public');
            $data['logo'] = basename($path);
        }

        if ($request->hasFile('favicon')) {
            if ($site->favicon) {
                Storage::disk('public')->delete('images/' . $site->favicon);
            }
            $path = $request->file('favicon')->store('images', 'public');
            $data['favicon'] = basename($path);
        }

        if ($site->exists) {
            $site->update($data);
        } else {
            $data['create_date'] = now();
            $data['modify_date'] = now();
            $data['create_userID'] = auth()->id();
            $data['create_usertypeID'] = 1;
            Site::create($data);
        }

        // Update settings table for other options
        if ($request->has('attendance')) {
            Setting::updateOrCreate(['fieldname' => 'attendance'], ['value' => $request->attendance]);
        }

        return redirect()->route('setting.index')->with('success', 'Configuración actualizada correctamente.');
    }
}
