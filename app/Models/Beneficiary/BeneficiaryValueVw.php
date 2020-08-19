<?php

namespace App\Models\Beneficiary;

use App\Models\Activity\TypeActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class BeneficiaryValueVw extends Model
{
    protected $table = 'beneficiary_value_view';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'act_ben_id',
        'bant_value',
        'ben_date',
        'value_ben_desc',
        'activity_id',
        'project_id',
        'ben_id',
        'activity_result_id',
        'org_result_id',
        'planed_value',
        'act_value',
        'rate',
        'ben_desc',
        'ben_type_id',
        'activity_name_na',
        'activity_name_fo',
        'project_name_na',
        'project_name_fo',
        'result_name_na',
        'result_name_fo',
        'result_unit',
        'unit_name_no',
        'unit_name_fo',
    ];

}