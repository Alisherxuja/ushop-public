<?php

namespace App\Http\Controllers;


use App\Rules\CustomExistIf;
use App\Rules\CustomUnique;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{

    public function signUp(Request $request)
    {
        $data = $request->validate([
            $this->username() => ['required', new CustomUnique('users', ['phone'])],//'required|unique:users,phone',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|max:50',
        ]);
        $data['password'] = Hash::make($data['password']);
        $data['phone'] = clearPhone($data['phone']);
        $user = new User();
        $user->fill($data);
        if ($user->save()) {
            $role_name = Role::findByName('customer');
            $user->assignRole($role_name);
            $token = auth('api')->login($user);
            return $this->respondWithToken($token);
        }
        return error_out([$this->username() => ['Ошибка при создании нового пользователя'], 422, 'Ошибка при создании нового пользователя']);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            $this->username() => ['required', new CustomExistIf('users', ['phone'])],//'required|unique:users,phone',
            'password' => 'required|string|min:6|max:255'
        ]);
        $username = clearPhone($data[$this->username()]);
        $user = User::query()->where($this->username(), $username)->first();
        
        if ($user->status !== User::STATUS_ACTIVE)
            return error_out(
                [$this->username() => ['Пользователь заблокирован администратором, обратитесь в службу поддержки']],
                422,
                'Пользователь заблокирован администратором, обратитесь в службу поддержки'
            );

        if (!\Hash::check($data['password'], $user->password))
            return error_out(['password' => ['Неправильный пароль']], 422, 'Неправильный пароль');

        $token = auth('api')->login($user);
        return $this->respondWithToken($token);

    }

    public function me()
    {
        $user = auth('api')->user();
        return success_out($this->getResponse($user));
    }

    public function logout()
    {
        \auth('api')->logout();
        return success_out(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(\auth('api')->refresh());
    }

    protected function respondWithToken(string $token)
    {
        return success_out([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL(),
            'permissions' => \Arr::pluck(auth('api')->user()->getAllPermissions(), 'name'),
            'roles' => auth('api')->user()->getRoleNames(),
        ]);
    }

    public function guard(): string
    {
        return 'api';
    }

    protected function username(): string
    {
        return 'phone';
    }

    private function getResponse(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'create_at' => $user->created_at,
        ];
    }
}
