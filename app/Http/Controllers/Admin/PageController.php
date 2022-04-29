<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Base\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::query()
            ->select(['id', 'title_ru'])
            ->orderByDesc('id')
            ->paginate();
        return success_out($pages, true);
    }

    public function get(Page $page)
    {
        return success_out($page);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'title_ru' => 'required|string|max:255',
            'title_uz' => 'required|string|max:255',
            'content_uz' => 'required|string',
            'content_ru' => 'required|string',
        ]);
        $page = new Page();
        $page->fill($data);
        if ($page->save()) {
            return success_out($page);
        }
        return error_out([], 422, 'Ошибка при сохранении');
    }

    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'title_ru' => 'required|string|max:255',
            'title_uz' => 'required|string|max:255',
            'content_uz' => 'required|string',
            'content_ru' => 'required|string',
        ]);
        if ($page->update($data)) {
            return success_out($page);
        }
        return error_out([], 422, 'Ошибка при сохранении');
    }

    public function destroy(Page $page)
    {
        if ($page->delete()) {
            return success_out($page);
        }
        return error_out([], 422, 'Ошибка при удалении');
    }
}
