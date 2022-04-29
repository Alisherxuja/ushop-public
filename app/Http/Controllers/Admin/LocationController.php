<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LocationRequest;
use App\Http\Resources\Admin\LocationIndexResource;
use App\Http\Resources\Admin\LocationResource;
use App\Models\Base\Info\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function list()
    {
        $locations = Location::query()
            ->select(['id', 'name_' . app()->getLocale(). ' as name'])
            ->where('status', Location::STATUS_ACTIVE)
            ->orderByDesc('id')->get();
        return success_out($locations);
    }

    public function parentList()
    {
        $locations = Location::query()
            ->select(['id', 'name_' . app()->getLocale()])
            ->whereNull('parent_id')
            ->where('status', Location::STATUS_ACTIVE)
            ->orderByDesc('id')
            ->get();

        return success_out($locations);
    }

    public function withTree()
    {
        $locations = Location::query()
            ->with(['children'])
            ->where('status', Location::STATUS_ACTIVE)
            ->whereNull('parent_id')
            ->get();

        return success_out(LocationResource::collection($locations));
    }

    public function index(Request $request)
    {
        $locations = Location::search($request)->paginate();
        return success_out(LocationIndexResource::collection($locations), true);
    }

    public function get(Location $location)
    {
        return success_out($location);
    }

    public function create(LocationRequest $request)
    {
        $location = new Location();
        $location->fill($request->validated());
        if ($location->save()) {
            return success_out(LocationIndexResource::make($location));
        }
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function update(LocationRequest $request, Location $location)
    {
        if ($location->update($request->validated())) {
            return success_out(LocationIndexResource::make($location));
        }
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function destroy(Location $location)
    {
        if ($location->delete()) {
            return success_out(LocationIndexResource::make($location));
        }
        return error_out([], 422, 'Ошибка при удалении');
    }
}
