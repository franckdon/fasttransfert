<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GeneralSettingsController extends Controller
{
    public function index()
    {
        $items = [
            ['label' => 'Tableau de bord', 'url' => route('dashboard')],
            ['label' => 'Paramètres', 'url' => route('settings.index')],
        ];
        return view('admin.settings.settings', [
            'items' => $items,
        ]);
    }

    public function general()
    {
        $items = [
            ['label' => 'Tableau de bord', 'url' => route('dashboard')],
            ['label' => 'Paramètres', 'url' => route('settings.index')],
            ['label' => 'General', 'url' => route('settings.general')],
        ];
        return view('admin.settings.general', [
            'items' => $items,
        ]);
    }

    public function mail()
    {
        $items = [
            ['label' => 'Tableau de bord', 'url' => route('dashboard')],
            ['label' => 'Paramètres', 'url' => route('settings.index')],
            ['label' => 'General', 'url' => route('settings.email')],
        ];
        return view('admin.settings.email', [
            'items' => $items,
        ]);
    }

    public function updateSiteInfo(Request $request)
    {
        $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_title' => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:255',
            'site_address' => 'nullable|string|max:255',
            'site_email' => 'nullable|email',
            'site_phone' => 'nullable|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,PNG,jpg,gif,svg|max:2048',
            'site_favicon' => 'nullable|image|mimes:jpeg,png,PNG,jpg,gif,svg|max:2048',
        ]);

        //dd($request->all());

        $settings = [
            'site_name' => $request->site_name,
            'site_title' => $request->site_title,
            'site_description' => $request->site_description,
            'site_address' => $request->site_address,
            'site_email' => $request->site_email,
            'site_phone' => $request->site_phone,
        ];

        // Gestion de l'upload de l'image
        if ($request->hasFile('site_logo')) {
            $image = $request->file('site_logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('logos', $filename, 'public'); // Stockage de l'image dans le répertoire public/logos
            $settings['site_logo'] = $path; // Enregistrement du chemin dans la base de données
        }

        if ($request->hasFile('site_favicon')) {
            $image = $request->file('site_favicon');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('logos', $filename, 'public'); // Stockage de l'image dans le répertoire public/logos
            $settings['site_favicon'] = $path; // Enregistrement du chemin dans la base de données
        }

        //dd($settings);

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }

        return back()->with('success', 'Settings updated successfully!');
    }

    public function mailUpdate(Request $request)
    {
        $validator = $request->validate([
            'mail_mailer' => 'required|string|max:255',
            'mail_host' => 'required|string|max:255',
            'mail_port' => 'required|string|max:255',
            'mail_username' => 'required|string|max:255',
            'mail_password' => 'required|string|max:255',
            'mail_encryption' => 'required|string|max:255',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string|max:255',
        ]);

        //dd($validator);

        $settings = [
            'mail_mailer' => $request->mail_mailer,
            'mail_host' => $request->mail_host,
            'mail_port' => $request->mail_port,
            'mail_username' => $request->mail_username,
            'mail_password' => $request->mail_password,
            'mail_encryption' => $request->mail_encryption,
            'mail_from_address' => $request->mail_from_address,
            'mail_from_name' => $request->mail_from_name,
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }

        // Optionally, you can cache the settings to improve performance.
        Cache::forget('settings');

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
