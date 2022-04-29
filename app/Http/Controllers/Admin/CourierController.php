<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourierRequest;
use App\Models\Base\Site\Courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function index(Request $request)
    {
        $couriers = Courier::search($request)->orderBy('id')->paginate();
        return success_out($couriers, true);
    }

    public function list()
    {
        $couriers = Courier::query()
            ->select(['id', 'name', 'car_number'])
            ->where('status', Courier::STATUS_ACTIVE);
        return success_out($couriers);
    }

    public function get(Courier $courier)
    {
        return success_out($courier);
    }

    public function create(CourierRequest $request)
    {
        $data = $request->validated();
        $courier = new Courier();
        $courier->fill($data);
        if ($courier->save()) {
            return success_out($courier);
        }
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function update(CourierRequest $request, Courier $courier)
    {
        $data = $request->validated();
        if ($courier->update($data)) {
            return success_out($courier);
        }
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function destroy(Courier $courier)
    {
        if ($courier->delete()) {
            return success_out($courier);
        }
        return error_out(['message' => 'Ошибка при удалении'], 422, 'Ошибка при удалении');
    }
}
