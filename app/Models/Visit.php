<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Visit extends Model
{
    use SoftDeletes;
    protected $table = 'visits';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'name',
            'date_visits',
            'city_id',
            'destrict_id',
            'description',
            'file',
            'is_hidden',
            'file_name',
            'project_id',
            'main_activity_id',
            'sub_activity_id',
            'visit_type_id',
            'issues_type'
        ];
}
