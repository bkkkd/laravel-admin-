<?php

namespace bkkkd\LaravelAdminExcel;

use Illuminate\Support\ServiceProvider;

class LaravelAdminExcelServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(laravelAdminExcel $extension)
    {
        if (! laravelAdminExcel::boot()) {
            return ;
        }
        /*
        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'laravel-admin-excel');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/bkkkd/laravel-admin-excel')],
                'laravel-admin-excel'
            );
        }

        $this->app->booted(function () {
            laravelAdminExcel::routes(__DIR__.'/../routes/web.php');
        });
        */
    }
}