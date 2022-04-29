<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Base\Settings\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function get()
    {
        $setting = Setting::query()->firstOrNew();
        return success_out($setting);
    }


    public function createOrUpdate(Request $request)
    {
        $data = $request->validate([
            'id' => 'nullable|integer',
            'phone' => 'required|string|max:255',
            'phone2' => 'required|string|max:255',
            'email' => 'nullable|string|max:255',
            'company_name' => 'required|string|max:255',
            'address_ru' => 'nullable|string|max:255',
            'address_uz' => 'nullable|string|max:255',
            'coordinates' => 'nullable|json',
            'title_ru' => 'nullable|string|max:255',
            'title_uz' => 'nullable|string|max:255',
            'description_ru' => 'nullable|string',
            'description_uz' => 'nullable|string',
            'logo' => 'nullable|string',
            'favicon' => 'nullable|string',
            'android_app_url' => 'nullable|string',
            'ios_app_url' => 'nullable|string',
            'social' => 'nullable|array'
        ]);
        if ($request->has('social')) {
            $data['social'] = json_encode($data['social']);
        }
        $setting = Setting::query()->updateOrCreate(['id' => $data['id']], $data);
        return success_out($setting);
    }
}
