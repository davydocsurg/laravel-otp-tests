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
})->name('welcome');

Auth::routes();

Route::get('verifyOTP', 'VerifyOTPController@showOTPForm')->name('otpPage');
Route::post('verifyOTP', 'VerifyOTPController@verify')->name('submitOTP');
Route::post('resendOTP', 'VerifyOTPController@resendOTP')->name('resendOTP');

Route::group(['middleware' => 'TwoFactorAuth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});
