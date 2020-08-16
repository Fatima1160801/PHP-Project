<?php

namespace App\Models\JobTitle;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobTitle extends Model
{
    use SoftDeletes;
    protected $table = 'c_job_titles';
    protected $primarykey = 'id';
    protected $fillable = ['id', 'job_title_name_fo', 'job_title_name_na', 'is_inside_outside',
        'is_hidden', 'created_by', 'updated_by','deleted_by'];
    public $timestamps = true;


    public function getNameById($id)
    {
        $title = $this->find($id);
        if ($title) {
            return $title->staff_name_na;
        } else {
            return '';
        }
    }


}


