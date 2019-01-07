<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User', 'id', 'gender_id');
    }

    public function getAllMaleEmployees()
    {
        return $this->find(1)->users()->get();
    }

    public function getAllFemaleEmployees()
    {
        return $this->find(2)->users()->get();
    }

    public function countAllMen()
    {
        return $this->getAllMaleEmployees()->count();
    }

    public function countAllWomen()
    {
        return $this->getAllFemaleEmployees()->count();
    }
}
