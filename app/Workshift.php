<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Carbon;

class Workshift extends Model
{
    use LogsActivity;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function createWorkshift($request)
    {
        $this->code = $request->code;
        $this->name = $request->name;

        // $this->monday_workshift = ($request->monday_rest_day != 'RD') ? $request->monday_time_in . '-' . $request->monday_time_out . ',' . $request->monday_work_hours : 'RD';
        // $this->tuesday_workshift = ($request->tuesday_rest_day != 'RD') ? $request->tuesday_time_in . '-' . $request->tuesday_time_out . ',' . $request->tuesday_work_hours : 'RD';
        // $this->wednesday_workshift = ($request->wednesday_rest_day != 'RD') ? $request->wednesday_time_in . '-' . $request->wednesday_time_out . ',' . $request->wednesday_work_hours : 'RD';
        // $this->thursday_workshift = ($request->thursday_rest_day != 'RD') ? $request->thursday_time_in . '-' . $request->thursday_time_out . ',' . $request->thursday_work_hours : 'RD';
        // $this->friday_workshift = ($request->friday_rest_day != 'RD') ? $request->friday_time_in . '-' . $request->friday_time_out . ',' . $request->friday_work_hours : 'RD';
        // $this->saturday_workshift = ($request->saturday_rest_day != 'RD') ? $request->saturday_time_in . '-' . $request->saturday_time_out . ',' . $request->saturday_work_hours : 'RD';
        // $this->sunday_workshift = ($request->sunday_rest_day != 'RD') ? $request->sunday_time_in . '-' . $request->sunday_time_out . ',' . $request->sunday_work_hours : 'RD';

        $monday_ws = $request->monday_time_in . '-' . $request->monday_time_out . ',' . $request->monday_work_hours.',';
        if($request->monday_rest_day == 'RD') { $monday_ws.='RD'; }
        $this->monday_workshift = $monday_ws;

        $tuesday_ws = $request->tuesday_time_in . '-' . $request->tuesday_time_out . ',' . $request->tuesday_work_hours.',';
        if($request->tuesday_rest_day == 'RD') { $tuesday_ws.='RD'; }
        $this->tuesday_workshift = $tuesday_ws;

        $wednesday_ws = $request->wednesday_time_in . '-' . $request->wednesday_time_out . ',' . $request->wednesday_work_hours.',';
        if($request->wednesday_rest_day == 'RD') { $wednesday_ws.='RD'; }
        $this->wednesday_workshift = $wednesday_ws;

        $thursday_ws = $request->thursday_time_in . '-' . $request->thursday_time_out . ',' . $request->thursday_work_hours.',';
        if($request->thursday_rest_day == 'RD') { $thursday_ws.='RD'; }
        $this->thursday_workshift = $thursday_ws;

        $friday_ws = $request->friday_time_in . '-' . $request->friday_time_out . ',' . $request->friday_work_hours.',';
        if($request->friday_rest_day == 'RD') { $friday_ws.='RD'; }
        $this->friday_workshift = $friday_ws;

        $saturday_ws = $request->saturday_time_in . '-' . $request->saturday_time_out . ',' . $request->saturday_work_hours.',';
        if($request->saturday_rest_day == 'RD') { $saturday_ws.='RD'; }
        $this->saturday_workshift = $saturday_ws;

        $sunday_ws = $request->sunday_time_in . '-' . $request->sunday_time_out . ',' . $request->sunday_work_hours.',';
        if($request->sunday_rest_day == 'RD') { $sunday_ws.='RD'; }
        $this->sunday_workshift = $sunday_ws;

        $this->save();
    }

    public function updateWorkshift($request, $workshift)
    {
        $this->code = $request->code;
        $this->name = $request->name;

        // $this->monday_workshift = ($request->monday_rest_day != 'RD') ? $request->monday_time_in . '-' . $request->monday_time_out . ',' . $request->monday_work_hours : 'RD';
        // $this->tuesday_workshift = ($request->tuesday_rest_day != 'RD') ? $request->tuesday_time_in . '-' . $request->tuesday_time_out . ',' . $request->tuesday_work_hours : 'RD';
        // $this->wednesday_workshift = ($request->wednesday_rest_day != 'RD') ? $request->wednesday_time_in . '-' . $request->wednesday_time_out . ',' . $request->wednesday_work_hours : 'RD';
        // $this->thursday_workshift = ($request->thursday_rest_day != 'RD') ? $request->thursday_time_in . '-' . $request->thursday_time_out . ',' . $request->thursday_work_hours : 'RD';
        // $this->friday_workshift = ($request->friday_rest_day != 'RD') ? $request->friday_time_in . '-' . $request->friday_time_out . ',' . $request->friday_work_hours : 'RD';
        // $this->saturday_workshift = ($request->saturday_rest_day != 'RD') ? $request->saturday_time_in . '-' . $request->saturday_time_out . ',' . $request->saturday_work_hours : 'RD';
        // $this->sunday_workshift = ($request->sunday_rest_day != 'RD') ? $request->sunday_time_in . '-' . $request->sunday_time_out . ',' . $request->sunday_work_hours : 'RD';

        $monday_ws = $request->monday_time_in . '-' . $request->monday_time_out . ',' . $request->monday_work_hours.',';
        if($request->monday_rest_day == 'RD') { $monday_ws.='RD'; }
        $this->monday_workshift = $monday_ws;

        $tuesday_ws = $request->tuesday_time_in . '-' . $request->tuesday_time_out . ',' . $request->tuesday_work_hours.',';
        if($request->tuesday_rest_day == 'RD') { $tuesday_ws.='RD'; }
        $this->tuesday_workshift = $tuesday_ws;

        $wednesday_ws = $request->wednesday_time_in . '-' . $request->wednesday_time_out . ',' . $request->wednesday_work_hours.',';
        if($request->wednesday_rest_day == 'RD') { $wednesday_ws.='RD'; }
        $this->wednesday_workshift = $wednesday_ws;

        $thursday_ws = $request->thursday_time_in . '-' . $request->thursday_time_out . ',' . $request->thursday_work_hours.',';
        if($request->thursday_rest_day == 'RD') { $thursday_ws.='RD'; }
        $this->thursday_workshift = $thursday_ws;

        $friday_ws = $request->friday_time_in . '-' . $request->friday_time_out . ',' . $request->friday_work_hours.',';
        if($request->friday_rest_day == 'RD') { $friday_ws.='RD'; }
        $this->friday_workshift = $friday_ws;

        $saturday_ws = $request->saturday_time_in . '-' . $request->saturday_time_out . ',' . $request->saturday_work_hours.',';
        if($request->saturday_rest_day == 'RD') { $saturday_ws.='RD'; }
        $this->saturday_workshift = $saturday_ws;

        $sunday_ws = $request->sunday_time_in . '-' . $request->sunday_time_out . ',' . $request->sunday_work_hours.',';
        if($request->sunday_rest_day == 'RD') { $sunday_ws.='RD'; }
        $this->sunday_workshift = $sunday_ws;

        $this->save();
    }

