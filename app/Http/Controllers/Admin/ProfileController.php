<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function password(Request $request)
    {
        $data = $request->validate([
            'oldPassword' => 'required|string|min:6',
            'newPassword' => 'required|string|min:6',
            'confirmNewPassword' => 'required|string|same:newPassword'
        ]);
        $user = \Auth::guard('api')->user();
        if (!\Hash::check($data['oldPassword'], $user->password)) {
            return error_out(['oldPassword' => ['Wrong password']]);
        }

        if ($user->update(['password' => Hash::make($data['newPassword'])])) {
            return success_out([]);
        }
        return error_out([], 422, 'Error updating password');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:users,phone',
        ]);
        $user = \Auth::guard('api')->user();
        if ($user->update($data)) {
            return success_out([]);
        }
        return error_out([], 422, 'Error updating user info');
    }

    public function get()
    {
        $user = \Auth::guard('api')->user();
        return success_out([
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
        ]);
    }
}
