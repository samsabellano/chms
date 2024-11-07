<?php

use App\Http\Controllers\Inertia\Admin\MemberController;
use App\Http\Controllers\Inertia\AuthController;
use App\Http\Controllers\Inertia\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/signin', [AuthController::class, 'signin']);

Route::prefix('admin')->group(function () {
    Route::controller(DashboardController::class)
        ->prefix('dashboard')
        ->group(function () {
            Route::get('/', 'index')->name('admin.dashboard');
        });

    Route::controller(MemberController::class)
        ->prefix('member')
        ->group(function () {
            Route::get('/', 'index')->name('admin.member');
            Route::get('/create', 'createMember')->name('admin.member.create');
            Route::delete('/delete/{member}', 'deleteMember')->name('admin.member.delete');
        });
});
