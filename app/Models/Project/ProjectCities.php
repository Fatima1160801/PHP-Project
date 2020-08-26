<?php

namespace App\Models\Project;

use App\Models\Donor\Donor;
use App\Models\Setting\C\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProjectCities extends Model
{
    protected $table = 'project_cities';
    protected $primaryKey = ['city_id', 'project_id'];
    protected $fillable = [
        'city_id',
        'project_id'
    ];

    public $timestamps = false;
    public $incrementing = false;

    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }

}
