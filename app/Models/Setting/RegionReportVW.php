<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class RegionReportVW extends Model
{
    protected $table = 'region_report_view';
    protected $primarykey = 'id';
    protected $fillable = [
        'c_cities_id',
        'city_name_no',
        'city_name_fo',
        'c_districts_id',
        'district_name_no',
        'district_name_fo',
        'projects_id',
        'project_name_na',
        'project_name_fo',
        'activities_id',
        'activity_name_na',
        'activity_name_fo',
        'level_name_na',
        'level_name_fo',
        'relation_higher_level',
    ];
    public $timestamps = false;

}
