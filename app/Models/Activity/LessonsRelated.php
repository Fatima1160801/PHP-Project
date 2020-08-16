<?php

namespace App\Models\Activity;

use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LessonsRelated extends Model
{
    use  SoftDeletes;
    protected $table = 'activity_lessons_related';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'activity_lessons_related_name_na',
            'activity_lessons_related_name_fo',
        ];
}
