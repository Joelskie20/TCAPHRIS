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

        $this->monday_workshift = ($request->monday_rest_day != 'RD') ? $request->monday_time_in . '-' . $request->monday_time_out . ',' . $request->monday_work_hours : 'RD';
        $this->tuesday_workshift = ($request->tuesday_rest_day != 'RD') ? $request->tuesday_time_in . '-' . $request->tuesday_time_out . ',' . $request->tuesday_work_hours : 'RD';
        $this->wednesday_workshift = ($request->wednesday_rest_day != 'RD') ? $request->wednesday_time_in . '-' . $request->wednesday_time_out . ',' . $request->wednesday_work_hours : 'RD';
        $this->thursday_workshift = ($request->thursday_rest_day != 'RD') ? $request->thursday_time_in . '-' . $request->thursday_time_out . ',' . $request->thursday_work_hours : 'RD';
        $this->friday_workshift = ($request->friday_rest_day != 'RD') ? $request->friday_time_in . '-' . $request->friday_time_out . ',' . $request->friday_work_hours : 'RD';
        $this->saturday_workshift = ($request->saturday_rest_day != 'RD') ? $request->saturday_time_in . '-' . $request->saturday_time_out . ',' . $request->saturday_work_hours : 'RD';
        $this->sunday_workshift = ($request->sunday_rest_day != 'RD') ? $request->sunday_time_in . '-' . $request->sunday_time_out . ',' . $request->sunday_work_hours : 'RD';

        $this->save();
    }

    public function updateWorkshift($request, $workshift)
    {
        $this->code = $request->code;
        $this->name = $request->name;

        $this->monday_workshift = ($request->monday_rest_day != 'RD') ? $request->monday_time_in . '-' . $request->monday_time_out . ',' . $request->monday_work_hours : 'RD';
        $this->tuesday_workshift = ($request->tuesday_rest_day != 'RD') ? $request->tuesday_time_in . '-' . $request->tuesday_time_out . ',' . $request->tuesday_work_hours : 'RD';
        $this->wednesday_workshift = ($request->wednesday_rest_day != 'RD') ? $request->wednesday_time_in . '-' . $request->wednesday_time_out . ',' . $request->wednesday_work_hours : 'RD';
        $this->thursday_workshift = ($request->thursday_rest_day != 'RD') ? $request->thursday_time_in . '-' . $request->thursday_time_out . ',' . $request->thursday_work_hours : 'RD';
        $this->friday_workshift = ($request->friday_rest_day != 'RD') ? $request->friday_time_in . '-' . $request->friday_time_out . ',' . $request->friday_work_hours : 'RD';
        $this->saturday_workshift = ($request->saturday_rest_day != 'RD') ? $request->saturday_time_in . '-' . $request->saturday_time_out . ',' . $request->saturday_work_hours : 'RD';
        $this->sunday_workshift = ($request->sunday_rest_day != 'RD') ? $request->sunday_time_in . '-' . $request->sunday_time_out . ',' . $request->sunday_work_hours : 'RD';

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

    public function getMondayTimeIn()
    {
        if($this->monday_workshift == 'RD') {
            return 'RD';
        }

        list($mondaySchedule, $mondayWorkHours) = explode(',', $this->monday_workshift);

        list($mondayTimeIn, $mondayTimeOut) = explode('-', $mondaySchedule);

        return $mondayTimeIn;

    }

    public function getMondayTimeOut()
    {
        if($this->monday_workshift == 'RD') {
            return 'RD';
        }

        list($mondaySchedule, $mondayWorkHours) = explode(',', $this->monday_workshift);

        list($mondayTimeIn, $mondayTimeOut) = explode('-', $mondaySchedule);

        return $mondayTimeOut;

    }

    public function getMondayWorkHours()
    {
        if($this->monday_workshift == 'RD') {
            return 'RD';
        }

        list($mondaySchedule, $mondayWorkHours) = explode(',', $this->monday_workshift);

        return $mondayWorkHours;
    }

    public function getTuesdayTimeIn()
    {
        if($this->tuesday_workshift == 'RD') {
            return 'RD';
        }

        list($tuesdaySchedule, $tuesdayWorkHours) = explode(',', $this->tuesday_workshift);

        list($tuesdayTimeIn, $tuesdayTimeOut) = explode('-', $tuesdaySchedule);

        return $tuesdayTimeIn;

    }

    public function getTuesdayTimeOut()
    {
        if($this->tuesday_workshift == 'RD') {
            return 'RD';
        }

        list($tuesdaySchedule, $tuesdayWorkHours) = explode(',', $this->tuesday_workshift);

        list($tuesdayTimeIn, $tuesdayTimeOut) = explode('-', $tuesdaySchedule);

        return $tuesdayTimeOut;

    }

    public function getTuesdayWorkHours()
    {
        if($this->tuesday_workshift == 'RD') {
            return 'RD';
        }

        list($tuesdaySchedule, $tuesdayWorkHours) = explode(',', $this->tuesday_workshift);

        return $tuesdayWorkHours;
    }

    public function getWednesdayTimeIn()
    {
        if($this->wednesday_workshift == 'RD') {
            return 'RD';
        }

        list($wednesdaySchedule, $wednesdayWorkHours) = explode(',', $this->wednesday_workshift);

        list($wednesdayTimeIn, $wednesdayTimeOut) = explode('-', $wednesdaySchedule);

        return $wednesdayTimeIn;

    }

    public function getWednesdayTimeOut()
    {
        if($this->wednesday_workshift == 'RD') {
            return 'RD';
        }

        list($wednesdaySchedule, $wednesdayWorkHours) = explode(',', $this->wednesday_workshift);

        list($wednesdayTimeIn, $wednesdayTimeOut) = explode('-', $wednesdaySchedule);

        return $wednesdayTimeOut;

    }

    public function getWednesdayWorkHours()
    {
        if($this->wednesday_workshift == 'RD') {
            return 'RD';
        }

        list($wednesdaySchedule, $wednesdayWorkHours) = explode(',', $this->wednesday_workshift);

        return $wednesdayWorkHours;
    }

    public function getThursdayTimeIn()
    {
        if($this->thursday_workshift == 'RD') {
            return 'RD';
        }

        list($thursdaySchedule, $thursdayWorkHours) = explode(',', $this->thursday_workshift);

        list($thursdayTimeIn, $thursdayTimeOut) = explode('-', $thursdaySchedule);

        return $thursdayTimeIn;

    }

    public function getThursdayTimeOut()
    {
        if($this->thursday_workshift == 'RD') {
            return 'RD';
        }

        list($thursdaySchedule, $thursdayWorkHours) = explode(',', $this->thursday_workshift);

        list($thursdayTimeIn, $thursdayTimeOut) = explode('-', $thursdaySchedule);

        return $thursdayTimeOut;

    }

    public function getThursdayWorkHours()
    {
        if($this->thursday_workshift == 'RD') {
            return 'RD';
        }

        list($thursdaySchedule, $thursdayWorkHours) = explode(',', $this->thursday_workshift);

        return $thursdayWorkHours;
    }

    public function getFridayTimeIn()
    {
        if($this->friday_workshift == 'RD') {
            return 'RD';
        }

        list($fridaySchedule, $fridayWorkHours) = explode(',', $this->friday_workshift);

        list($fridayTimeIn, $fridayTimeOut) = explode('-', $fridaySchedule);

        return $fridayTimeIn;

    }

    public function getFridayTimeOut()
    {
        if($this->friday_workshift == 'RD') {
            return 'RD';
        }

        list($fridaySchedule, $fridayWorkHours) = explode(',', $this->friday_workshift);

        list($fridayTimeIn, $fridayTimeOut) = explode('-', $fridaySchedule);

        return $fridayTimeOut;

    }

    public function getFridayWorkHours()
    {
        if($this->friday_workshift == 'RD') {
            return 'RD';
        }

        list($fridaySchedule, $fridayWorkHours) = explode(',', $this->friday_workshift);

        return $fridayWorkHours;
    }

    public function getSaturdayTimeIn()
    {
        if($this->saturday_workshift == 'RD') {
            return 'RD';
        }

        list($saturdaySchedule, $saturdayWorkHours) = explode(',', $this->saturday_workshift);

        list($saturdayTimeIn, $saturdayTimeOut) = explode('-', $saturdaySchedule);

        return $saturdayTimeIn;

    }

    public function getSaturdayTimeOut()
    {
        if($this->saturday_workshift == 'RD') {
            return 'RD';
        }

        list($saturdaySchedule, $saturdayWorkHours) = explode(',', $this->saturday_workshift);

        list($saturdayTimeIn, $saturdayTimeOut) = explode('-', $saturdaySchedule);

        return $saturdayTimeOut;

    }

    public function getSaturdayWorkHours()
    {
        if($this->saturday_workshift == 'RD') {
            return 'RD';
        }

        list($saturdaySchedule, $saturdayWorkHours) = explode(',', $this->saturday_workshift);

        return $saturdayWorkHours;
    }

    public function getSundayTimeIn()
    {
        if($this->sunday_workshift == 'RD') {
            return 'RD';
        }

        list($sundaySchedule, $sundayWorkHours) = explode(',', $this->sunday_workshift);

        list($sundayTimeIn, $sundayTimeOut) = explode('-', $sundaySchedule);

        return $sundayTimeIn;

    }

    public function getSundayTimeOut()
    {
        if($this->sunday_workshift == 'RD') {
            return 'RD';
        }

        list($sundaySchedule, $sundayWorkHours) = explode(',', $this->sunday_workshift);

        list($sundayTimeIn, $sundayTimeOut) = explode('-', $sundaySchedule);

        return $sundayTimeOut;

    }

    public function getSundayWorkHours()
    {
        if($this->sunday_workshift == 'RD') {
            return 'RD';
        }

        list($sundaySchedule, $sundayWorkHours) = explode(',', $this->sunday_workshift);

        return $sundayWorkHours;
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

    public static function getUserTimeIn($user, $dateCode)
    {

        $sched = $user->workshiftPerDay()->where('date_code', $dateCode)->first();

        if ( is_null($sched) ) {
            return null;
        }

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

        return $timeIn;

    }

    public static function getUserTimeOut($user, $dateCode)
    {

        $sched = $user->workshiftPerDay()->where('date_code', $dateCode)->first();

        if ( is_null($sched) ) {
            return null;
        }

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

        return $timeOut;

    }

    
}
