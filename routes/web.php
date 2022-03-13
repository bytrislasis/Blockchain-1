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


Route::get('/bitcoin', [\App\Http\Controllers\BitcoinController::class, 'BitcoinIndex'])->name('bitcoin');
Route::get('/bitcoinAdressOlustur', [\App\Http\Controllers\BitcoinController::class, 'bitcoinAdressOlustur'])->name('bitcoinAdressOlustur');
Route::get('/bitcoinNotify/{tx}', [\App\Http\Controllers\BitcoinController::class, 'bitcoinNotify'])->name('bitcoinNotify');
Route::post('/bitcoinCek', [\App\Http\Controllers\BitcoinController::class, 'bitcoinCek'])->name('bitcoinCek');
Route::post('/bitcoinUnlock', [\App\Http\Controllers\BitcoinController::class, 'bitcoinUnlock'])->name('bitcoinUnlock');







Route::get('/litecoin', [\App\Http\Controllers\LitecoinController::class, 'LitecoinIndex'])->name('litecoin');
Route::get('/litecoinAdressOlustur', [\App\Http\Controllers\LitecoinController::class, 'litecoinAdressOlustur'])->name('litecoinAdressOlustur');
Route::get('/litecoinNotify/{tx}', [\App\Http\Controllers\LitecoinController::class, 'litecoinNotify'])->name('litecoinNotify');
Route::post('/litecoinCek', [\App\Http\Controllers\LitecoinController::class, 'litecoinCek'])->name('litecoinCek');
Route::post('/litecoinUnlock', [\App\Http\Controllers\LitecoinController::class, 'litecoinUnlock'])->name('litecoinUnlock');




Route::get('/dogecoin', [\App\Http\Controllers\DogecoinController::class, 'DogecoinIndex'])->name('dogecoin');
Route::get('/dogecoinAdressOlustur', [\App\Http\Controllers\DogecoinController::class, 'dogecoinAdressOlustur'])->name('dogecoinAdressOlustur');
Route::get('/dogecoinNotify/{tx}', [\App\Http\Controllers\DogecoinController::class, 'dogecoinNotify'])->name('dogecoinNotify');
Route::post('/dogecoinCek', [\App\Http\Controllers\DogecoinController::class, 'dogecoinCek'])->name('dogecoinCek');
Route::post('/dogecoinUnlock', [\App\Http\Controllers\DogecoinController::class, 'dogecoinUnlock'])->name('dogecoinUnlock');


