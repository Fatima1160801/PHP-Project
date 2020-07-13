<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobTitle extends Model
{
    use SoftDeletes;
    protected $table='c_job_titles';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'job_title_name_na',
            'job_title_name_fo',
            'is_inside_outside',
            'is_hidden',
            'updated_at',
            'created_by',
            'updated_by',
            'deleted_by'

        ];


}