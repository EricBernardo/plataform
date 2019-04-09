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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {


    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes

    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::get('/home', 'DashboardController@index')->name('dashboard.index');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

    Route::group(['middleware' => ['role:root|administrator']], function () {

        Route::get('user', 'UserController@index')->name('user.index');
        Route::get('user/create', 'UserController@create')->name('user.create');
        Route::get('user/edit/{id}', 'UserController@edit')->name('user.edit');
        Route::put('user/update/{id}', 'UserController@update')->name('user.update');;
        Route::post('user/store', 'UserController@store')->name('user.store');;
        Route::delete('user/delete/{id}', 'UserController@destroy')->name('user.destroy');

        Route::group(['middleware' => ['role:root']], function () {

            Route::get('company', 'CompanyController@index')->name('company.index');
            Route::get('company/create', 'CompanyController@create')->name('company.create');
            Route::get('company/edit/{id}', 'CompanyController@edit')->name('company.edit');
            Route::put('company/update/{id}', 'CompanyController@update')->name('company.update');;
            Route::post('company/store', 'CompanyController@store')->name('company.store');;
            Route::delete('company/delete/{id}', 'CompanyController@destroy')->name('company.destroy');

        });

    });

});
