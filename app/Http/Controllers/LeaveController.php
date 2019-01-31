<?php

namespace App\Http\Controllers;

use App\Leave;
use App\Attendance;
use App\User;
use Carbon\Carbon;
use Auth;
use Session;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leaves.approving-leaves', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'users' => User::all(),
            'leaves' => Leave::where([
                'status' => 'forApproval',
                'direct_manager_id' => Auth::user()->id
            ])->get()
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
            'leave_date' => 'required'
        ]);
        
        Leave::create([
            'user_id' => $request->employee_id,
            'leave_date' => Carbon::parse($request->leave_date),
            'leave_type' => $request->leave_type,
            'day_count' => $request->day_count,
            'filing_date' => Carbon::now(),
            'direct_manager_id' => User::where('id', $request->employee_id)->value('direct_manager_id'),
            'approval_remarks' => $request->approval_remarks
        ]);

        Session::flash('message', 'Leave has been added.');

        return redirect('/leaves-for-approval');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        $request->validate([
            'leave_date' => 'required'
        ]);

        $leave->update([
            'user_id' => $request->employee_id,
            'leave_date' => Carbon::parse($request->leave_date),
            'leave_type' => $request->leave_type,
            'day_count' => $request->day_count,
            'direct_manager_id' => User::where('id', $request->employee_id)->value('direct_manager_id'),
            'approval_remarks' => $request->approval_remarks
        ]);

        Session::flash('message', 'Leave has been updated.');

        return redirect('/leaves-for-approval');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();

        Session::flash('message', 'Leave has been deleted.');

        return redirect('/leaves-for-approval');
    }

    public function approved()
    {
        return view('leaves.approved', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'users' => User::all(),
            'leaves' => Leave::where('user_id', Auth::id())->where('status', 'approved')->get()

        ]);
    }

    public function denied()
    {
        return view('leaves.denied', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'users' => User::all(),
            'leaves' => Leave::where('user_id', Auth::id())->where('status', 'denied')->get()
        ]);
    }

    public function forApproval()
    {
        return view('leaves.forApproval', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'users' => User::all(),
            'leaves' => Leave::where('user_id', Auth::id())->where('status', 'forApproval')->get()
        ]);
    }

    public function approvingLeaves(Request $request, Leave $leave)
    {
        $leave->update([
            'status' => 'approved',
            'date_approved' => Carbon::now()
        ]);

        Session::flash('message', 'Leave approved.');

        return redirect('/approving-leaves');
    }

    public function denyingLeaves(Request $request, Leave $leave)
    {
        $leave->update([
            'status' => 'denied',
            'date_denied' => Carbon::now()
        ]);

        Session::flash('message', 'Leave disapproved.');

        return redirect('/approving-leaves');
    }

}
