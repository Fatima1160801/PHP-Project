<?php

namespace App\Models\Setting;

use App\Models\Setting\C\AttachmentTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityAchievementTypes extends Model
{
    use SoftDeletes;

    protected $table = 'activity_achivement_types';
    protected $primarykey = ['activitiy_id','c_achivement_type_id'];
    protected $fillable = [
        'activitiy_id',
        'c_achivement_type_id'
    ];
    public $timestamps = true;

}
