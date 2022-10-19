<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PostController, DashboardController , HomeController };

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('{post:slug}', [HomeController::class, 'show'])->name('posts.show');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', PostController::class)->only(['index', 'create', 'store']);
});


require __DIR__.'/auth.php';
