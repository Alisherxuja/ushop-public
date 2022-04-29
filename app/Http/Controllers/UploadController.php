<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,xls,xlsx|max:5120',
            'path' => 'nullable|string|max:255'
        ]);
        $path = $request->get('path', 'files') ?? 'files';
        $result['file'] = $request->file('file')->store($path, 'public');
        $result['url'] = Storage::disk('public')->url($result['file']);
        return success_out($result);
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'path' => 'required|string|max:255'
        ]);
        if (Storage::disk('public')->exists($data['path'])) {
            if (Storage::disk('public')->delete($data['path']))
                return success_out(['message' => 'File successfully removed']);
            return error_out(['message' => __('errors.removing_file')], 422,  __('errors.removing_file'));
        }
        return error_out(['message' => __('errors.file_not_found')], 422, __('errors.file_not_found'));
    }
}
