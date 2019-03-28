<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
use App\Workshift;

class Dtr extends Model
{
    public static function timeDiff($latest, $old)
    {
        $difference = $latest - $old;

        $hours = 0;
        $mins = 0;
        $secs = 0;

        $hours = floor( $difference / 60 / 60 );
        $mins = round( ($difference - ($hours * 60 * 60) ) / 60);
        $secs = floor( ($difference - ( ($hours*3600) + ($mins*60))));

        $output = '';
        if($hours != 0) { $output .= number_format($hours,0,'.',',').'h '; }
        if($mins != 0) { $output .= number_format($mins,0,'.',',').'m '; }
        // if($secs != 0) { $output .= number_format($secs,0,'.',',').'s'; }
        
        return $output;
    }

    // Check if the date is weekend
    // Param must be in (Y-m-d H:i:s a) date format

    public static function isWeekend($date)
    {
        $weekDay = date('w', strtotime($date));
        return ($weekDay == 0 || $weekDay == 6);
    }

    // Convert epoch time to regular 12hr
    // param must be in epoch format

    public static function regularTime($epoch)
    {
        $regularTime = date('g:i a', strtotime($epoch));
        return $regularTime;
    }

    public static function checkIfLate($user, $attendance, $day) 
    {
        $workshifts = [
            0 => 'monday_workshift',
            1 => 'tuesday_workshift',
            2 => 'wednesday_workshift',
            3 => 'thursday_workshift',
            4 => 'friday_workshift',
            5 => 'saturday_workshift',
            6 => 'sunday_workshift'
        ];

        if ( array_key_exists($day, $workshifts) ) {


            $timeInRaw = $user->workshift->getWorkshiftInfo($workshifts[$day])['timein'];

            if ( array_key_exists($timeInRaw, config('app.timeValues')) ) {

                $shiftTimeStamp = strtotime(date('H:i', strtotime(config('app.timeValues')[$timeInRaw])));

                $shiftTimeIn = date('H:i', strtotime('+6 minutes', $shiftTimeStamp));

                $userTimeIn = date('H:i', $attendance->time_in);

                if ( $userTimeIn > $shiftTimeIn ) {
                    return static::timeDiff(strtotime($userTimeIn), strtotime($shiftTimeIn));
                }
            }
        }
    }

    public static function checkIfUndertime($user, $attendance, $day) 
    {
         $workshifts = [
            0 => 'monday_workshift',
            1 => 'tuesday_workshift',
            2 => 'wednesday_workshift',
            3 => 'thursday_workshift',
            4 => 'friday_workshift',
            5 => 'saturday_workshift',
            6 => 'sunday_workshift'
        ];

        if ( array_key_exists($day, $workshifts) ) {

            $timeOutRaw = $user->workshift->getWorkshiftInfo($workshifts[$day])['timeout'];

            $shiftTimeOut = date('H:i', strtotime($timeOutRaw));

            $userTimeOut = date('H:i', $attendance->time_out);

            if ( ($userTimeOut < $shiftTimeOut) ) {
                return static::timeDiff(strtotime($shiftTimeOut), strtotime($userTimeOut));
            }
            
        }
    }
}
