<?php

namespace App\Models\Activity;

use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Model;


class LessonsType extends Model
{

    protected $table = 'activity_lessons_type';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'activity_lessons_type_name_na',
            'activity_lessons_type_name_fo',
        ];
}
