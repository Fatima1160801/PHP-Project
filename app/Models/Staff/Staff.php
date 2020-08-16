<?php

namespace App\Models\Staff;

use App\Models\JobTitle\JobTitle;
use App\Models\Permission\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;
    protected $table = 'staff';
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
        'supervisor_id',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->hasOne(User::class, 'staff_id', 'id');
    }

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class,'job_title_id');
    }
    public function supervisor()
    {
        return $this->belongsTo(Staff::class,'supervisor_id','id');
    }




}
