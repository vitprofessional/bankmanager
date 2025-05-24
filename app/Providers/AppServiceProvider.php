<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ServerConfig;
use Session;

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
            if(Session::get('superAdmin')):
                $employeeType = 1;
            elseif(Session::get('generalAdmin')):
                $employeeType = 2;
            elseif(Session::get('manager')):
                $employeeType = 3;
            else:
                $employeeType = 4;
            endif;
            $server = ServerConfig::where(['profileType'=>$employeeType])->first();
            if(!empty($server) && $server->count()>0):
                $employeeId = $server->id;
            else:
                $employeeId = '';
            endif;
            
            $view->with(['serverData'=>$server,'employee_id'=>$employeeId]);
        });
    }
}
