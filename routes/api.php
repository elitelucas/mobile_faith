<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('user_login', 'API\AuthController@login');
Route::post('user_signup', 'API\AuthController@register');
Route::post('reset_password', 'API\AuthController@resetPassword');
Route::post('update_profile', 'API\AuthController@updateProfile');
Route::post('facebook_login', 'API\AuthController@facebookLogin');
Route::post('google_login', 'API\AuthController@googleLogin');
Route::post('apple_login', 'API\AuthController@appleLogin');

Route::post('add_pray', 'API\APIController@addPray');
Route::post('follow_pray', 'API\APIController@followPray');
Route::post('get_pray', 'API\APIController@getPray');
Route::post('invite_friend', 'API\APIController@inviteFriend');
Route::post('invite_pray', 'API\APIController@invitePray');
Route::post('get_invite', 'API\APIController@getInvite');
Route::post('get_meditate', 'API\APIController@getMeditate');
Route::post('get_background', 'API\APIController@getBackground');
Route::post('send_notification', 'API\APIController@sendNotification');
Route::post('test', 'API\APIController@test');

 

