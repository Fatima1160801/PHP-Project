<?php

namespace App\Models\Setting;

use App\Models\Setting\C\AttachmentTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AchievementTypesMetrics extends Model
{
    use SoftDeletes;

    protected $table = 'c_achivement_type_metrics';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'c_achivement_type_id',
        'ach_type_metric_no',
        'ach_type_metric_fo',
        'measure_unit_id',
        'is_hidden',
    ];
    public $timestamps = true;

}
