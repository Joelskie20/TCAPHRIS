<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Division;

class Account extends Model
{
    public $fillable = ['division_id', 'team_id', 'name'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function jobCodes()
    {
        return $this->hasMany(JobCode::class);
    }
}
