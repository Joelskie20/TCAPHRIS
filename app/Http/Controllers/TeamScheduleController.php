<?php

namespace App\Http\Controllers;

use App\TeamSchedule;
use App\Attendance;
use Illuminate\Http\Request;

class TeamScheduleController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disabled = (Attendance::checkAttendanceStatus()) ? true : false;

        return view('team-schedule.index', [
            'disabled' => $disabled,
            'view' => 'list'
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
     * @param  \App\TeamSchedule  $teamSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(TeamSchedule $teamSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeamSchedule  $teamSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamSchedule $teamSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeamSchedule  $teamSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeamSchedule $teamSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeamSchedule  $teamSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamSchedule $teamSchedule)
    {
        //
    }
}
