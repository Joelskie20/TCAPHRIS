<?php

namespace App\Http\Controllers;

use App\Workshift;
use App\Attendance;
use Illuminate\Http\Request;

class WorkshiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('workshift.index', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'workshifts' => Workshift::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workshift.create', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            
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
        $workshift = new Workshift;

        $workshift->createWorkshift($request);

        return redirect('/workshifts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Workshift  $workshift
     * @return \Illuminate\Http\Response
     */
    public function show(Workshift $workshift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Workshift  $workshift
     * @return \Illuminate\Http\Response
     */
    public function edit(Workshift $workshift)
    {
        return view('workshift.edit', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'workshift' => $workshift
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Workshift  $workshift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workshift $workshift)
    {
        $workshift = Workshift::findOrFail($workshift->id);

        $workshift->updateWorkshift($request, $workshift);

        return redirect('/workshifts/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Workshift  $workshift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshift $workshift)
    {
        //
    }
}
