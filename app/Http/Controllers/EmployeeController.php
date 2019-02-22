<?php

namespace App\Http\Controllers;

use Session;
use App\{User, Attendance, Gender, Division, Team, Account, JobCode, Position, Workshift};
use Auth;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.index', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'employees' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'genders' => Gender::all(),
            'divisions' => Division::all(),
            'teams' => Team::all(),
            'accounts' => Account::all(),
            'job_codes' => JobCode::all(),
            'positions' => Position::all(),
            'workshifts' => Workshift::all(),
            'employees' => User::all(),
            'roles' => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required'
        ]);

        $user = new User;

        $user->createUser($request);

        Session::flash('message', 'User has been created.');

        return redirect('/employees');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $employee)
    {
        return view('employee.show', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'employee' => $employee
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // dd('edit: ' . $user->id);
        return view('employee.edit', [
            'user' => $user,
            'employees' => User::all(),
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'genders' => Gender::all(),
            // 'departments' => Department::all(),
            'divisions' => Division::all(),
            'teams' => Team::all(),
            'accounts' => Account::all(),
            'job_codes' => JobCode::all(),
            'positions' => Position::all(),
            'workshifts' => Workshift::all(),
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = User::findOrFail($user->id);

        $user->updateUser($request, $user);

        // $user->leaves()->update([
        //     'direct_manager_id' => $request->direct_manager_id
        // ]);

        Session::flash('message', 'User has been updated.');

        return redirect('/employees/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $employee)
    {
        $employee->delete();

        Session::flash('message', 'User has been deleted.');

        return redirect('/employees');
    }

    public function importEmployees(Request $request)
    {
        dd('file');
    }
}
