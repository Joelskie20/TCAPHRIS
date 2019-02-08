<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobCode extends Model
{
    public $fillable = ['division_id', 'team_id', 'account_id', 'name', 'code'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
