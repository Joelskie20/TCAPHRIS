<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Team extends Model
{

    use LogsActivity;
    
    protected $fillable = ['name'];

    protected static $logAttributes = ['name'];

    protected static $logName = 'Team';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} the team";
    }
}
