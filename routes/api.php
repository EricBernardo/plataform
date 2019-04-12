<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

//    Route::get('user', 'UserController@index')->name('user.index');
//    Route::get('user/create', 'UserController@create')->name('user.create');
//    Route::get('user/edit/{id}', 'UserController@edit')->name('user.edit');
//    Route::put('user/update/{id}', 'UserController@update')->name('user.update');;
//    Route::post('user/store', 'UserController@store')->name('user.store');;
//    Route::delete('user/delete/{id}', 'UserController@destroy')->name('user.destroy');

    Route::group(['middleware' => ['role:root']], function () {

        Route::get('company', 'CompanyController@index')->name('company.index');
        Route::get('company/create', 'CompanyController@create')->name('company.create');
        Route::get('company/show/{id}', 'CompanyController@show')->name('company.show');
        Route::put('company/update/{id}', 'CompanyController@update')->name('company.update');;
        Route::post('company/store', 'CompanyController@store')->name('company.store');;
        Route::delete('company/delete/{id}', 'CompanyController@destroy')->name('company.destroy');

    });

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});
