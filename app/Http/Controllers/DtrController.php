<?php

namespace App\Http\Controllers;

use Auth;
use App\Dtr;
use App\User;
use App\Attendance;
use Illuminate\Http\Request;

class DtrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dtr.index', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            // 'attendances' => Attendance::where('user_id', Auth::id())->get(),
            // 'attendances' => User::where('id', Auth::id())->attendances()->latest()->get(),
            'user' => User::where('id', Auth::id())->first()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dtr  $dtr
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('dtr.show', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'attendances' => Attendance::where('user_id', $id)->get(),
            'employee' => User::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dtr  $dtr
     * @return \Illuminate\Http\Response
     */
    public function edit(Dtr $dtr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dtr  $dtr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dtr $dtr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dtr  $dtr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dtr $dtr)
    {
        //
    }

    public function exportFirstCutoff()
    {
        $users = User::all();
        $attendances = Attendance::all();

        // insert code below and remove dd
        dd('download first cutoff excel - WIP');
    }

    public function exportSecondCutOff()
    {
        $users = User::all();
        $attendances = Attendance::all();

        // insert code below and remove dd
        dd('download 2nd cutoff excel - WIP');
    }
}
