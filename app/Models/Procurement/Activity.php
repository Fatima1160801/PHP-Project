<?php

namespace App\Models\Procurement;

use App\Models\Permission\UserDataPermission;
use App\Models\Permission\UserDataPermissionModule;
use App\Models\Project\ProjectResultObjective;
use App\Models\Project\ProjectSpecificObjective;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Activity extends Model
{

    use SoftDeletes;
    protected $table = 'activities';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'project_id',
            'activity_name_na',
            'activity_name_fo',
            'level_type_id',
            'level_id',
            'parent_id',
            'activity_desc_na',
            'activity_desc_fo',
            'planed_start_date',
            'planed_end_date',
            'act_start_date',
            'act_end_date',
            'staff_id',
            'completion_percent',
            'is_hidden',
            'notes',
            'explain_achievement',
            'status_id',
            'serial_private',
            'serial_public',
            'activity_load',
            'planned_budget',
            'act_budget',
            'planned_contribution',
            'act_contribution',
            'color',
        ];


    public function subActivity()
    {
        return $this->hasMany('App\Models\Activity\Activity', 'parent_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project\Project', 'project_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task\Task', 'activity_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Activity\Activity_status', 'status_id', 'id');
    }
    public static function getActivity($project_ids)
    {
        $user_id = Auth::id();

        if (gettype($project_ids) == 'string') {
            $activities = Activity::where('parent_id', '0')
                ->where('is_hidden', '0')
                ->where('project_id', $project_ids)
                ->orderBy('id', 'desc');
        } else {
            $activities = Activity::where('parent_id', '0')
                ->whereIn('project_id', $project_ids)
                ->where('is_hidden', '0')
                ->orderBy('id', 'desc');
        }

        $userPermData = UserDataPermission::where('user_id', $user_id)->where('module_id', 2)->first();

        if ($userPermData != null) {
            if ($userPermData->perm_type == 1) {
                $activities = $activities->get();
            } else if ($userPermData->perm_type == 2) {
                $activities_ids = UserDataPermissionModule::where('user_id', Auth::id())
                    ->where('module_id', 2)->pluck('primary_id')
                    ->unique()->toArray();
                $activities_created_by  =  Activity::where('created_by', Auth::id())->pluck('id')->toArray();
                $activities_ids = array_merge($activities_created_by,$activities_ids);

                $activities = $activities->whereIn('id', $activities_ids)->get();
            } else if ($userPermData->perm_type == 3) {
                $staff_id = Auth::user()->staff_id;
                if ($staff_id != null) {
                    $activities_ids = ActivityStaff::where('staff_id', $staff_id)
                        ->pluck('activity_id')->unique()->toArray();
                    $activities_created_by  =  Activity::where('created_by', Auth::id())->pluck('id')->toArray();
                    $activities_ids = array_merge($activities_created_by,$activities_ids);

                    $activities = $activities->whereIn('id', $activities_ids)->get();

                } else {
                    $activities =null;
                }

            }
        } else {
            if ($user_id == 1) {
                $activities = $activities->get();
            } else {
                $activities =null;
            }
        }
        return $activities;

    }

    public static function getAllActivity($project_ids)
    {
        $user_id = Auth::id();
        if (gettype($project_ids) == 'string') {
            $activities = Activity::where('is_hidden', '0')
                ->where('project_id', $project_ids)
                ->orderBy('id', 'desc');
        } else {
            $activities = Activity::whereIn('project_id', $project_ids)
                ->where('is_hidden', '0')
                ->orderBy('id', 'desc');
        }

        $userPermData = UserDataPermission::where('user_id', $user_id)->where('module_id', 2)->first();
        if ($userPermData != null) {
            if ($userPermData->perm_type == 1) {
                $activities = $activities->get();
            } else if ($userPermData->perm_type == 2) {
                $activities_ids = UserDataPermissionModule::where('user_id', Auth::id())->where('module_id', 2)->pluck('primary_id')->unique()->toArray();
                $activities = $activities->whereIn('id', $activities_ids)->get();
            } else if ($userPermData->perm_type == 3) {

                $staff_id = Auth::user()->staff_id;
                if ($staff_id != null) {
                    $activities_ids = ActivityStaff::where('staff_id', $staff_id)
                        ->pluck('activity_id')->unique()->toArray();
                    $activities = $activities->whereIn('id', $activities_ids)->get();

                } else {
                    $activities =null;
                }

            }
        } else {
            if ($user_id == 1) {
                $activities = $activities->get();
            } else {
                $activities =null;
            }
        }
        return $activities;

    }

    public static function getActivityPaginate($project_ids,$page)
    {
        $user_id = Auth::id();
        if (gettype($project_ids) == 'string') {
            $activities = Activity::where('parent_id', '0')
                ->where('is_hidden', '0')
                ->where('project_id', $project_ids)
                ->orderBy('id', 'desc');
        } else {
            $activities = Activity::where('parent_id', '0')
                ->whereIn('project_id', $project_ids)
                ->where('is_hidden', '0')
                ->orderBy('id', 'desc');
        }
        $userPermData = UserDataPermission::where('user_id', $user_id)->where('module_id', 2)->first();
        if ($userPermData != null) {
            if ($userPermData->perm_type == 1) {
                $activities = $activities->paginate(4);
            } else if ($userPermData->perm_type == 2) {
                $activities_ids = UserDataPermissionModule::where('user_id', Auth::id())->where('module_id', 2)->pluck('primary_id')->unique()->toArray();
                $activities = $activities->whereIn('id', $activities_ids)->paginate(4);
            } else if ($userPermData->perm_type == 3) {

                $staff_id = Auth::user()->staff_id;
                if ($staff_id != null) {
                    $activities_ids = ActivityStaff::where('staff_id', $staff_id)
                        ->pluck('activity_id')->unique()->toArray();
                    $activities = $activities->whereIn('id', $activities_ids)->paginate(4);

                } else {
                    $activities =null;
                }
            }
        } else {
            if ($user_id == 1) {
                $activities = $activities->paginate(4);
            } else {
                $activities =null;
            }
        }
        return $activities;

    }

    public static function getActivitySub($project_ids, $activity_main_id)
    {
        $user_id = Auth::id();
        if (gettype($project_ids) == 'string' && !empty($project_ids) && $project_ids != null && $project_ids != 0) {
            $activities = Activity::where('parent_id', $activity_main_id)
                ->where('is_hidden', '0')
                ->where('project_id', $project_ids)
                ->orderBy('id', 'desc');
        } else if (!empty($project_ids) && $project_ids != null && $project_ids != 0) {
            $activities = Activity::where('parent_id', $activity_main_id)
                ->where('is_hidden', '0')
                ->whereIn('project_id', $project_ids)
                ->orderBy('id', 'desc');
        } else {
            $activities = Activity::where('parent_id', $activity_main_id)
                ->where('is_hidden', '0')
                ->orderBy('id', 'desc');
        }

        $userPermData = UserDataPermission::where('user_id', $user_id)->where('module_id', 2)->first();
        if ($userPermData != null) {
            if ($userPermData->perm_type == 1) {
                $activities = $activities->get();
            } else if ($userPermData->perm_type == 2) {
                $activities_ids = UserDataPermissionModule::where('user_id', Auth::id())->where('module_id', 2)->pluck('primary_id')->unique()->toArray();
                $activities = $activities->whereIn('id', $activities_ids)->get();
            } else if ($userPermData->perm_type == 3) {

                $staff_id = Auth::user()->staff_id;

                if ($staff_id != null) {
                    $activities_ids = ActivityStaff::where('staff_id', $staff_id)
                        ->pluck('activity_id')->unique()->toArray();

                    $activities = $activities->whereIn('id', $activities_ids)->get();
                } else {
                    $activities = null;
                }

            }
        } else {
            if ($user_id == 1) {
                $activities = $activities->get();
            } else {
                $activities = null;
            }
        }

        return $activities;

    }

    public function getLevelNameAttribute()
    {
        $result = '';
        if ($this->level_type_id == 2) {

            $result = ProjectSpecificObjective::find($this->level_id);
            $result=  $result ?$result->{'specific_objective_name_' . lang_character()}:" ";
        } elseif ($this->level_type_id == 3) {
            $result = ProjectResultObjective::find($this->level_id);
            $result=$result?$result->{'results_objective_name_' . lang_character()}:'';
        }
        return $result;
    }

//    public function getGovernateLocation(){
//        $result=new ActivityLocationView();
//        if(!empty($this->attributes['parent_id'])){
//            if($this->attributes['parent_id']==0){
//                $result=ActivityLocationView::where('activity_id',$this->attributes['id'])->get();
//            }
//
//        }
//        return $result;
//    }
    public function cities()
    {

        return $this->hasMany('App\Models\Procurement\ActivityLocationView','activity_id','id');
    }
}
