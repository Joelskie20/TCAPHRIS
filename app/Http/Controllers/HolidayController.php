<?php

namespace App\Http\Controllers;

use App\Holiday;
use App\Attendance;
use Illuminate\Http\Request;
use Carbon;
use Session;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('holiday.index', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'holidays' => Holiday::all()
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
        Holiday::create($request->validate([
            'name' => 'required|max:255',
            'date' => 'required',
            'type' => 'required'
        ]));

        Session::flash('message', 'Holiday has been added.');

        return redirect('/company-calendar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function show(Holiday $holiday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holiday $holiday)
    {
        $holiday->update($request->validate([
            'name' => 'required|max:255',
            'date' => 'required',
            'type' => 'required'
        ]));

        Session::flash('message', 'Holiday has been updated.');

        return redirect('company-calendar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();

        Session::flash('message', 'Holiday has been deleted.');

        return redirect('company-calendar');
    }
}
