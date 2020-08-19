<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 11/20/2018
 * Time: 9:19 AM
 */

namespace App\Models\Locality;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locality extends Model
{
    //use SoftDeletes;

    protected $table = 'locality';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'city_id',
        'district_id',
        'registration_number',
        'locality_name_na','locality_name_fo',
        'address_na', 'address_fo', 'contact_person_na', 'contact_person_fo','contact_mobile',
        'contact_email', 'is_hidden','note'
    ];

    public $timestamps = true;


    public function city()
    {
        return $this->belongsTo('App\Models\Setting\C\City','city_id','id');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\Setting\C\District','district_id','id');
    }
}