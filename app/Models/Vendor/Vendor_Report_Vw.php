<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor_Report_Vw extends Model
{
    protected $table='vendors_report_vw';
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
            'country_name_na',
           ' country_name_fo',
            'state_name_na',
            'state_name_fo',
            'city_name_na',
            'city_name_fo',
            'sectors_name_na',
            'sectors_name_fo',
            'sectors_ids',
            'updated_at',
            'created_by',
            'updated_by',
            'deleted_by'


        ];
    public $timestamps=false;


}