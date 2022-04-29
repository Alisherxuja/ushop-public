<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentTypeRequest;
use App\Jobs\Admin\RemoveFileJob;
use App\Models\Base\Site\PaymentType;

class PaymentTypeController extends Controller
{
    public function list()
    {
        $types = PaymentType::query()
            ->select(['id', 'name_' . app()->getLocale(). ' as name'])
            ->where('status', PaymentType::STATUS_ACTIVE)
            ->get();
        return success_out($types);
    }

    public function index()
    {
        $types = PaymentType::query()
            ->select(['id', 'name_' . app()->getLocale() . ' as name', 'status', 'logo', 'type'])
            ->orderBy('id')->paginate();
        return success_out($types, true);
    }

    public function get(PaymentType $type)
    {
        return success_out($type);
    }

    public function create(PaymentTypeRequest $request)
    {
        $data = $request->validated();
        $type = new PaymentType();
        $data['logo'] = $request->file('file')->store('payment', 'public');
        $type->fill($data);
        if ($type->save()) {
            return success_out($type);
        }
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function update(PaymentTypeRequest $request, PaymentType $type)
    {
        $data = $request->validated();
        if ($request->has('file') && !empty($request->has('file'))) {
            $file = $type->logo;
            $data['logo'] = $request->file('file')->store('payment', 'public');
        }
        if ($type->update($data)) {
            if (isset($file)) {
                $this->dispatch(new RemoveFileJob($file));
            }
            return success_out($type);
        }
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function destroy(PaymentType $type)
    {
        if ($type->delete()) {
            $this->dispatch(new RemoveFileJob($type->logo));
            return success_out($type);
        }
        return error_out([], 422, 'Ошибка при удалении');
    }
}
