<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now  something great!
|
*/

Auth::routes();
Route::get('/', function () {
    return redirect()->route('home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/user/profile', 'UserController@edit')->name('user.edit');
    Route::post('/user/profile', 'UserController@update')->name('user.update');

    Route::get('/recycling', 'RecyclingOperationsController@index')->name('recycling.index');
    Route::get('/recycling/create', 'RecyclingOperationsController@create')->name('recycling.create');
    Route::post('/recycling/create', 'RecyclingOperationsController@store')->name('recycling.store');

    Route::get('/recycling/edit/{recycling}', 'RecyclingOperationsController@edit')->name('recycling.edit');
    Route::post('/recycling/edit/{recycling}', 'RecyclingOperationsController@update')->name('recycling.update');

    Route::get('/recycling/waiting', 'RecyclingOperationsController@waiting_approved')->name('recycling.waiting_approved');
    Route::get('/recycling/waiting/{recycling}/{confirm}', 'RecyclingOperationsController@confirm')->name('recycling.confirm');

    Route::get('/payment', 'PaymentController@index')->name('payment.index');
    Route::get('/payment/wait', 'PaymentController@waiting')->name('payment.waiting');
    Route::get('/payment/update/{payment}/{operation}', 'PaymentController@update')->name('payment.update');

    Route::get('/payment/{payment_type}', 'PaymentController@store')->name('payment.store');

});
