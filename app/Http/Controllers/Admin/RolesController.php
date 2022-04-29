<?php


namespace App\Http\Controllers\Admin;


use App\Helpers\Permissions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Services\Admin\RoleService;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    private RoleService $service;

    public function __construct()
    {
        $this->service = new RoleService();
    }

    public function index()
    {
        return success_out($this->service->search(), true);
    }

    public function list()
    {
        return success_out($this->service->list());
    }

    public function get(Role $role)
    {
        return success_out($this->service->get($role));
    }

    public function permissions()
    {
        return success_out(Permissions::groupList());
    }

    public function create(RoleRequest $request)
    {
        if ($role = $this->service->create($request->validated()))
            return success_out($role);
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function update(RoleRequest $request, Role $role)
    {
        if ($role = $this->service->update($request->validated(), $role))
            return success_out($role);
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function destroy(Role $role)
    {
        if ($role->delete())
            return success_out($this->service->get($role));
        return error_out(['message' => 'Ошибка при удалении'], 422, 'Ошибка при удалении');
    }
}
