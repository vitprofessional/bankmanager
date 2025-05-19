<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculasViewController;
use App\Http\Controllers\CalculasReportController;
use App\Http\Controllers\DebitCreditController;
use App\Http\Controllers\CalculasController;
use App\Http\Controllers\FrontController;

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
