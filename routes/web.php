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

    Route::group(['middleware' => ['permission:dashboard']], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::post('/dashboard', 'DashboardController@store')->middleware('permission:time in');
        Route::put('/dashboard/{id}', 'DashboardController@update')->middleware('permission:time out');
    });

    Route::group(['middleware' => ['permission:daily time records']], function() {
        Route::get('/daily-time-records/', 'DtrController@index')->name('dtr');
        Route::get('/daily-time-records/{id}', 'DtrController@show')->name('dtr-profile')->middleware('permission:view DTR based on user ID');
        Route::post('/daily-time-records/export-attendance', 'DtrController@exportToExcel');
    });

    // Route::get('/team-schedule', 'TeamScheduleController@index')->name('team-schedule');

    Route::group(['middleware' => ['permission:departments']], function () {
        Route::get('/departments', 'DepartmentController@index')->name('departments');
        Route::get('/departments/create', 'DepartmentController@create')->middleware('permission:add department');
        Route::post('/departments', 'DepartmentController@store')->middleware('permission:add department');
        Route::get('/departments/{department}/edit', 'DepartmentController@edit')->name('edit')->middleware('permission:edit department');
        Route::patch('/departments/{department}', 'DepartmentController@update')->middleware('permission:edit department');
        Route::delete('/departments/{department}', 'DepartmentController@destroy')->middleware('permission:delete department');
    });

    Route::group(['middleware' => ['permission:teams']], function () {
        Route::get('/teams', 'TeamController@index')->name('teams');
        Route::get('/teams/create', 'TeamController@create')->middleware('permission:add team');
        Route::post('/teams', 'TeamController@store')->middleware('permission:add team');
        Route::get('/teams/{team}/edit', 'TeamController@edit')->middleware('permission:edit team');
        Route::patch('/teams/{team}', 'TeamController@update')->middleware('permission:edit team');
        Route::delete('/teams/{team}', 'TeamController@destroy')->middleware('permission:delete team');
    });

    Route::group(['middleware' => ['permission:positions']], function () {
        Route::get('/positions', 'PositionController@index')->name('positions');
        Route::get('/positions/create', 'PositionController@create')->middleware('permission:add position');
        Route::post('/positions', 'PositionController@store')->middleware('permission:add position');
        Route::get('/positions/{position}/edit', 'PositionController@edit')->middleware('permission:edit position');
        Route::patch('/positions/{position}', 'PositionController@update')->middleware('permission:edit position');
        Route::delete('/positions/{position}', 'PositionController@destroy')->middleware('permission:delete position');
    });

    Route::group(['middleware' => ['permission:employee records']], function () {
        Route::get('/employees', 'EmployeeController@index')->name('employees');
        Route::get('/employees/create', 'EmployeeController@create')->name('employee-create')->middleware('permission:add employee');
        Route::post('/employees/', 'EmployeeController@store')->middleware('permission:add employee');
        Route::get('/employees/{user}/edit', 'EmployeeController@edit')->middleware('permission:edit employee');
        Route::patch('/employees/{user}', 'EmployeeController@update')->middleware('permission:edit employee');
        Route::get('/employee/{employee}', 'EmployeeController@show')->name('employee-profile')->middleware('permission:view employee profile');
        Route::delete('/employee/{employee}', 'EmployeeController@destroy')->middleware('permission:view employee profile');
    });

    Route::group(['middleware' => ['permission:workshifts']], function () {
        Route::get('/workshifts', 'WorkshiftController@index')->name('workshift');
        Route::get('/workshifts/create', 'WorkshiftController@create')->middleware('permission:add workshift');
        Route::post('/workshifts', 'WorkshiftController@store')->middleware('permission:add workshift');
        Route::get('/workshifts/{workshift}/edit', 'WorkshiftController@edit')->middleware('permission:edit workshift');
        Route::patch('/workshifts/{workshift}', 'WorkshiftController@update')->middleware('permission:edit workshift');
        Route::delete('/workshifts/{workshift}', 'WorkshiftController@destroy')->middleware('permission:delete workshift');
        Route::get('/workshifts/{workshift}', 'WorkshiftController@show');
    });

    Route::group(['middleware' => ['permission:leaves']], function () {
        Route::get('/approved-leaves', 'LeaveController@approved')->name('approved-leaves')->middleware('permission:approved leaves');
        Route::get('/denied-leaves', 'LeaveController@denied')->name('denied-leaves')->middleware('permission:denied leaves');
        Route::get('/leaves-for-approval', 'LeaveController@forApproval')->name('leaves-for-approval')->middleware('permission:leaves for approval');
        Route::get('/approving-leaves', 'LeaveController@index')->name('approving-leaves')->middleware('permission:can approve leaves');
        Route::post('/leaves', 'LeaveController@store')->middleware('permission:add leave');
        Route::patch('/leaves/{leave}', 'LeaveController@update')->middleware('permission:edit leave');
        Route::patch('/approving-leaves/{leave}', 'LeaveController@approvingLeaves')->middleware('permission:can approve leaves');
        Route::patch('/denying-leaves/{leave}', 'LeaveController@denyingLeaves')->middleware('permission:can approve leaves');
        Route::delete('/leaves/{leave}', 'LeaveController@destroy')->middleware('permission:delete leave');
    });

    Route::group(['middleware' => ['permission:holidays']], function () {
        Route::get('/company-calendar', 'HolidayController@index')->name('holiday');
        Route::post('/company-calendar', 'HolidayController@store')->middleware('permission:add holiday');
        Route::patch('/company-calendar/{holiday}', 'HolidayController@update')->middleware('permission:edit holiday');
        Route::delete('/company-calendar/{holiday}', 'HolidayController@destroy')->middleware('permission:delete holiday');
    });

    Route::group(['middleware' => ['role:superadmin|admin']], function() {
        Route::get('/roles', 'RoleController@index')->name('roles');
        Route::post('/roles', 'RoleController@store');
        Route::patch('/roles/{role}', 'RoleController@update');
        Route::delete('/roles/{role}', 'RoleController@destroy');

        Route::get('/permissions/role/{role}', 'RoleController@edit');
        Route::patch('/permissions/role/{role}', 'PermissionController@update');
        Route::delete('/permissions/role/{role}', 'PermissionController@destroy');
    });

    Route::get('/settings', 'DashboardController@settings');
    Route::post('/settings/changePassword', 'DashboardController@changePassword');

});