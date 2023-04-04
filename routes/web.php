<?php

use App\Http\Controllers\ManageController;
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

Route::get('/',[ManageController::class,'home'])->name('home');
Route::post('/',[ManageController::class,'productStore'])->name('product.store');
Route::post('/get-products',[ManageController::class,'CategoryProduct'])->name('category.product');
