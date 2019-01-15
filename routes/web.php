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
    Route::get('/daily-time-records/', 'DtrController@index')->name('dtr');
    Route::get('/daily-time-records/{id}', 'DtrController@dtrSolo');

    Route::get('/team-schedule', 'TeamScheduleController@index')->name('team-schedule');

    Route::get('/departments', 'DepartmentController@index')->name('departments');
    Route::get('/departments/create', 'DepartmentController@create');
    Route::post('/departments', 'DepartmentController@store');
    Route::get('/departments/{department}/edit', 'DepartmentController@edit')->name('edit');
    Route::patch('/departments/{department}', 'DepartmentController@update');
    Route::delete('/departments/{department}', 'DepartmentController@destroy');

    Route::get('/teams', 'TeamController@index')->name('teams');
    Route::get('/teams/create', 'TeamController@create');
    Route::post('/teams', 'TeamController@store');
    Route::get('/teams/{team}/edit', 'TeamController@edit');
    Route::patch('/teams/{team}', 'TeamController@update');
    Route::delete('/teams/{team}', 'TeamController@destroy');

    Route::get('/positions', 'PositionController@index')->name('positions');
    Route::get('/positions/create', 'PositionController@create');
    Route::post('/positions', 'PositionController@store');
    Route::get('/positions/{position}/edit', 'PositionController@edit');
    Route::patch('/positions/{position}', 'PositionController@update');
    Route::delete('/positions/{position}', 'PositionController@destroy');

    Route::get('/employees', 'EmployeeController@index')->name('employees');
    Route::get('/employees/create', 'EmployeeController@create')->name('employee-create');
    Route::post('/employees/', 'EmployeeController@store');
    Route::get('/employees/{user}/edit', 'EmployeeController@edit');
    Route::patch('/employees/{user}', 'EmployeeController@update');
    Route::get('/employee/{employee}', 'EmployeeController@show');

    Route::get('/workshifts', 'WorkshiftController@index')->name('workshift');
    Route::get('/workshifts/create', 'WorkshiftController@create');
    Route::post('/workshifts', 'WorkshiftController@store');
    Route::get('/workshifts/{workshift}/edit', 'WorkshiftController@edit');
    Route::patch('/workshifts/{workshift}', 'WorkshiftController@update');
    Route::delete('/workshifts/{workshift}', 'WorkshiftController@destroy');

    Route::get('/workshifts/{workshift}', 'WorkshiftController@show');
});