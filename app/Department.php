<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Department extends Model
{
    use LogsActivity;

    protected $fillable = ['name'];

    protected static $logAttributes = ['name'];

    protected static $logName = 'Department';

    public function user()
    {
        $this->belongsTo('App\User', 'id', 'department_id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} the department";
    }
}
