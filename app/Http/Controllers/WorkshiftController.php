<?php

namespace App\Http\Controllers;

use Session;
use App\Workshift;
use App\WorkshiftSched;
use App\WorkshiftPerDay;
use App\Attendance;
use App\User;
use App\{Division, Team, Account, JobCode};
use Illuminate\Http\Request;
use Carbon;
use DB;

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

        Session::flash('message', 'Workshift has been created.');

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
        return $workshift;
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

        Session::flash('message', 'Workshift has been updated.');

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
        $workshift->delete();

        return redirect('/workshifts');
    }

    public function assignment()
    {
        return view('workshift.assignment', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'workshifts' => Workshift::all(),
            'users' => User::all(),
            'divisions' => Division::all(),
            'teams' => Team::all(),
            'accounts' => Account::all(),
            'job_codes' => JobCode::all(),
        ]);
    }

    public function assignmentStore(Request $request)
    {
        list($from, $to) = explode(' - ', $request->workshift_schedule_range);

        // Division Selected

        if ( $request->division_id > 0 && $request->team_id == 0 && $request->account_id == 0 ) {

            $users = User::where('division_id', $request->division_id)->get();

            $start = Carbon::parse($from)->format('Ymd');

            $end = Carbon::parse($to)->format('Ymd');

            $dateRange = WorkshiftSched::getAllDays($start, $end);

            return $this->generateWorkshift($users, $start, $end, $dateRange);

        }

        // Division, Team Selected

        if ( $request->division_id > 0 && $request->team_id > 0 && $request->account_id == 0) {

            $users = User::where('division_id', $request->division_id)->where('team_id', $request->team_id)->get();

            $start = Carbon::parse($from)->format('Ymd');

            $end = Carbon::parse($to)->format('Ymd');

            $dateRange = WorkshiftSched::getAllDays($start, $end);

            return $this->generateWorkshift($users, $start, $end, $dateRange);
        }

        // Division, Team, Account Selected

        if ( $request->division_id > 0 && $request->team_id > 0 && $request->account_id > 0) {

            $users = User::where('division_id', $request->division_id)->where('team_id', $request->team_id)->where('account_id', $request->account_id)->get();

            $start = Carbon::parse($from)->format('Ymd');

            $end = Carbon::parse($to)->format('Ymd');

            $dateRange = WorkshiftSched::getAllDays($start, $end);

            return $this->generateWorkshift($users, $start, $end, $dateRange);
        }

        if ( isset($request->employee_id) ) {
            
            $users = User::whereIn('id', $request->employee_id)->get();

            $start = Carbon::parse($from)->format('Ymd');

            $end = Carbon::parse($to)->format('Ymd');

            $dateRange = WorkshiftSched::getAllDays($start, $end);

            return $this->generateWorkshift($users, $start, $end, $dateRange);

        }

        
    }

    public function generateWorkshift($users, $start, $end, $dateRange)
    {
        foreach ( $users as $user ) {

            WorkshiftSched::create([
                'user_id' => $user->id,
                'workshift_id' => $user->workshift->id,
                'date_from' => $start,
                'date_to' => $end
            ]);

            foreach ($dateRange as $date) {

                $days = [
                    0 => 'sunday',
                    1 => 'monday',
                    2 => 'tuesday',
                    3 => 'wednesday',
                    4 => 'thursday',
                    5 => 'friday',
                    6 => 'saturday'
                ];

                if ( array_key_exists(Carbon::parse($date)->dayOfWeek, $days) ) {

                    $getDay = "{$days[Carbon::parse($date)->dayOfWeek]}_workshift";

                    WorkshiftPerDay::create([
                        'user_id' => $user->id,
                        'workshift_schedule' => $user->workshift->$getDay,
                        'date_code' => Carbon::parse($date)->format('Ymd'),
                        'rest_day' => str_contains($user->workshift->$getDay, "RD") ? true : false 
                    ]);

                }

            }

        }

        session()->flash('message', 'Workshift generated successfully');

        return redirect('/workshift-assignment');
    }

    public function calendar(Request $request)
    {
        if (! isset($request->daterange)) {
            list($from, $to) = explode(' - ', '04/01/2019 - 04/15/2019');    
        } else {
            list($from, $to) = explode(' - ', $request->daterange);
        }

        $request->flash();

        return view('workshift.calendar', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
            'teams' => Team::all(),
            'from' => Carbon::parse($from),
            'to' => Carbon::parse($to),
            'dateRange' => WorkshiftSched::getAllDays(Carbon::parse($from)->format('Ymd'), Carbon::parse($to)->format('Ymd')),
            'users' => User::where('team_id', $request->team_id)->get()
        ]);
    }

    public function fetchDaySched($userID, $dateCode)
    {
        $data = WorkshiftPerDay::where([
            ['user_id', '=', $userID],
            ['date_code', '=', $dateCode]
        ])->first();

        return response()->json($data, 200);
    }


}
