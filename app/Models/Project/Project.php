<?php

namespace App\Models\Project;

use App\Models\Permission\User;
use App\Models\Permission\UserDataPermission;
use App\Models\Permission\UserDataPermissionModule;
use App\Models\Staff\Staff;
use App\Models\Strategic\StrategicPlan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $fillable = ['id',
        'reference_no',
        'project_name_na',
        'project_name_fo',
        'program_id',
        'category_id',
        'manager_id',
        'project_desc_na',
        'project_desc_fo',
        'act_budget',
        'plan_budget',
        'currency_id',
        'institution_contribution',
        'donor_contribution',
        'other_external_contributions',
        'is_hidden',
        'plan_start_date',
        'plan_end_date',
        'act_start_date',
        'act_end_date',
     ];

    public $timestamps = true;

    public function getProjectNameByUserLang()
    {
        $user_lang = Auth::user()->lang_id;
        if ($user_lang == 1) {
            return $this->project_name_na;
        } else {
            return $this->project_name_fo;
        }
    }


    public function donors()
    {
        return $this->belongsToMany('App\Models\Donor\Donor', 'project_donors');
    }

    public function currency()
    {
        return $this->belongsTo(Currencies::class, 'currency_id', 'id');
    }

    public function program()
    {
        return $this->belongsTo('App\Models\Programs\Program', 'program_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\ProjectCategory\ProjectCategory', 'category_id', 'id');
    }

    public function coordinator()
    {
        return $this->belongsTo('App\Models\Staff\Staff', 'coordinator_id', 'id');
    }

    public function manager()
    {
        return $this->belongsTo('App\Models\Staff\Staff', 'manager_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task\Task', 'project_id', 'id');
    }


    public static function getProject($strategic_id = null)
    {

        if ($strategic_id == null) {
            $strategics = StrategicPlan::orderBy('id', 'desc')->get();
            if (!isset($strategic_id)) {
                $strategic_id = $strategics->max('id');
            }

        }
        $user_id = Auth::id();
        //$projects = Project::where('strategic_id', $strategic_id)->where('is_hidden', '0')

        $projects_stratigic = ProjectStrategics::where('strategic_id',$strategic_id)
            ->pluck('project_id');
/*
         $projects = Project::where('is_hidden', '0')
            ->whereIn('id',$projects_stratigic )
            ->orderBy('id', 'desc');
*/

        $projects = Project::where('is_hidden', '0')
            ->where('deleted_at',null)
            ->whereIn('id',$projects_stratigic )
            ->orderBy('id', 'desc');

        if ($user_id == 1) {
            $projects = $projects->get();
        } else {
            $userPermData = UserDataPermission::where('user_id', $user_id)
                ->where('module_id', 1)
                ->first();

            if ($userPermData != null) {
                if ($userPermData->perm_type == 1) {
                    $projects = $projects->get();
                } else if ($userPermData->perm_type == 2) {
                    $projects_ids = UserDataPermissionModule::where('user_id', $user_id)
                        ->where('module_id', 1)->pluck('primary_id')->unique()->toArray();

                    $projects = $projects->whereIn('id', $projects_ids)->get();
                } else if ($userPermData->perm_type == 3) {

                    $staff_id = Auth::user()->staff_id;
                    if ($staff_id != null) {
                        $projects_ids = ProjectStaffs::where('staff_id', $staff_id)
                            ->pluck('project_id')->unique()->toArray();
                        $projects = $projects->whereIn('id', $projects_ids)->get();
                    } else {
                        $projects = null;
                    }

                }
            } else {
                $projects =null;
            }
        }

        return $projects;
    }


    public static function getProjectPaginate($strategic_id = null,$page)
    {

      if ($strategic_id == null) {
        $strategics = StrategicPlan::orderBy('id', 'desc')->get();
        if (!isset($strategic_id)) {
          $strategic_id = $strategics->max('id');
        }

      }
        $user_id = Auth::id();
        //$projects = Project::where('strategic_id', $strategic_id)->where('is_hidden', '0')
       $projects_stratigic = ProjectStrategics::where('strategic_id',$strategic_id)
                    ->pluck('project_id');

           /*      $projects = Project::where('is_hidden', '0')
                    ->whereIn('id',$projects_stratigic )
                    ->orderBy('id', 'desc');
        */
        $projects = Project::where('is_hidden', '0')
            ->where('deleted_at',null)
            ->whereIn('id',$projects_stratigic)
            ->orderBy('id', 'desc');

        if ($user_id == 1) {
            $projects = $projects->paginate(4);;
        } else {
            $userPermData = UserDataPermission::where('user_id', $user_id)
                ->where('module_id', 1)
                ->first();

            if ($userPermData != null) {
                if ($userPermData->perm_type == 1) {
                    $projects = $projects->paginate(4);;
                } else if ($userPermData->perm_type == 2) {
                    $projects_ids = UserDataPermissionModule::where('user_id', $user_id)
                        ->where('module_id', 1)->pluck('primary_id')->unique()->toArray();

                    $projects = $projects->whereIn('id', $projects_ids)->paginate(4);;
                } else if ($userPermData->perm_type == 3) {

                    $staff_id = Auth::user()->staff_id;
                    if ($staff_id != null) {
                        $projects_ids = ProjectStaffs::where('staff_id', $staff_id)
                            ->pluck('project_id')->unique()->toArray();
                        $projects = $projects->whereIn('id', $projects_ids)->get();
                    } else {
                        $projects = null;
                    }

                }
            } else {
                $projects =null;
            }
        }
        return $projects;
    }


    public static function getProject_ids($strategic_id)
    {
        $user_id = Auth::id();


        $projects = Project::where('strategic_id', $strategic_id)
            ->orderBy('id', 'desc');


        if ($user_id == 1) {
            $projects_ids = 'all';
        } else {
            $userPermData = UserDataPermission::where('user_id', $user_id)
                ->where('module_id', 1)
                ->first();

            if ($userPermData != null) {
                if ($userPermData->perm_type == 1) {
                    $projects_ids = 'all';
                } else if ($userPermData->perm_type == 2) {
                    $projects_ids = UserDataPermissionModule::where('user_id', $user_id)
                        ->where('module_id', 1)->pluck('primary_id')->unique()->toArray();
                } else if ($userPermData->perm_type == 3) {

                    $staff_id = Auth::user()->staff_id;
                    if ($staff_id != null) {
                        $projects_ids = ProjectStaffs::where('staff_id', $staff_id)
                            ->pluck('project_id')->unique()->toArray();
                    } else {
                        $projects_ids = new Project();
                    }

                }
            } else {
                $projects_ids = new Project();
            }
        }
        return $projects_ids;
    }

   public function staffManager(){
       return $this->belongsTo(Staff::Class,'manager_id','id');
   }
    public function staffCoordinator(){
       return $this->belongsTo(Staff::Class,'coordinator_id','id');
   }

   public function userCreate(){
       return $this->belongsTo(User::class,'created_by','id');
   }


}
