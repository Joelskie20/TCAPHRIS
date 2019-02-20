<?php

namespace App\Http\Controllers;

use App\Overtime;
use App\Attendance;
use App\User;
use Carbon;
use Auth;
use Session;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('overtime.approving-overtimes', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'users' => User::all(),
            'overtimes' => Overtime::where('status', 'forApproval')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'overtime_date' => 'required',
            'time_in' => 'required',
            'time_out' => 'required'
        ]);

        Overtime::create([
            'user_id' => $request->employee_id,
            'date' => Carbon::parse($request->overtime_date),
            'time_in' => strtotime($request->time_in),
            'time_out' => strtotime($request->time_out),
            'filing_date' => Carbon::now(),
            // 'direct_manager_id' => User::where('id', $request->employee_id)->value('direct_manager_id'),
            'remarks' => $request->remarks
        ]);

        Session::flash('message', 'Leave added.');

        return redirect('/overtimes-for-approval');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Overtime  $overtime
     * @return \Illuminate\Http\Response
     */
    public function show(Overtime $overtime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Overtime  $overtime
     * @return \Illuminate\Http\Response
     */
    public function edit(Overtime $overtime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Overtime  $overtime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Overtime $overtime)
    {
        $overtime->update([
            'user_id' => $request->employee_id,
            'date' => Carbon::parse($request->overtime_date),
            'time_in' => strtotime($request->time_in),
            'time_out' => strtotime($request->time_out),
            'remarks' => $request->remarks
        ]);

        Session::flash('message', 'Leave updated.');

        return redirect('/overtimes-for-approval');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Overtime  $overtime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Overtime $overtime)
    {
        //
    }

    public function forApproval()
    {
        return view('overtime.forApproval', [
           'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
           'users' => User::all(),
           'overtimes' => Overtime::where('user_id', Auth::user()->id)->where('status', 'forApproval')->get()
        ]);
    }

    public function approved()
    {
        return view('overtime.approved', [
           'disabled' => (Attendance::checkAttendanceStatus()) ? true : false, 
           'users' => User::all(),
           'overtimes' => Overtime::where('user_id', Auth::id())->where('status', 'approved')->get()
        ]);
    }

    public function denied()
    {
        return view('overtime.denied', [
           'disabled' => (Attendance::checkAttendanceStatus()) ? true : false, 
           'users' => User::all(),
           'overtimes' => Overtime::where('user_id', Auth::id())->where('status', 'denied')->get()
        ]);
    }

    public function approvingOvertimes(Overtime $overtime)
    {
        $overtime->update([
            'status' => 'approved',
            'date_approved' => Carbon::now(),
            'approved_by' => Auth::user()->id
        ]);

        Session::flash('message', 'Overtime approved.');

        return redirect('/approving-overtimes');
    }

    public function denyingOvertimes(Overtime $overtime)
    {
        $overtime->update([
            'status' => 'denied',
            'date_denied' => Carbon::now(),
            'denied_by' => Auth::user()->id
        ]);

        Session::flash('message', 'Overtime denied.');

        return redirect('/approving-overtimes');
    }

    public function cancelled()
    {
        return view('overtime.cancelled', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false, 
            'users' => User::all(),
            'overtimes' => Overtime::where('user_id', Auth::id())->where('status', 'cancelled')->get()
        ]);
    }

    public function cancellingOvertimes(Request $request, Overtime $overtime)
    {
        $overtime->update([
            'status' => 'cancelled',
            'date_cancelled' => Carbon::now(),
            'cancelled_by' => Auth::user()->id
        ]);

        Session::flash('message', 'Overtime cancelled.');

        return redirect('/leaves-for-approval');
    }


}
