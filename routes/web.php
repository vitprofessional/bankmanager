<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculasViewController;
use App\Http\Controllers\CalculasReportController;
use App\Http\Controllers\DebitCreditController;
use App\Http\Controllers\CalculasController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ServerConfiguration;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[
    CalculasViewController::class,
    'index'
])->name('calculasLogin'); 

Route::get('/logout',[
    CalculasViewController::class,
    'logoutCalculas'
])->name('logoutCalculas');

Route::post('/register/calculas',[
    CalculasViewController::class,
    'registerCalculas'
])->name('registerCalculas');

Route::post('/login/confirm',[
    CalculasViewController::class,
    'loginCalculas'
])->name('loginCalculas');


Route::middleware(['superAdmin','manager','cashier','generalAdmin'])->group(function(){
    Route::get('/home',[
        CalculasController::class,
        'index'
    ])->name('home');

    Route::post('/home/saveCalculas',[
        CalculasController::class,
        'saveCalculas'
    ])->name('saveCalculas');

    Route::get('/home/{id}',[
        CalculasController::class,
        'editCalculas'
    ])->name('editCalculas');

    Route::post('/home/updateCalculas',[
        CalculasController::class,
        'updateCalculas'
    ])->name('updateCalculas');

    Route::get('/generateReport',[
        CalculasReportController::class,
        'generateReport'
    ])->name('generateReport');

    Route::post('/generateReport/getData',[
        CalculasReportController::class,
        'getData'
    ])->name('getData');

    Route::get('/debit-credit',[
        CalculasController::class,
        'debitCredit'
    ])->name('debitCredit');

    Route::post('/saveDebitCredit',[
        DebitCreditController::class,
        'saveDebitCredit'
    ])->name('saveDebitCredit');

    Route::get('/editDCdata/{id}',[
        DebitCreditController::class,
        'editDCdata'
    ])->name('editDCdata');

    Route::get('/delDCdata/{id}',[
        DebitCreditController::class,
        'delDCdata'
    ])->name('delDCdata');


    Route::get('/account-create',[
        FrontController::class,
        'accountCreation'
    ])->name('accountCreation');

    Route::post('/save-account',[
        FrontController::class,
        'saveAccount'
    ])->name('saveAccount');

    Route::get('/account/list',[
        FrontController::class,
        'acList'
    ])->name('acList');

    Route::get('/account/view/{id}',[
        FrontController::class,
        'acView'
    ])->name('acView');

    Route::get('/account/edit/{id}',[
        FrontController::class,
        'acEdit'
    ])->name('acEdit');

    Route::post('/update-account',[
        FrontController::class,
        'acUpdate'
    ])->name('acUpdate');

    Route::get('/account/del/{id}',[
        FrontController::class,
        'acDelete'
    ])->name('acDelete');

    Route::get('/server/user/profile/',[
        CalculasController::class,
        'userProfile'
    ])->name('userProfile');

    Route::get('/server/user/password/change/',[
        CalculasController::class,
        'changeUserPass'
    ])->name('changeUserPass');

    Route::post('/server/user/profile/save/',[
        CalculasController::class,
        'updateEmployeeProfile'
    ])->name('updateEmployeeProfile');

    Route::post('/server/user/password/save/',[
        CalculasController::class,
        'updatePassword'
    ])->name('updatePassword');
});

Route::middleware(['superAdmin','manager','generalAdmin'])->group(function(){
    Route::get('/employee/list',[
        CalculasController::class,
        'bankEmployee'
    ])->name('bankEmployee');

    Route::post('/register/employee',[
        CalculasController::class,
        'employeeRegister'
    ])->name('employeeRegister');

    Route::get('/employee/edit/{id}',[
        FrontController::class,
        'editEmployee'
    ])->name('editEmployee');

    Route::get('/employee/del/{id}',[
        FrontController::class,
        'delEmployee'
    ])->name('delEmployee');

    // server configuration routes
    Route::get('/server/configuratoin/',[
        ServerConfiguration::class,
        'serverConfig'
    ])->name('serverConfig');

    Route::get('/server/bankLogo/del/{id}',[
        ServerConfiguration::class,
        'delBankLogo'
    ])->name('delBankLogo');

    Route::get('/server/secondLogo/del/{id}',[
        ServerConfiguration::class,
        'delSecondLogo'
    ])->name('delSecondLogo');

    Route::get('/server/thirdLogo/del/{id}',[
        ServerConfiguration::class,
        'delThirdLogo'
    ])->name('delThirdLogo');

    Route::post('/server/configuratoin/save',[
        ServerConfiguration::class,
        'saveServerConfig'
    ])->name('saveServerConfig');

    Route::post('/server/configuratoin/bankLogo/update',[
        ServerConfiguration::class,
        'saveBankLogo'
    ])->name('saveBankLogo');

    Route::post('/server/configuratoin/secondLogo/update',[
        ServerConfiguration::class,
        'saveSecondLogo'
    ])->name('saveSecondLogo');

    Route::post('/server/configuratoin/thirdLogo/update',[
        ServerConfiguration::class,
        'saveThirdLogo'
    ])->name('saveThirdLogo');

    Route::get('/server/employee',[
        CalculasViewController::class,
        'bankEmployee'
    ])->name('employeeList');

    Route::post('/server/employee/create',[
        CalculasController::class,
        'employeeRegister'
    ])->name('createEmployee');
});
