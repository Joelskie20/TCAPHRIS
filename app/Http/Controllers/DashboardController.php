<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Carbon\Carbon;
use App\Attendance;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disabled = (Attendance::checkAttendanceStatus()) ? true : false;
        
        return view('dashboard', ['disabled' => $disabled]);
    }

    public function store(Request $request)
    {

        Attendance::create([
            'user_id' => auth()->id(),
            'time_in' => strtotime(Carbon::now())
        ]);

        Session::flash('message', 'Time In: ' . Carbon::now()->format('h:i A, F d, Y'));
        return back();
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::checkAttendanceStatus();

        $attendance->time_out = strtotime(Carbon::now());
        $attendance->update();

        Session::flash('message', 'Time Out: ' . Carbon::now()->format('h:i A, F d, Y'));
        return back();
    }
}
