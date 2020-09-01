<?php

namespace App\Models\Project;

use App\Models\Donor\Donor;
use App\Models\JobTitle\JobTitle;
use App\Models\Setting\ProjectTeamRole;
use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ProjectStaffs extends Model
{
    // use SoftDeletes;
    protected $table = 'project_staffes';
    protected $primaryKey = ['staff_id', 'project_id'];
    protected $fillable = [
        'project_id',
        'staff_id',
        'project_team_role_id'

    ];
    public $timestamps = false;
    public $incrementing = false;

    public function getStuffNameById($id){
        $staffs = Staff::find($id);
        if($staffs){
            return $staffs->staff_name_.lang_character();
        }
        else{
            return '';
        }
    }

    public function getTitleJobNameById($id){
        $project_team_role= ProjectTeamRole::find($id);
        if($project_team_role){
            return $project_team_role->{'role_name_'.lang_character()};
        }
        else{
            return '';
        }
    }

    public function staff(){
        return $this->belongsTo('App\Models\Staff\Staff','staff_id','id');
    }
}
