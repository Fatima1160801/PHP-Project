<?php

namespace App\Models\Activity;

use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Location extends Model
{
  //  use SoftDeletes;
    protected $table = 'activity_locations';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'activity_id',
            'city_id',
            'destrict_',
            'location_na',
            'location_fo',
            'team_member',
            'is_hidden',
            'created_by',
            'updated_by',
            'deleted_by',
        ];
//    public $timestamps = false;
//    public $incrementing = false;


    public function staff()
    {
        return $this->belongsTo(Staff::class, 'team_member', 'id');
    }

}
