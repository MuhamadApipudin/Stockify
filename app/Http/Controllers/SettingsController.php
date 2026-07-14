<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        // Load all settings for the view (the Blade expects $settings collection)
        $settings = Setting::query()->get();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)

{
    // Update Nama Aplikasi
    if ($request->has('app_name')) {
        Setting::updateOrCreate(['key' => 'app_name'], ['value' => $request->app_name]);
    }

    // Upload Logo
    if ($request->hasFile('app_logo')) {
    // Ini akan menghasilkan string 'logo/namafile.png'
    $path = $request->file('app_logo')->store('logo', 'public'); 
    
    Setting::updateOrCreate(
        ['key' => 'app_logo'], 
        ['value' => $path] 
    );

    return back()->with('success', 'Pengaturan berhasil diperbarui!');
}


}
}