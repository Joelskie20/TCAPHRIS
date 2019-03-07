<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon;
use Hash;
use DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function createUser($request)
    {        
        // Employee Detail
        $this->employee_id = $request->employee_id;
        $this->position_id = $request->position_id;
        $this->division_id = $request->division_id;
        $this->team_id = $request->team_id;
        $this->account_id = $request->account_id;
        $this->job_code_id = $request->job_code_id;
        $this->base_salary = floatval(str_replace(',', '', $request->base_salary));
        $this->tax_status = $request->tax_status;
        $this->payment_frequency = $request->payment_frequency;
        $this->hire_date = Carbon::parse($request->hire_date);
        $this->direct_manager_id = $request->direct_manager_id;
        $this->direct_manager_id_two = $request->direct_manager_id_two;
        $this->direct_manager_id_three = $request->direct_manager_id_three;
        $this->workshift_id = $request->workshift_id;

        // Personal Information

        $this->first_name = $request->first_name;
        $this->middle_name = $request->middle_name;
        $this->last_name = $request->last_name;
        $this->birth_date = Carbon::parse($request->birth_date);
        $this->gender_id = $request->gender_id;
        $this->nationality = $request->nationality;
        $this->religion = $request->religion;

        // Contact Details

        $this->present_unit_number = $request->present_unit_number;
        $this->present_building_number = $request->present_building_number;
        $this->present_street_name = $request->present_street_name;
        $this->present_subdivision = $request->present_subdivision;
        $this->present_barangay_id = $request->present_barangay_id;
        $this->present_city_id = $request->present_city_id;
        $this->present_province_id = $request->present_province_id;
        $this->present_country_id = $request->present_country_id;
        $this->present_zip_code_id = $request->present_zip_code_id;

        $this->permanent_unit_number = $request->permanent_unit_number;
        $this->permanent_building_number = $request->permanent_building_number;
        $this->permanent_street_name = $request->permanent_street_name;
        $this->permanent_subdivision = $request->permanent_subdivision;
        $this->permanent_barangay_id = $request->permanent_barangay_id;
        $this->permanent_city_id = $request->permanent_city_id;
        $this->permanent_province_id = $request->permanent_province_id;
        $this->permanent_country_id = $request->permanent_country_id;
        $this->permanent_zip_code_id = $request->permanent_zip_code_id;

        // Other Contact Details

        $this->email = $request->email;
        $this->mobile_number = $request->mobile_number;
        $this->landline = $request->landline;

        // Government Details

        $this->tin_number = $request->tin_number;
        $this->sss_number = $request->sss_number;
        $this->philhealth_number = $request->philhealth_number;
        $this->pagibig_number = $request->pagibig_number;

        // Other Fields

        $this->username = $request->employee_id;
        $this->password = Hash::make($request->employee_id);
        $this->assignRole($request->roles);

        $this->save();

        list($from, $to) = explode(' - ', $request->workshift_schedule_range);

         DB::table('user_workshift_schedules')->insert([
            [
                'user_id' => DB::table('users')->where('employee_id', $request->employee_id)->first()->id,
                'workshift_id' => $request->workshift_id,
                'date_from' => Carbon::parse($from)->format('Ymd'),
                'date_to' => Carbon::parse($to)->format('Ymd')
            ]
        ]);
    }

    public function updateUser($request, $user)
    {
        // Employee Details

        $this->employee_id = $request->employee_id;
        $this->position_id = $request->position_id;
        $this->division_id = $request->division_id;
        $this->team_id = $request->team_id;
        $this->account_id = $request->account_id;
        $this->job_code_id = $request->job_code_id;
        $this->base_salary = floatval(str_replace(',', '', $request->base_salary));
        $this->tax_status = $request->tax_status;
        $this->payment_frequency = $request->payment_frequency;
        $this->hire_date = Carbon::parse($request->hire_date);
        $this->direct_manager_id = $request->direct_manager_id;
        $this->direct_manager_id_two = $request->direct_manager_id_two;
        $this->direct_manager_id_three = $request->direct_manager_id_three;
        $this->workshift_id = $request->workshift_id;

        // Personal Information

        $this->first_name = $request->first_name;
        $this->middle_name = $request->middle_name;
        $this->last_name = $request->last_name;
        $this->birth_date = Carbon::parse($request->birth_date);
        $this->gender_id = $request->gender_id;
        $this->nationality = $request->nationality;
        $this->religion = $request->religion;

        // Contact Details

        $this->present_unit_number = $request->present_unit_number;
        $this->present_building_number = $request->present_building_number;
        $this->present_street_name = $request->present_street_name;
        $this->present_subdivision = $request->present_subdivision;
        $this->present_barangay_id = $request->present_barangay_id;
        $this->present_city_id = $request->present_city_id;
        $this->present_province_id = $request->present_province_id;
        $this->present_country_id = $request->present_country_id;
        $this->present_zip_code_id = $request->present_zip_code_id;

        $this->permanent_unit_number = $request->permanent_unit_number;
        $this->permanent_building_number = $request->permanent_building_number;
        $this->permanent_street_name = $request->permanent_street_name;
        $this->permanent_subdivision = $request->permanent_subdivision;
        $this->permanent_barangay_id = $request->permanent_barangay_id;
        $this->permanent_city_id = $request->permanent_city_id;
        $this->permanent_province_id = $request->permanent_province_id;
        $this->permanent_country_id = $request->permanent_country_id;
        $this->permanent_zip_code_id = $request->permanent_zip_code_id;

        // Other Contact Details

        $this->email = $request->email;
        $this->mobile_number = $request->mobile_number;
        $this->landline = $request->landline;

        // Government Details

        $this->tin_number = $request->tin_number;
        $this->sss_number = $request->sss_number;
        $this->philhealth_number = $request->philhealth_number;
        $this->pagibig_number = $request->pagibig_number;

        // Other Fields

        $this->status = $request->status;
        $this->syncRoles($request->roles);

        // $this->password = Hash::make($request->employee_id);

        $this->save();

        list($from, $to) = explode(' - ', $request->workshift_schedule_range);

        $user->workshiftSchedules()->updateOrInsert(
            [
                'user_id' => $user->id,
            ],
            [
                'workshift_id' => $request->workshift_id,
                'date_from' => Carbon::parse($from)->format('Ymd'),
                'date_to' => Carbon::parse($to)->format('Ymd')
            ]
        );
    }

    public function lastNameFirst()
    {
        if (empty($this->first_name) || empty($this->last_name)) {
            return 'Unassigned';
        }

        return ($this->last_name . ', ' . $this->first_name . ' ' . $this->middle_name);
    }

    public function firstNameFirst()
    {
        if (empty($this->first_name) || empty($this->last_name)) {
            return 'Unassigned';
        }

        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
    }

    public function firstAndLastName()
    {
        if (empty($this->first_name) || empty($this->last_name)) {
            return 'Unassigned';
        }
        
        return $this->first_name . ' ' . $this->last_name;
    }

    public function gender()
    {
        return $this->hasOne('App\Gender', 'id', 'gender_id');
    }

    public function getGender()
    {
        return $this->gender->name ?? 'Unassigned';
    }

    public function position()
    {
        return $this->hasOne('App\Position', 'id', 'position_id');
    }

    public function getPosition()
    {
        return $this->position->name ?? 'Unassigned';
    }

    public function division()
    {
        return $this->hasOne('App\Division', 'id', 'division_id');
    }

    public function getDivision()
    {
        return $this->division->name ?? 'Unassigned';
    }

    public function team()
    {
        return $this->hasOne('App\Team', 'id', 'team_id');
    }

    public function getTeam()
    {
        return $this->team->name ?? 'Unassigned';
    }

    public function account()
    {
        return $this->hasOne('App\Account', 'id', 'account_id');
    }

    public function getAccount()
    {
        return $this->account->name ?? 'Unassigned';
    }

    public function jobCode()
    {
        return $this->hasOne('App\JobCode', 'id', 'job_code_id');
    }

    public function getJobCode()
    {
        return $this->jobCode->code ?? 'Unassigned';
    }

    public function getJobCodeName()
    {
        return $this->jobCode->name ?? 'Unassigned';
    }

    public function workshift()
    {
        return $this->hasOne('App\Workshift', 'id', 'workshift_id');
    }

    public function getWorkshiftCode()
    {
        return $this->workshift->code ?? 'Unassigned';
    }

    public function getWorkshiftName()
    {
        return $this->workshift->name ?? 'Unassigned';
    }

    public function getStatus()
    {
        return ($this->status) ? 'Active' : 'Deactivated';
    }

    // Delete soon

    public function managers()
    {
        return collect([$this->direct_manager_id, $this->direct_manager_id_two, $this->direct_manager_id_three])->map(function ($id) {
            return $this->where('id', $id)->first();
        });
    }

    public function getManagersId()
    {
        return $this->managers()->map(function ($user) {
            return $user->id;
        });
    }

    public function getManagersEmployeeId()
    {
        return $this->managers()->map(function ($user) {
            return $user->employee_id;
        });
    }

    public function getManagersEmail()
    {
        return $this->managers()->map(function ($user) {
            return $user->email;
        });
    }

    public function getManagersName()
    {
        return $this->managers()->map(function ($user) {
            return $user->firstAndLastName();
        });
    }

    public function getManagerId()
    {
        return $this->where('id', $this->direct_manager_id)->pluck('id')->first() ?? 'Unassigned';
    }

    public function getManagerEmployeeId()
    {
        return $this->where('id', $this->direct_manager_id)->pluck('employee_id')->first() ?? 'Unassigned';
    }

    public function getManagerName()
    {
        $firstName = $this->where('id', $this->direct_manager_id)->pluck('first_name')->first();
        $lastName = $this->where('id', $this->direct_manager_id)->pluck('last_name')->first();

        return $firstName . ' ' . $lastName;
    }

    public function getManagerLastName()
    {
        return $this->where('id', $this->direct_manager_id)->pluck('last_name')->first() ?? 'Unassigned';
    }

    public function leaves()
    {
        return $this->hasMany('App\Leave');
    }

    public function attendances()
    {
        return $this->hasMany('App\Attendance');
    }

    public function overtimes()
    {
        return $this->hasMany(Overtime::class);
    }

    public function workshiftSchedules()
    {
        return $this->hasMany(WorkshiftSched::class);
    }
}
