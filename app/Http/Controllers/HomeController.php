<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Carbon\Carbon;
use App\Attendance;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $attendance = Attendance::where([
            ['user_id', '=', Auth::user()->id],
            ['time_out', '=', null]
        ])->first();

        $disabled = ($attendance) ? true : false;
        
        return view('dashboard', ['disabled' => $disabled]);
    }

    public function store(Request $request)
    {
        $attendance = new Attendance;
        $attendance->user_id = Auth::user()->id;
        $attendance->time_in = strtotime(Carbon::now());
        $attendance->save();

        Session::flash('message', 'Successfully Timed In at ' . Carbon::now()->toDayDateTimeString());
        return back();
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::where([
            ['time_out', '=', null],
            ['user_id', '=', $id],
        ])->first();

        $attendance->time_out = strtotime(Carbon::now());
        $attendance->update();

        Session::flash('message', "Successfully Time Out at ". Carbon::now()->toDayDateTimeString());
        return back();
    }
}
