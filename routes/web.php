<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PartSumsController;
use App\Http\Controllers\BottleCollectorController;
use App\Http\Controllers\DisbursementController;
use App\Http\Controllers\ObligationRequestController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\FundTypeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\SubAccountController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\SignatoryController;
use App\Http\Controllers\PayeeController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\JournalController;




Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::resource('users', UserController::class)->except(['index']);
    Route::resource('disbursements', DisbursementController::class);
    
    Route::get('/users/{id}/fundtype', [UserController::class, 'editFundType'])->name('users.editFundType');
    Route::put('/users/{id}/fundtype', [UserController::class, 'updateFundType'])->name('users.updateFundType');
    // routes/web.php
    Route::prefix('tools')->name('tools.')->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('fundtypes', FundTypeController::class);
        Route::resource('tags', TagController::class);
        Route::resource('subaccounts', SubAccountController::class);
        Route::resource('barangays', BarangayController::class);
        Route::resource('banks', BankController::class);
        Route::resource('payees', PayeeController::class);
        Route::resource('signatories', SignatoryController::class);
        Route::resource('offices', OfficeController::class);
        Route::resource('expense_types', ExpenseTypeController::class);
    });
    Route::resource('journals', JournalController::class); 
    Route::get('/tools', function () {
    return view('tools.layout'); 
    })->name('tools.index');





    Route::get('/obligations', [ObligationRequestController::class, 'index'])->name('obligations.index');
    Route::get('/obligations/{id}', [ObligationRequestController::class, 'show'])->name('obligations.show');
    Route::get('/disbursements/create-from-obr/{obr}', [DisbursementController::class, 'createFromObr'])
    ->name('disbursements.createFromObr');

    Route::get('/employee', [EmployeeController::class, 'index'])->name('employees.index');
    Route::resource('employees', EmployeeController::class)->except(['index', 'show']);

    Route::get('/employees/summary', [EmployeeController::class, 'summary'])->name('employees.summary');
    //Machine 1 problem route
    Route::get('/partsums', [PartSumsController::class, 'index'])->name('partsums.index');
    Route::post('/partsums/calculate', [PartSumsController::class, 'calculate'])->name('partsums.calculate');
    //Machine 2 vproblem route

Route::get('/bottle-collector', [BottleCollectorController::class, 'index'])->name('bottle.collector.index');
Route::post('/bottle-collector/calculate', [BottleCollectorController::class, 'calculate'])->name('bottle.collector.calculate');

});
