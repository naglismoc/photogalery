<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;

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

Route::get('/', function () {
    return view('welcome');
});



Route::group(['prefix'=>'user'],function(){
    Route::get('/',[UserController::class,'index'])->name('user.index');
    Route::get('/create',[UserController::class,'create'])->name('user.create');
    Route::get('/edit/{User}',[UserController::class,'edit'])->name('user.edit');
    Route::post('/store',[UserController::class,'store'])->name('user.store');
    Route::post('/update/{User}',[UserController::class,'update'])->name('user.update');
    Route::get('/deletePhoto',[UserController::class,'deletePhoto'])->name('user.deletePhoto');

});


Route::group(['prefix'=>'photo'],function(){
    Route::get('/',[PhotoController::class,'index'])->name('photo.index');
    Route::get('/create',[PhotoController::class,'create'])->name('photo.create');
    Route::get('/edit/{User}',[PhotoController::class,'edit'])->name('photo.edit');
    Route::post('/store',[PhotoController::class,'store'])->name('photo.store');
    Route::post('/update/{User}',[PhotoController::class,'update'])->name('photo.update');
    Route::get('/deletePhoto/{Photo}',[PhotoController::class,'deletePhoto'])->name('photo.deletePhoto');

});




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
