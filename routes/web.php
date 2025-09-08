<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PartSumsController;
use App\Http\Controllers\BottleCollectorController;
use App\Http\Controllers\DisbursementController;


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::resource('users', UserController::class)->except(['index']);

    Route::resource('disbursements', DisbursementController::class);
    

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
