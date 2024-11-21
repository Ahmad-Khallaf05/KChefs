<?php

use App\Http\Controllers\ChefController;
use App\Http\Controllers\ChefDishController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dish_CategoryController;
use App\Http\Controllers\dishController;
use App\Http\Controllers\HomeChefController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeDishController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChefSpecialtyController;
use App\Http\Controllers\Auth\SocialiteController;



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

Route::get('/profile', [UserController::class, 'viewProfile'])->name('profile');

Route::get('/dash', [DashboardController::class, 'index'])->middleware('admin')->name('admin.dashboard');


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

    Route::resource('/dash/dishes', DishController::class)->middleware('admin')->names([
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

    Route::resource('/dash/chef-specialties', ChefSpecialtyController::class)->middleware('admin')->names([
        'index' => 'chef_specialties.dashboard.index',
        'create' => 'chef_specialties.dashboard.create',
        'store' => 'chef_specialties.dashboard.store',
        'edit' => 'chef_specialties.dashboard.edit',
        'update' => 'chef_specialties.dashboard.update',
        'destroy' => 'chef_specialties.dashboard.destroy',
        'show' => 'chef_specialties.dashboard.show',
    ]);
    Route::resource('/dash/contacts', ContactUsController::class)->middleware('admin')->names([
        'index' => 'contacts.dashboard.index',
        'destroy' => 'contacts.dashboard.destroy',
        'show' => 'contacts.dashboard.show',
    ]);
    Route::resource('/dash/ChefDishes', ChefDishController::class)->middleware('admin')->names([
        'index' => 'ChefDishes.dashboard.index',
        'create' => 'ChefDishes.dashboard.create',
        'store' => 'ChefDishes.dashboard.store',
        'edit' => 'ChefDishes.dashboard.edit',
        'update' => 'ChefDishes.dashboard.update',
        'destroy' => 'ChefDishes.dashboard.destroy',
        'show' => 'ChefDishes.dashboard.show',
    ]);
    

});


Auth::routes();

Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/contacts', [ContactUsController::class, 'userindex'])->name('contacts');
Route::post('/contacts', [ContactUsController::class, 'store'])->name('contacts.create');

Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.create');


Route::get('/chefs', [HomeChefController::class, 'index'])->name('chefs');
Route::get('/chefs/{chef}', [HomeChefController::class, 'show'])->name('chefs.show');

Route::get('/dishes', [HomeDishController::class, 'index'])->name('dishes.index');
Route::get('/dishes/{dish}', [HomeDishController::class, 'show'])->name('dishes.show');


Route::post('/logout', function (Request $request) {
    Auth::logout();
    return redirect('/home');
})->name('logout');


