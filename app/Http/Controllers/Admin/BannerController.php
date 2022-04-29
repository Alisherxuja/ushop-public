<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Http\Resources\Admin\BannerResource;
use App\Jobs\Admin\RemoveFileJob;
use App\Models\Base\Site\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $status = request('status', null);

        $banners = Banner::query()
            ->when(!is_null($status), function ($query) use ($status) {
                $query->where('banners.status', $status);
            })
            ->orderByDesc('banners.id')
            ->paginate();

        return success_out(BannerResource::collection($banners), true);
    }

    public function create(BannerRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->file('file')->store('banners', 'public');
        $banner = new Banner();
        $banner->fill($data);
        if ($banner->save())
            return success_out(BannerResource::make($banner));
        return error_out([], 422, 'Ошибка при создании данных');
    }

    public function get(Banner $banner)
    {
        return success_out(BannerResource::make($banner));
    }

    public function update(BannerRequest $request, Banner $banner)
    {
        $data = $request->validated();
        if ($request->hasFile('file')) {
            $file = $banner->image;
            $data['image'] = $request->file('file')->store('banners', 'public');
        }
        if ($banner->update($data)) {
            if (isset($file) && \Storage::disk('public')->exists($file)) {
                \Storage::disk('public')->delete($file);
            }
            return success_out(BannerResource::make($banner));
        }
        return error_out([], 422, 'Ошибка обновления данных');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->delete()) {
            $this->dispatch(new RemoveFileJob($banner->image));
            return success_out(BannerResource::make($banner));
        }
        return error_out([], 422, 'Ошибка при удалении данных');
    }
}
