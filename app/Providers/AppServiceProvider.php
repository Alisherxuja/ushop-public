<?php

namespace App\Providers;

use App\Http\View\Composers\Site\SiteHeaderComposer;
use App\Models\Base\Products\ProductReviewAttachment;
use App\Models\Base\Site\ArticleAttachment;
use App\Observers\ArticleAttachmentObserver;
use App\Observers\ProductReviewAttachmentObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('layouts.site.base', SiteHeaderComposer::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ArticleAttachment::observe(ArticleAttachmentObserver::class);
        ProductReviewAttachment::observe(ProductReviewAttachmentObserver::class);

        if (env('APP_SSL')) {
            \URL::forceScheme('https');
        }
    }
}
