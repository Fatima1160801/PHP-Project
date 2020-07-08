<?php

namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    //protected $table = 'item_groups';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'service_name_na',
            'service_name_fo',
            'sector_id',
            'updated_at',
            'created_by',
            'updated_by',
            'deleted_by'

        ];


}