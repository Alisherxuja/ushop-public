<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Rules\CustomUnique;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required|exists:users,phone',
            'password' => 'required',
        ]);

        $user = User::query()->where('phone', $data['phone'])->first();

        if ($user->status == User::STATUS_INACTIVE) {
            return back()->with('login-errors', 'Error login')->withErrors($data);
        }

        if (!\Hash::check($data['password'], $user->password)) {
            return back()->with('login-errors', 'Error login')->withErrors($data);
        }
        \Auth::guard('web')->login($user);
        return redirect()->route('main');
    }

    public function thanks()
    {
        return view('site.thanks');
    }

    public function signUp(Request $request)
    {
        $data = $request->validate([
            $this->username() => ['required', new CustomUnique('users', ['phone'])],//'required|unique:users,phone',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|max:50',
        ]);
        $data['last_name'] = $data['name'];
        $data['password'] = \Hash::make($data['password']);
        $user = new User();
        $user->fill($data);
        if ($user->save()) {
            $role_name = Role::findByName('customer');
            $user->assignRole($role_name);
            $user->createOrUpdateProfile($data);
            \Auth::guard('web')->login($user);
            return redirect()->route('thanks');
        }
        return redirect()->back()->with('sign-up', 'Error creating account')->withErrors($data);
    }

    public function logout()
    {

        \Auth::guard('web')->logout();

        return redirect()->route('main');
    }

    public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required'
        ]);
        redirect()->route('main');
    }

    protected function username(): string
    {
        return 'phone';
    }
}
