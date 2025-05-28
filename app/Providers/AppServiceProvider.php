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
                $employee = BankEmployee::find(Session::get('superAdmin'));
            elseif(Session::has('generalAdmin')):
                $employeeType = 2;
                $employee = BankEmployee::find(Session::get('generalAdmin'));
            elseif(Session::has('manager')):
                $employeeType = 3;
                $employee = BankEmployee::find(Session::get('manager'));
            else:
                $employeeType = 4;
                $employee = BankEmployee::find(Session::get('cashier'));
            endif;
            
            if(!empty($employee) && $employee->count()>0):
                $employee_id = $employee->id;
                $creator = $employee->creator;
            else:
                $employee_id = '';
                $creator = "";
            endif;


            $server = ServerConfig::where(['employee_id'=>$employee_id])->orWhere(['employee_id'=>$creator])->first();
            
            $view->with(['serverData'=>$server,'employee'=> $employee, 'employee_id'=>$employee_id]);
        });
    }
}