    public static function regularTime($time)
    {
        $timeValues = [
            '0' => '12:00am',
            '30' => '12:30am',
            '100' => '1:00am',
            '130' => '1:30am',
            '200' => '2:00am',
            '230' => '2:30am',
            '300' => '3:00am',
            '330' => '3:30am',
            '400' => '4:00am',
            '430' => '4:30am',
            '500' => '5:00am',
            '530' => '5:30am',
            '600' => '6:00am',
            '630' => '6:30am',
            '700' => '7:00am',
            '730' => '7:30am',
            '800' => '8:00am',
            '830' => '8:30am',
            '900' => '9:00am',
            '930' => '9:30am'
        ];
        
        return (array_key_exists($time, $timeValues)) ? date('H:i', strtotime($timeValues[$time])) : date('H:i', strtotime($time));
    }

    public function getWorkshiftInfo($day) {
        list($schedule, $workhours, $restday) = explode(',', $this->$day);
        list($timein, $timeout) = explode('-', $schedule);
        return array('timein'=>$timein,'timeout'=>$timeout,'workhours'=>$workhours,'restday'=>$restday);
    }

    public static function getUserWorkshiftPerDay($user, $dateCode)
    {

        $sched = $user->workshiftPerDay()->where('date_code', $dateCode)->first();

        if ( $sched->workshift_schedule === 'RD' ) {
            return 'RD';
        }

        $userWorkshiftInfo = explode(',', $sched->workshift_schedule);

        $userWorkshift = $userWorkshiftInfo[0];

        $userWorkHours = $userWorkshiftInfo[1]; 

        $attendance = explode('-', $userWorkshift);

        $timeIn = $attendance[0];
        $timeOut = $attendance[1];

        if ( array_key_exists($timeIn, config('app.timeValues')) ) {

            $timeIn = Carbon::parse(config('app.timeValues')[$timeIn])->format('g:i a');

        } else {

            $timeIn = Carbon::parse($timeIn)->format('g:i a');
        }

        if ( array_key_exists($timeOut, config('app.timeValues')) ) {

            $timeOut = Carbon::parse(config('app.timeValues')[$timeOut])->format('g:i a');

        } else {

            $timeOut = Carbon::parse($timeOut)->format('g:i a');
        }

        return $timeIn . ' - ' . $timeOut;

    }

    public static function getUserTimeIn($user, $dateCode, $id)
    {

        $sched = $user->workshiftPerDay()->where('id', $id)->first();

        if ( is_null($sched) ) {
            return null;
        }

        $userWorkshiftInfo = explode(',', $sched->workshift_schedule);

        $userWorkshift = $userWorkshiftInfo[0];

        $userWorkHours = $userWorkshiftInfo[1]; 

        $attendance = explode('-', $userWorkshift);

        $timeIn = $attendance[0];
        $timeOut = $attendance[1];

        return $timeIn;

    }

    public static function getUserTimeOut($user, $dateCode, $id)
    {

        $sched = $user->workshiftPerDay()->where('id', $id)->first();

        if ( is_null($sched) ) {
            return null;
        }

        // if ( $sched->workshift_schedule === 'RD' ) {
        //     return 'RD';
        // }

        $userWorkshiftInfo = explode(',', $sched->workshift_schedule);

        $userWorkshift = $userWorkshiftInfo[0];

        $userWorkHours = $userWorkshiftInfo[1]; 

        $attendance = explode('-', $userWorkshift);

        $timeIn = $attendance[0];
        $timeOut = $attendance[1];

        // if ( array_key_exists($timeIn, config('app.timeValues')) ) {

        //     $timeIn = Carbon::parse(config('app.timeValues')[$timeIn])->format('g:i a');

        // } else {

        //     $timeIn = Carbon::parse($timeIn)->format('g:i a');
        // }

        // if ( array_key_exists($timeOut, config('app.timeValues')) ) {

        //     $timeOut = Carbon::parse(config('app.timeValues')[$timeOut])->format('g:i a');

        // } else {

        //     $timeOut = Carbon::parse($timeOut)->format('g:i a');
        // }

        return $timeOut;

    }

    public static function formatTime($time)
    {
        if ( array_key_exists($time, config('app.timeValues')) ) {

            $time = Carbon::parse(config('app.timeValues')[$time])->format('g:i a');

        } else {

            $time = Carbon::parse($time)->format('g:i a');
        }

        return $time;
    }
    
}
