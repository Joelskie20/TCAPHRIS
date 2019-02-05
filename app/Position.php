<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Position extends Model
{
    use LogsActivity;

    protected $fillable = ['name'];

    protected static $logAttributes = ['name'];

    protected static $logName = 'Position';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} the position";
    }
}
