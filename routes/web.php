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

Route::get('/', 'Auth\LoginController@showLoginForm')->middleware('guest');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::post('/dashboard', 'DashboardController@store');
Route::put('/dashboard/{id}', 'DashboardController@update');
Route::get('/dailytimerecords', function() {
    $disabled = (\App\Attendance::checkAttendanceStatus()) ? true : false;
    return view('dtr.index', compact('disabled'));
})->name('dtr');