<?php

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

Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');

    Route::get('logout', 'LoginController@logout')->name('logout');
});

Route::group(['namespace' => 'Dashboard', 'middleware' => 'auth:dashboard', 'as' => 'dashboard.'], function () {
    Route::get('/', 'DefaultController@showHomePage')->name('home');

    Route::get('account', 'AccountController@showAccountDetailsForm')->name('account');
    Route::put('account', 'AccountController@saveAccountDetails');

    Route::get('{section}', 'SectionController@showAttendancePage')->name('section');
});