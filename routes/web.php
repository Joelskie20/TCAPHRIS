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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::post('/dashboard', 'DashboardController@store');
    Route::put('/dashboard/{id}', 'DashboardController@update');

    Route::get('/daily-time-records', 'DtrController@index')->name('dtr');
    Route::get('/team-schedule', 'TeamScheduleController@index')->name('team-schedule');
    Route::get('/department', 'DepartmentController@index')->name('department');
    Route::get('/department/create', 'DepartmentController@create');
    Route::post('/department', 'DepartmentController@store');
    Route::delete('/department/{department}', 'DepartmentController@destroy');
    Route::get('/department/{department}/edit', 'DepartmentController@edit')->name('edit');
    Route::patch('/department/{department}', 'DepartmentController@update');
    // Route::resource('/department', 'DepartmentController')->name('department');
});