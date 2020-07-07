<?php

namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;
    //protected $table = 'opportunity_status';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'unit_name_na',
            'unit_name_fo',
            'updated_at',
        ];


}