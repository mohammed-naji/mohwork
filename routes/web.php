<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Services\GlobalService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    // return view('dashboard');
    if(Auth::guard('admin')->check()) {
        return redirect('/admin/dashboard');
    }else {
        return redirect('/user/dashboard');
    }
})->middleware(['auth:web,admin', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Test routes
Route::get('/send-notification', [TestController::class, 'send']);
Route::get('/read-notification/{id}', [TestController::class, 'read'])->name('read');


// Api Test
Route::get('products', [ApiController::class, 'products']);
Route::get('weather', [ApiController::class, 'weather']);


// Website Routes
Route::get('/', [HomeController::class, 'index'])->name('front.home');

Route::get('/project/{project:slug}', [HomeController::class, 'project'])->name('front.project');
Route::post('/project/{project:slug}/apply', [HomeController::class, 'project_apply'])->name('front.project_apply');

// GlobalService::Routes();

//



// Real Madrid Sign New Player

// news/real-madrid-sign-new-player
//
