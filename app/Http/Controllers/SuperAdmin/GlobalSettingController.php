<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\GlobalSetting;
use Illuminate\Http\Request;

class GlobalSettingController extends BaseController
{
    public function index()
    {
        $settings = GlobalSetting::all();
        return view('super-admin.settings.index', [
            'settings' => $settings,
            'pageData' => $this->pageData('Global Settings', 'Home|Settings')
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
        ]);

        try {
            foreach ($request->settings as $key => $value) {
                GlobalSetting::set($key, $value);
            }
            return redirect()->back()->with('success', 'Global settings updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update settings: ' . $e->getMessage());
        }
    }
}
