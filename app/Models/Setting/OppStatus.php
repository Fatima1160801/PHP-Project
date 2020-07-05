<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class OppStatus extends Model
{
    // use SoftDeletes;
    public $timestamps = false;
    protected $table = 'opportunity_status';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'opportunity_status_na',
            'opportunity_status_fo',
        ];

   
}
