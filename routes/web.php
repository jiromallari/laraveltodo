<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/verify', [App\Http\Controllers\Auth\RegisterController::class, 'verifyUser'])->name('verify.user');


Route::get('/verify', 'App\Http\Controllers\Auth\RegisterController@verifyUser')->name('verify.user');


//
Route::resource('wallet', 'App/Http/Controllers/WalletController');
Route::resource('card', 'App/Http/Controllers/CardController');
Route::resource('transaction', 'App/Http/Controllers/TransactionController');

Route::get('/wallet', [App\Http\Controllers\WalletController::class, 'index'])->name('wallet');
Route::get('/transaction', [App\Http\Controllers\TransactionController::class, 'index'])->name('transaction');
Route::post('/transaction', [App\Http\Controllers\TransactionController::class, 'store'])->name('transaction.store');
Route::delete('/destroy/{transaction}', [App\Http\Controllers\TransactionController::class, 'destroy'])->name('transaction.destroy');
Auth::routes();
