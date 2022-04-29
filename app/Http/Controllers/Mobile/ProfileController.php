<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function info()
    {
        $user = \Auth::guard('api')->user();
        return success_out([
            'name' => $user->name,
            'last_name' => optional($user->profile)->last_name,
            //'gender' => optional($user->profile)->gender,
            //'birth_date' => optional($user->profile)->birth_date,
            //'local' => optional($user->profile)->local,
            //'phone' => $user->phone,
            'email' => $user->email,
        ]);
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

        $user = \Auth::guard('api')->user();
        if ($request->has('old_password') && !is_null($data['old_password'])) {
            if (!\Hash::check($data['old_password'], $user->password)) {
                return back()->withErrors(['old_password' => ['Wrong']]);
            }
            $data['password'] = \Hash::make($data['new_password']);
        }

        $user->update($data);
        $user->createOrUpdateProfile($data);
        return success_out(['message' => 'Successfully updated']);
    }
}
