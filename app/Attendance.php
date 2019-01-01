<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = [];
    
    public static function checkAttendanceStatus()
    {
        return static::where([
            ['user_id', '=', auth()->id()],
            ['time_out', '=', null]
        ])->first();
    }
}
