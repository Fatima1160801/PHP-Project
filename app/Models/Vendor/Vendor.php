<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

//    public function sectors()
//    {
//        return $this->belongsToMany('App\Models\Vendor\Vendor_Sector');
//    }
    public function state()
    {
        return $this->belongsTo('App\Models\Procurement\State','state_id');
    }

}