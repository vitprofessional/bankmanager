<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ServerConfiguration;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*',function($view){
            $employee_id = 1;
            $server = ServerConfiguration::where(['employee_id'=>$employee_id])->first();
            $view->with(['serverData'=>$server]);
        });
    }
}
