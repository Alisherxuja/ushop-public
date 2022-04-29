<?php

namespace App\Observers;


use App\Jobs\Admin\RemoveFileJob;
use App\Models\Base\Products\ProductReviewAttachment;

class ProductReviewAttachmentObserver
{
    /**
     * Handle the article attachment "created" event.
     *
     * @param ProductReviewAttachment $attachment
     * @return void
     */
    public function created(ProductReviewAttachment $attachment)
    {
        //
    }

    /**
     * Handle the article attachment "updated" event.
     *
     * @param ProductReviewAttachment $attachment
     * @return void
     */
    public function updated(ProductReviewAttachment $attachment)
    {
        //
    }

    /**
     * Handle the article attachment "deleted" event.
     *
     * @param ProductReviewAttachment $attachment
     * @return void
     */
    public function deleted(ProductReviewAttachment $attachment)
    {
        dispatch(new RemoveFileJob($attachment->image));
    }

    /**
     * Handle the article attachment "restored" event.
     *
     * @param ProductReviewAttachment $attachment
     * @return void
     */
    public function restored(ProductReviewAttachment $attachment)
    {
        //
    }

    /**
     * Handle the article attachment "force deleted" event.
     *
     * @param ProductReviewAttachment $attachment
     * @return void
     */
    public function forceDeleted(ProductReviewAttachment $attachment)
    {
        dispatch(new RemoveFileJob($attachment->image));
    }
}
