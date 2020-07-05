<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobTitle extends Model
{
    use SoftDeletes;
    protected $table = 'c_job_titles';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            // 'opportunity_id',
            // 'donor_id',
            // 'is_hidden',
        ];
    
    // public $incrementing = false;
 
     
}
