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
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // User management - Admin only
    Route::middleware(['permission:manage users'])->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::resource('users', UserController::class)->except(['index']);
    });

    // Fund type management for users
    Route::get('/users/{id}/fundtype', [UserController::class, 'editFundType'])->name('users.editFundType');
    Route::put('/users/{id}/fundtype', [UserController::class, 'updateFundType'])->name('users.updateFundType');
    // ==================== DISBURSEMENT ROUTES ====================
    // 1. CREATE routes - MUST come FIRST (most specific)
    Route::middleware(['permission:create disbursements'])->group(function () {
        Route::get('/disbursements/create', [DisbursementController::class, 'create'])->name('disbursements.create');
        Route::get('/disbursements/create-from-obr/{obr}', [DisbursementController::class, 'createFromObr'])
            ->name('disbursements.createFromObr');
        Route::post('/disbursements', [DisbursementController::class, 'store'])->name('disbursements.store');
    });

    // 2. SPECIFIC ACTION routes (with suffixes like /edit, /approve, etc.)
    Route::middleware(['permission:edit disbursements'])->group(function () {
        Route::get('/disbursements/{disbursement}/edit', [DisbursementController::class, 'edit'])->name('disbursements.edit');
        Route::put('/disbursements/{disbursement}', [DisbursementController::class, 'update'])->name('disbursements.update');
    });

    Route::middleware(['permission:approve disbursements'])->group(function () {
        Route::post('/disbursements/{id}/approve', [DisbursementController::class, 'approve'])->name('disbursements.approve');
        Route::post('/disbursements/{id}/reject', [DisbursementController::class, 'reject'])->name('disbursements.reject');
    });

    Route::middleware(['permission:process disbursements'])->group(function () {
        Route::post('/disbursements/{id}/process', [DisbursementController::class, 'process'])->name('disbursements.process');
    });

    Route::post('/disbursements/{id}/cancel', [DisbursementController::class, 'cancel'])->name('disbursements.cancel');

    // 3. INDEX route (no parameters)
    Route::middleware(['permission:view disbursements'])->group(function () {
        Route::get('/disbursements', [DisbursementController::class, 'index'])->name('disbursements.index');
    });

    // 4. DELETE route (parameterized)
    Route::middleware(['permission:delete disbursements'])->group(function () {
        Route::delete('/disbursements/{disbursement}', [DisbursementController::class, 'destroy'])->name('disbursements.destroy');
    });

    // 5. SHOW route - MUST be LAST (will match ANY /disbursements/{anything})
    Route::middleware(['permission:view disbursements'])->group(function () {
        Route::get('/disbursements/{disbursement}', [DisbursementController::class, 'show'])->name('disbursements.show');
    });
    // Obligation management
    Route::middleware(['permission:view obligations'])->group(function () {
        Route::get('/obligations', [ObligationRequestController::class, 'index'])->name('obligations.index');
        Route::get('/obligations/{id}', [ObligationRequestController::class, 'show'])->name('obligations.show');
    });

    // Employee management
    Route::middleware(['permission:view employees'])->group(function () {
        Route::get('/employee', [EmployeeController::class, 'index'])->name('employees.index');
        Route::get('/employees/summary', [EmployeeController::class, 'summary'])->name('employees.summary');
    });

    Route::middleware(['permission:create employees'])->group(function () {
        Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    });

    Route::middleware(['permission:edit employees'])->group(function () {
        Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    });

    Route::middleware(['permission:delete employees'])->group(function () {
        Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    });

// ==================== JOURNAL ROUTES ====================
// 1. CREATE routes - MUST come FIRST (most specific)
Route::middleware(['permission:create journals'])->group(function () {
    Route::get('/journals/create', [JournalController::class, 'create'])->name('journals.create');
    Route::post('/journals', [JournalController::class, 'store'])->name('journals.store');
});

// 2. EDIT route (has /edit suffix)
Route::middleware(['permission:edit journals'])->group(function () {
    Route::get('/journals/{journal}/edit', [JournalController::class, 'edit'])->name('journals.edit');
    Route::put('/journals/{journal}', [JournalController::class, 'update'])->name('journals.update');
});

// 3. INDEX route (no parameters)
Route::middleware(['permission:view journals'])->group(function () {
    Route::get('/journals', [JournalController::class, 'index'])->name('journals.index');
});

// 4. DELETE route (parameterized)
Route::middleware(['permission:delete journals'])->group(function () {
    Route::delete('/journals/{journal}', [JournalController::class, 'destroy'])->name('journals.destroy');
});

// 5. SHOW route - MUST be LAST (will match ANY /journals/{anything})
Route::middleware(['permission:view journals'])->group(function () {
    Route::get('/journals/{journal}', [JournalController::class, 'show'])->name('journals.show');
});
    // System Tools - Admin only
    Route::middleware(['permission:manage system'])->group(function () {
        Route::get('/tools', function () {
            return view('tools.layout'); 
        })->name('tools.index');

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
    });

    // Activity Logs - Admin only
    Route::middleware(['permission:manage system'])->group(function () {
        Route::get('/activity-logs', [App\Http\Controllers\UserActivityController::class, 'index'])->name('activity-logs.index');
        Route::get('/activity-logs/statistics', [App\Http\Controllers\UserActivityController::class, 'statistics'])->name('activity-logs.statistics');
        Route::get('/activity-logs/export', [App\Http\Controllers\UserActivityController::class, 'export'])->name('activity-logs.export');
        Route::get('/activity-logs/user/{userId}', [App\Http\Controllers\UserActivityController::class, 'userActivity'])->name('activity-logs.user');
    });

    // My Activity (for current user)
    Route::get('/my-activity', [App\Http\Controllers\UserActivityController::class, 'myActivity'])->name('activity-logs.my-activity');

    // Utility routes (for testing/development)
    Route::get('/partsums', [PartSumsController::class, 'index'])->name('partsums.index');
    Route::post('/partsums/calculate', [PartSumsController::class, 'calculate'])->name('partsums.calculate');
    Route::get('/bottle-collector', [BottleCollectorController::class, 'index'])->name('bottle.collector.index');
    Route::post('/bottle-collector/calculate', [BottleCollectorController::class, 'calculate'])->name('bottlecollector.calculate');
});
