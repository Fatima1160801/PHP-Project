<?php

namespace App\Models\plan;

use App\Models\Permission\UserDataPermission;
use App\Models\Permission\UserDataPermissionModule;
use App\Models\Project\ProjectResultObjective;
use App\Models\Project\ProjectSpecificObjective;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Plan extends Model
{

    use SoftDeletes;

    protected $table = 'proc_plans';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'project_id',

            'activity_id',
            'created_by',
            'updated_by',
            'deleted_by',
            'updated_at'

        ];
}