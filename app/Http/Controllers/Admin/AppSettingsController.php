<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Admin\Controller;
use App\AppSetting;
use DB;

class AppSettingsController extends Controller
{
    public function general()
    {
        $app = new AppSetting();
        $appSettings = $app->settings();

        return view('admin.appSettings.general', compact('appSettings'));
    }

    public function updateGeneral(Request $request)
    {
//        app_settings()->merge($request->all());
        $app = new AppSetting();
        $oldSetting = $app->settings();
        $newSetting = array_merge(
            $oldSetting,
            array_only($request->all(), array_keys($oldSetting))
        );

        foreach ($newSetting as $key => $value) {
            $appSetting = AppSetting::where('key', $key)->update(['value' => $value]);
        }

        return redirect()->route('admin.appSettings.general');
    }
}
