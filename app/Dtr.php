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

    public static function checkIfLate($userTimeIn, $userTimeInShift)
    {

        $timeIn = new Carbon($userTimeIn);
        
        $timeInShift = new Carbon($userTimeInShift);
        
        if ( $timeIn->gt($timeInShift->addMinutes(6)) ) {
            
            return static::timeDiff(strtotime($timeIn), strtotime($timeInShift));

        }
    }

    public static function checkIfUndertime($userTimeOut, $userTimeOutShift) 
    {
        $timeOut = new Carbon($userTimeOut);
        
        $timeOutShift = new Carbon($userTimeOutShift);

        if ( $timeOut->lt($timeOutShift) ) {

            return static::timeDiff(strtotime($timeOutShift), strtotime($timeOut));

        }
    }
}
