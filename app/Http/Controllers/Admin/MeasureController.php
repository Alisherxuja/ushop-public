<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MeasureRequest;
use App\Http\Resources\Admin\MeasureResource;
use App\Models\Base\Info\Measure;

class MeasureController extends Controller
{

    public function index()
    {
        $measures = Measure::query()->paginate();
        return success_out(MeasureResource::collection($measures), true);
    }

    public function list()
    {
        $measures = Measure::query()->where('status', Measure::STATUS_ACTIVE)->get();
        return success_out(MeasureResource::collection($measures));
    }

    public function get(Measure $measure)
    {
        return success_out($measure);
    }

    public function create(MeasureRequest $request)
    {
        $data = $request->validated();
        $measure = new Measure();
        $measure->fill($data);
        if ($measure->save()) {
            return success_out(MeasureResource::make($measure));
        }
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function update(MeasureRequest $request, Measure $measure)
    {
        $data = $request->validated();
        if ($measure->update($data)) {
            return success_out(MeasureResource::make($measure));
        }
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function destroy(Measure $measure)
    {
        if ($measure->delete()) {
            return success_out(MeasureResource::make($measure));
        }
        return error_out([], 422, 'Ошибка при удалении');
    }
}
