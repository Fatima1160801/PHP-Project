<?php

namespace App\Models\Staff;

use App\Models\JobTitle\JobTitle;
use App\Models\Permission\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffUserVW extends Model
{
     protected $table = 'staff_user_vw';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'staff_type',
        'staff_name_na',
        'staff_name_fo',
        'employment_date',
        'dob',
        'job_title_id',
        'address_na',
        'address_fo',
        'mobile_no',
        'tel_no',
        'email',
        'url',
        'is_hidden',
        'notes',
        'avatar_',
        'idno',
        'idno',
        'type_name_na',
        'type_name_fo',
        'job_title_name_na',
        'job_title_name_fo'
    ];

    public $timestamps = false;


}
