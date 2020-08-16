<?php

namespace App\Models\Setting;

use App\Models\Setting\C\AttachmentTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AchievementTypes extends Model
{
    use SoftDeletes;

    protected $table = 'c_achivement_types';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'achivement_type_no',
        'achivement_type_fo',
        'is_hidden'
    ];
    public $timestamps = true;

}
