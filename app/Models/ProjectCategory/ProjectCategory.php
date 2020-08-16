<?php

namespace App\Models\ProjectCategory;

use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    protected $table = 'c_project_categories';
    protected $primarykey = 'id';
    protected $fillable = ['id', 'category_name_na', 'category_name_fo', 'is_hidden','created_by','updated_by'];
    public $timestamps = true;
}
