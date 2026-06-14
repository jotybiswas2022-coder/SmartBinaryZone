<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $currency = Setting::getValue('currency');
        return view('backend.settings', compact('currency'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'currency' => 'nullable|in:USD,BDT',
        ]);

        Setting::setValue('currency', $request->input('currency'));

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully.');
    }
}
