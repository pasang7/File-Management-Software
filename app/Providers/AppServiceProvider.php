<?php

namespace App\Providers;

use App\Models\Model\SuperAdmin\File\FileActivityLog;
use App\Models\Model\SuperAdmin\SiteSetting\SiteSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->share('user', Auth::user());

        Schema::defaultStringLength(191);
        $site_data = SiteSetting::find(1);
        define('SITE_TITLE',$site_data->title);
        define('SITE_EMAIL',$site_data->email);
        define('SITE_META_TITLE',$site_data->seo_title);
        define('SITE_META_KEYWORDS',$site_data->seo_keywords);
        define('SITE_META_DESCRIPTION',$site_data->seo_description);
        define('SITE_MAIL_EMAIL','info@klientscape.com');
        define('SITE_FIRST_MAIL_EMAIL','pasang@pocketstudionepal.com');
        define('SITE_SEC_MAIL_EMAIL','tpasu07@gmail.com');
        View::share('site_data', $site_data);
    }
}
