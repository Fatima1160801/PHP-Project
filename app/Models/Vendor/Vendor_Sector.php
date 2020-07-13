<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor_Sector extends Model
{
    protected $table='vendor_sector';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'vendor_id',
            ' sector_id',

        ];
    public $timestamps=false;


}