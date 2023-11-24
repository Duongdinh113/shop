<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CarControllerller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Product;
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

Route::get('/', function () {
    return view('welcome');
});

Route::view('master', 'layouts.master');


route::resource('products', ProductController::class);

route::prefix('admin')
    ->as('admin.')
    ->group(function(){
        Route::get('dasboard', function () {
            return view('admin.dasboard');
        });
    Route::get('/Cars',[CarController::class, 'index'])->name('Cars.index');
    Route::get('/Cars/create',[CarController::class, 'create'])->name('Cars.create');
    Route::post('/Cars/store',[CarController::class, 'store'])->name('Cars.store');
    Route::get('/Cars/{Car}',[CarController::class, 'show'])->name('Cars.show');
    Route::get('/Cars/{Car}/edit',[CarController::class, 'edit'])->name('Cars.edit');
    Route::put('/Cars/{id}',[CarController::class, 'update'])->name('Cars.update');
    Route::delete('/Cars/{id}',[CarController::class, 'delete'])->name('Cars.delete');
    // Route::delete('/Cars/{id}',[CarController::class, 'delete'])->name('Cars.delete');

    Route::resource('cars', CarController::class);
    Route::resource('brands', BrandController::class);
});
