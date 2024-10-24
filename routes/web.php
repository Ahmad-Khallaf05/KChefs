<?php

use App\Http\Controllers\ChefController;
use App\Http\Controllers\Dish_CategoryController;
use App\Http\Controllers\dishController;
use App\Http\Controllers\HomeChefController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeDishController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dash', function () {
    return view('./dashboard/dashboard');
})->middleware('admin')->name('admin.dashboard');


Route::middleware('admin')->group(function () {

    Route::resource('/dash/users', UserController::class)->middleware('admin')->names([
        'index' => 'users.dashboard.index',
        'create' => 'users.dashboard.create',
        'store' => 'users.dashboard.store',
        'edit' => 'users.dashboard.edit',
        'update' => 'users.dashboard.update',
        'destroy' => 'users.dashboard.destroy',
        'show' => 'users.dashboard.show',
    ]);

    Route::resource('/dash/chefs', ChefController::class)->middleware('admin')->names([
        'index' => 'chefs.dashboard.index',
        'create' => 'chefs.dashboard.create',
        'store' => 'chefs.dashboard.store',
        'edit' => 'chefs.dashboard.edit',
        'update' => 'chefs.dashboard.update',
        'destroy' => 'chefs.dashboard.destroy',
        'show' => 'chefs.dashboard.show',
    ]);

    Route::resource('/dash/dishes', dishController::class)->middleware('admin')->names([
        'index' => 'dishes.dashboard.index',
        'create' => 'dishes.dashboard.create',
        'store' => 'dishes.dashboard.store',
        'edit' => 'dishes.dashboard.edit',
        'update' => 'dishes.dashboard.update',
        'destroy' => 'dishes.dashboard.destroy',
        'show' => 'dishes.dashboard.show',
    ]);

    Route::resource('/dash/categories', Dish_CategoryController::class)->middleware('admin')->names([
        'index' => 'categories.dashboard.index',
        'create' => 'categories.dashboard.create',
        'store' => 'categories.dashboard.store',
        'edit' => 'categories.dashboard.edit',
        'update' => 'categories.dashboard.update',
        'destroy' => 'categories.dashboard.destroy',
        'show' => 'categories.dashboard.show',
    ]);
    
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/chefs', [HomeChefController::class, 'index'])->name('chefs');

Route::get('/dishes', [HomeDishController::class, 'index'])->name('dishes');


Route::post('/logout', function (Request $request) {
    Auth::logout();
    return redirect('/home'); 
})->name('logout');


