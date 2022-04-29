<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Services\Admin\StuffService;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class StuffController extends Controller
{
    private StuffService $service;

    public function __construct()
    {
        $this->service = new StuffService();
    }

    public function index(Request $request)
    {
        return success_out($this->service->search($request), true);
    }

    public function get(User $user)
    {
        return success_out($this->service->get($user));
    }

    public function create(UserRequest $request)
    {
        if ($user = $this->service->create($request->validated()))
            return success_out($this->getResponse($user));
        return error_out([], 422, 'Ошибка при сохранении информации о пользователе');
    }

    public function update(UserRequest $request, User $user)
    {
        if ($user = $this->service->update($request->validated(), $user))
            return success_out($this->getResponse($user));
        return error_out([], 422, 'Ошибка при сохранении информации о пользователе');
    }

    public function change(Request $request, User $user)
    {
        $data = $request->validate([
            'status' => 'required|in:10,0',
        ]);
        if ($user->update($data))
            return success_out($this->getResponse($user));
        return error_out([], 422, 'Ошибка при сохранении данных');
    }

    public function destroy(User $user)
    {
        if ($user->delete())
            return success_out($this->getResponse($user));
        return error_out([], 422, 'Ошибка при удалении');
    }

    private function getResponse(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'status' => $user->status,
            'roles' => $user->roles()->select(['name'])->pluck('name'),
        ];
    }
}
