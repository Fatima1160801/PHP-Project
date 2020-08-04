<?php

namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityLocationView extends Model
{
    protected $table='activity_locations_vw';
    // use SoftDeletes;
    protected $primaryKey = ['id'];

   public $incrementing = false;
    protected $fillable =
        [
            'id',
            'activity_id',
            'city_name_na',
            'district_name_na',

];
}