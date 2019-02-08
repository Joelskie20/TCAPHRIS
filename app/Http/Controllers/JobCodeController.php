<?php

namespace App\Http\Controllers;

use App\JobCode;
use App\Division;
use App\Team;
use App\Account;
use App\Attendance;
use Illuminate\Http\Request;

class JobCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jobcode.index', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'job_codes' => JobCode::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobcode.create', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'divisions' => Division::all(),
            'teams' => Team::all(),
            'accounts' => Account::all(),
            'job_codes' => JobCode::all()
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
            'code' => 'required',
            'name' => 'required'
        ]);

        JobCode::create($request->all());

        session()->flash('message', 'Job Code added.');

        return redirect('/job-codes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobCode  $jobCode
     * @return \Illuminate\Http\Response
     */
    public function show(JobCode $jobCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobCode  $jobCode
     * @return \Illuminate\Http\Response
     */
    public function edit(JobCode $jobCode)
    {
        return view('jobcode.edit', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'divisions' => Division::all(),
            'teams' => Team::all(),
            'accounts' => Account::all(),
            'job_codes' => JobCode::all(),
            'job_code' => $jobCode
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobCode  $jobCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobCode $jobCode)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required'
        ]);

        $jobCode->update($request->all());

        session()->flash('message', 'Job Code updated.');

        return redirect('/job-codes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobCode  $jobCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobCode $jobCode)
    {
        $jobCode->delete();

        session()->flash('message', 'Job Code deleted.');

        return redirect('/job-codes');
    }
}
