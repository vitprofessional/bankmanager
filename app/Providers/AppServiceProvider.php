<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ServerConfig;
use App\Models\BankEmployee;
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
            if(Session::has('superAdmin')):
                $employeeType = 1;
                $employeeId = BankEmployee::find(Session::get('superAdmin'));
            elseif(Session::has('generalAdmin')):
                $employeeType = 2;
                $employeeId = BankEmployee::find(Session::get('generalAdmin'));
            elseif(Session::has('manager')):
                $employeeType = 3;
                $employeeId = BankEmployee::find(Session::get('manager'));
            else:
                $employeeType = 4;
                $employeeId = BankEmployee::find(Session::get('cashier'));
            endif;
            $server = ServerConfig::where(['employee_id'=>$employeeId])->first();
            if(!empty($server) && $server->count()>0):
                $employeeId = $server->id;
            else:
                $employeeId = '';
            endif;
            
            $view->with(['serverData'=>$server,'employee_id'=>$employeeId]);
        });
    }
}
