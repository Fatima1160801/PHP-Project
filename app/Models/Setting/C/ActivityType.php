<?php


namespace App\Models\Setting\C;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{

    protected $table = 'c_activity_types';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'act_type_name_no',
        'act_type_name_fo',
        'is_hidden',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];

    public $timestamps = false;
}