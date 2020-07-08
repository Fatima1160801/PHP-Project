<?php

namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;

    //protected $table = 'opportunity_status';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'brand_name',
            'created_by',
            'updated_by',
            'deleted_by',
            'updated_at'

        ];
}