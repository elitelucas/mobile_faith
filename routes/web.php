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

Auth::routes();

Route::view('/terms', 'faith.terms');
Route::view('/policy', 'faith.policy');
Route::group(['middleware' => 'auth'], function () {
    //admin
    Route::resource('/user', 'UserController');
    Route::resource('/pray', 'PrayController');
    Route::resource('/meditate', 'MeditateController');
    Route::resource('/background', 'BackgroundController');
});

//Add routes before this line only
Route::get('/{any}', 'HomeController@index');

Route::get('/', 'HomeController@root');
