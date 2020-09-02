<?php

namespace App\Models\JobTitle;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamRole extends Model
{
    use SoftDeletes;
    protected $table = 'c_project_team_role';
    protected $primarykey = 'id';
    protected $fillable = ['id', 'role_name_na', 'role_name_fo',
        'is_hidden', 'created_by', 'updated_by','deleted_by'];
    public $timestamps = true;


//    public function getNameById($id)
//    {
//        $title = $this->find($id);
//        if ($title) {
//            return $title->staff_name_na;
//        } else {
//            return '';
//        }
//    }


}


