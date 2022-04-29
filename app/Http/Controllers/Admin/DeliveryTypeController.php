<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeliveryTypeRequest;
use App\Models\Base\Site\DeliveryType;

class DeliveryTypeController extends Controller
{
    public function list()
    {
        $types = DeliveryType::query()
            ->select(['id', 'name_' . app()->getLocale()])
            ->where('status', DeliveryType::STATUS_ACTIVE)
            ->get();
        return success_out($types);
    }

    public function index()
    {
        $types = DeliveryType::query()
            ->select(['id', 'name_' . app()->getLocale(). ' as name', 'description_' . app()->getLocale(). ' as description', 'status'])
            ->orderBy('id')->paginate();
        return success_out($types, true);
    }

    public function get(DeliveryType $type)
    {
        return success_out($type);
    }

    public function create(DeliveryTypeRequest $request)
    {
        $data = $request->validated();
        $type = new DeliveryType();
        $type->fill($data);
        if ($type->save()) {
            return success_out($type);
        }
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function update(DeliveryTypeRequest $request, DeliveryType $type)
    {
        $data = $request->validated();
        if ($type->update($data)) {
            return success_out($type);
        }
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function destroy(DeliveryType $type)
    {
        if ($type->delete()) {
            return success_out($type);
        }
        return error_out([], 422, 'Ошибка при удалении');
    }
}
