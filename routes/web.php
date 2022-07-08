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
    return view('auth/login');
});

Route::group(['middleware' => ['auth']], function(){
    Route::POST('/dashboard', 'App\Http\Controllers\CaseController@store')->name('dashboard.store');
    Route::GET('/dashboard', 'App\Http\Controllers\CaseController@create')->name('dashboard.create');
    Route::GET('/dashboard', 'App\Http\Controllers\CaseController@show')->name('dashboard');
});



require __DIR__ . '/auth.php';
