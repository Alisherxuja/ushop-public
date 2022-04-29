<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Http\Resources\Admin\ArticleAttachmentResource;
use App\Http\Resources\Admin\ArticleResource;
use App\Models\Base\Site\Article;
use App\Models\Base\Site\ArticleAttachment;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index(Request $request)
    {
        $articles = Article::search($request)
            ->select(['id', 'title_' . app()->getLocale(), 'status', 'view_count'])
            ->orderByDesc('id')->paginate();
        return success_out($articles, true);
    }

    public function get(Article $article)
    {
        return success_out($this->getResource($article));
    }

    public function create(ArticleRequest $request)
    {
        $data = $request->validated();
        $article = new Article();
        $article->fill($data);
        if ($article->save()) {
            if ($request->has('attachments')) {
                $article->saveAttachment($request->attachments);
            }
            return success_out($this->getResource($article));
        }
        return error_out([], 422, 'Ошибка при сохранении');
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $data = $request->validated();
        if ($article->update($data)) {
            if ($request->has('attachments')) {
                $article->saveAttachment($request->attachments);
            }
            return success_out($this->getResource($article));
        }
        return error_out([], 422, 'Ошибка при сохранении');
    }

    public function destroy(Article $article)
    {
        if ($article->delete()) {
            $article->articleAttachments()->delete();
            return success_out($this->getResource($article));
        }
        return error_out([], 422, 'Ошибка при удалении');
    }

    public function destroyAttachment(ArticleAttachment $attachment)
    {
        if ($attachment->delete()) {
            return success_out($attachment);
        }
        return error_out([], 422, 'Ошибка при удалении');
    }

    private function getResource(Article $article): ArticleResource
    {
        return ArticleResource::make($article);
    }
}
