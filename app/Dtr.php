<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;

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
        $days = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday'
        ];

        if ( array_key_exists($day, $days) ) {

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

            $getDayTimeIn = "get{$days[$day]}TimeIn";

            if ( array_key_exists($user->workshift->$getDayTimeIn(), $timeValues) ) {   

                $shiftTimestamps = strtotime(date('H:i', strtotime($timeValues[$user->workshift->$getDayTimeIn()])));

                $shiftTimeIn = date('H:i', strtotime('+6 minutes', $shiftTimestamps));

                $userTimeIn = date('H:i', $attendance->time_in);

                if ( $userTimeIn > $shiftTimeIn ) {
                    return static::timeDiff(strtotime($userTimeIn), strtotime($shiftTimeIn));
                }

            }

            
        }
    }

    public static function checkIfUndertime($user, $attendance, $day) 
    {
        $days = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday'
        ];

        if ( array_key_exists($day, $days) ) {

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

            $getDayTimeOut = "get{$days[$day]}TimeOut";

            $shiftTimeOut = date('H:i', strtotime($user->workshift->$getDayTimeOut()));

            $userTimeOut = date('H:i', $attendance->time_out);

            if ( ($userTimeOut < $shiftTimeOut) ) {
                return static::timeDiff(strtotime($shiftTimeOut), strtotime($userTimeOut));
            }
            
        }
    }
}
