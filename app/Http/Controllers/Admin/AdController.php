<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\Admin\RemoveFileJob;
use App\Models\Base\Site\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{

    public function index()
    {
        $articles = Ad::query()
            ->orderByDesc('id')
            ->paginate();
        return success_out($articles, true);
    }

    public function get(Ad $article)
    {
        return success_out($article);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'file' => 'required|image',
            'url' => 'nullable|string|max:255',
        ]);
        $article = new Ad();
        $data['image'] = $request->file('file')->store('adds', 'public');
        $article->fill($data);
        if ($article->save()) {
            return success_out($article);
        }
        return error_out([], 422, 'Ошибка при сохранении');
    }

    public function update(Request $request, Ad $article)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'file' => 'nullable|image',
            'url' => 'nullable|string|max:255',
        ]);
        if ($request->hasFile('file')) {
            $data['image'] = $request->file('file')->store('adds', 'public');
            $file = $article->image;
        }
        if ($article->update($data)) {
            if (isset($file)) {
                $this->dispatch(new RemoveFileJob($file));
            }
            return success_out($article);
        }
        return error_out([], 422, 'Ошибка при сохранении');
    }

    public function destroy(Ad $article)
    {
        if ($article->delete()) {
            $this->dispatch(new RemoveFileJob($article->image));
            return success_out($article);
        }
        return error_out([], 422, 'Ошибка при удалении');
    }
}
