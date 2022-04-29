<?php

namespace App\Observers;


use App\Jobs\Admin\RemoveFileJob;
use App\Models\Base\Site\ArticleAttachment;

class ArticleAttachmentObserver
{
    /**
     * Handle the article attachment "created" event.
     *
     * @param ArticleAttachment $articleAttachment
     * @return void
     */
    public function created(ArticleAttachment $articleAttachment)
    {
        //
    }

    /**
     * Handle the article attachment "updated" event.
     *
     * @param ArticleAttachment $articleAttachment
     * @return void
     */
    public function updated(ArticleAttachment $articleAttachment)
    {
        //
    }

    /**
     * Handle the article attachment "deleted" event.
     *
     * @param ArticleAttachment $articleAttachment
     * @return void
     */
    public function deleted(ArticleAttachment $articleAttachment)
    {
        dispatch(new RemoveFileJob($articleAttachment->path));
    }

    /**
     * Handle the article attachment "restored" event.
     *
     * @param ArticleAttachment $articleAttachment
     * @return void
     */
    public function restored(ArticleAttachment $articleAttachment)
    {
        //
    }

    /**
     * Handle the article attachment "force deleted" event.
     *
     * @param ArticleAttachment $articleAttachment
     * @return void
     */
    public function forceDeleted(ArticleAttachment $articleAttachment)
    {
        dispatch(new RemoveFileJob($articleAttachment->path));
    }
}
