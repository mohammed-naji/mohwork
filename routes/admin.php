<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\PaymentController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    // Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function() {
    // Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function() {
    Route::prefix('admin')->name('admin.')->middleware('admin_auth')->group(function() {
        Route::get('/dashboard/{lang?}', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::post('/profile', [AdminController::class, 'profile_update'])->name('profile');
        Route::post('/profile/image', [AdminController::class, 'profile_image'])->name('profile_image');

        Route::get('/profile/password', [AdminController::class, 'profile_password'])->name('profile_password');
        Route::post('/profile/password', [AdminController::class, 'profile_password_update']);

        Route::resource('questions', QuestionController::class);

        Route::get('/projects/{project}/pay', [PaymentController::class, 'pay'])->name('projects.pay');
        Route::get('/projects/{project}/status', [PaymentController::class, 'status'])->name('projects.status');
        Route::get('/projects/payment/thanks', [PaymentController::class, 'thanks'])->name('projects.thanks');



        Route::get('/projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
        Route::get('/projects/{project}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
        Route::delete('/projects/{project}/forcedelete', [ProjectController::class, 'forcedelete'])->name('projects.forcedelete');
        Route::resource('projects', ProjectController::class);

    });
});




//
