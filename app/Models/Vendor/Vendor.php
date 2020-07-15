<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Vendor extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'vendor_name_na',
            'vendor_name_fo',
            'vat_number',
            'country_id',
            'state_id',
            'city_id',
            'address',
            'telephone',
            'fax',
            'email',
            'website',
            'notes',
            'updated_at',
            'created_by',
            'updated_by',
            'deleted_by'

        ];

    public $appends=["state_name"];

//    public function sectors()
//    {
//        return $this->belongsToMany('App\Models\Vendor\Vendor_Sector');
//    }
    public function getStateNameAttribute()
    {
       $info= \App\Models\Procurement\State::where("id",$this->attributes['state_id'])->where("language_id",Auth::user()->lang_id ==1 ?2:1)->first();
        return $info->state_name ?? "";
     // return $this->hasMany('App\Models\Procurement\State','id','state_id');
    }

}