<?php


namespace App\Models\Setting\C;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskType extends Model
{
    use SoftDeletes;

    protected $table = 'c_task_type';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'task_type_name_na',
        'task_type_name_fo',
        'is_hidden',
        'created_by'
    ];

    public $timestamps = true;
}