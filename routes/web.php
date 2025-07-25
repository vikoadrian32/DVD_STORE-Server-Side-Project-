<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StokController;
use App\Models\Account;
use App\Models\Film;

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
    return redirect('/login');
});

Route::get('/login', [AccountController::class, 'index'])->name('login'); // halaman login
Route::post('/login', [AccountController::class, 'login']); // proses login


Route::middleware(['auth:accounts'])->group(function(){
    Route::get('/home',[FilmController::class,'index']);
    Route::get('/film/show/{id}',[FilmController::class,'show']);
    Route::post('/order_ticket',[OrderController::class,'orderTicket']);
    Route::get('/orders',[OrderController::class,'getTicket']);
});

Route::post('/coba_masuk',[AccountController::class,'regist']);
Route::get('/adminLog',function(){
    return view('admin/loginAdmin');
});

Route::post('/admin/login',[AccountController::class,'adminLogin']);
Route::get('/logout',[AccountController::class,'logout']);


Route::middleware(['admin'])->group(function(){
    Route::get('/admin/update/{id}',[FilmController::class,'update']);
    Route::get('/admin',[FilmController::class,'admin'])->middleware('admin');
    Route::get('/movie/add',[FilmController::class,'add']);
    Route::get('/movie/add/again/',[FilmController::class,'formAttr']);
    Route::get('/genre',[GenreController::class,'index']);
    Route::get('/genre/add',[GenreController::class,'add']);
    Route::get('/genre/update/{id}',[GenreController::class,'update']);
    Route::get('/genre/delete/{id}',[GenreController::class,'delete']);
    Route::get('/stok/update/{id}',[StokController::class,'update']);
    Route::get('/stok/delete/{id}',[StokController::class,'delete']);
    Route::get('/stok',[StokController::class,'index']);
    Route::get('/stok/add',[StokController::class,'add']);
    Route::get('/movie/update/{id}',[FilmController::class,'update']);
    Route::post('/genre/save',[GenreController::class,'save']);
    Route::post('/genre/delete/{id}',[GenreController::class,'delete']);
    Route::post('/stok/save',[StokController::class,'save']);
    Route::post('/stok/delete/{id}',[StokController::class,'delete']);
    Route::post('/movie/save',[FilmController::class,'save']);
    Route::post('/movie/delete/{id}',[FilmController::class,'delete']);
    Route::post('/movie/attribute/save',[FilmController::class,'attrAdd']);
    Route::post('/admin/delete/{id}',[FilmController::class,'delete']);
});








