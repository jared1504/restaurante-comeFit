<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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



Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/categoria/{id}', [HomeController::class, 'show'])->name('home.show');
Route::get('/platillo/{id}', [HomeController::class, 'dish'])->name('home.dish');
Route::group(['middleware' => ['role:admin']], function () {
    
    Route::resource('user', App\Http\Controllers\UserController::class);
    
});


Route::resource('table', App\Http\Controllers\TableController::class);

Route::resource('supplier', App\Http\Controllers\SupplierController::class);

Route::resource('ingredient', App\Http\Controllers\IngredientController::class);

Route::resource('order', App\Http\Controllers\OrderController::class);

Route::resource('category', App\Http\Controllers\CategoryController::class);

Route::resource('dish', App\Http\Controllers\DishController::class);

Route::resource('sale', App\Http\Controllers\SaleController::class);
