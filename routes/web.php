<?php

use App\Http\Controllers\Admin\brandController;
use App\Http\Controllers\ProductController;
use App\Models\Brand;
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
    Route::get('/brands',[brandController::class, 'index'])->name('brands.index');
    Route::get('/brands/create',[brandController::class, 'create'])->name('brands.create');
    Route::post('/brands/store',[brandController::class, 'store'])->name('brands.store');
    Route::get('/brands/{brand}',[brandController::class, 'show'])->name('brands.show');
    Route::get('/brands/{brand}/edit',[brandController::class, 'edit'])->name('brands.edit');
    Route::put('/brands/{id}',[brandController::class, 'update'])->name('brands.update');
    Route::delete('/brands/{id}',[brandController::class, 'delete'])->name('brands.delete');
    // Route::delete('/brands/{id}',[brandController::class, 'delete'])->name('brands.delete');
});
