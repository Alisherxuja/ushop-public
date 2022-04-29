<?php

namespace App\Http\Controllers\Site\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Testing\Fluent\Concerns\Has;

class CabinetController extends Controller
{
    public function cabinet()
    {
        $user = \Auth::guard('web')->user();
        return view('site.cabinet.index', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'old_password' => 'nullable|string|min:6|max:255',
            'new_password' => 'nullable|required_with:old_password|string|min:6|max:255',
            'confirm_new_password' => 'nullable|required_with:old_password|string|min:6|max:255|same:new_password',
        ]);

        $user = \Auth::guard('web')->user();
        $text = '';
        if ($request->has('old_password') && !is_null($data['old_password'])) {
            if (!\Hash::check($data['old_password'], $user->password)) {
                return back()->withErrors(['old_password' => ['Wrong']]);
            }
            $text .= 'Password is updated,';
            $data['password'] = \Hash::make($data['new_password']);
        }

        $user->update($data);
        $user->createOrUpdateProfile($data);
        return redirect()->route('user.cabinet')->with('updated', $text . ' Profile successfully updated');
    }
}
