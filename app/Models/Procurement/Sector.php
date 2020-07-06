<?php

namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;

class Sector extends Model
{
     use SoftDeletes;
    //protected $table = 'opportunity_status';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'sector_name_na',
            'sector_name_fo',
            'updated_at',
        ];


}
