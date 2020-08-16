<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class StaffReportVW extends Model
{
    protected $table = 'staff_report_vw';
    protected $primarykey = 'id';
    protected $fillable = [
        'staff_id',
        'staff_name_na',
        'staff_name_fo',
        'idno',
        'job_title_id',
        'job_title_name_na',
        'job_title_name_fo',
        'projects_id',
        'project_name_na',
        'project_name_fo',
        'activities_id',
        'activity_name_na',
        'activity_name_fo',
        'level_name_na',
        'level_name_fo',
        'level_type_id',
        'relation_higher_level',
    ];
    public $timestamps = false;

}
