<?php

namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemGroups extends Model
{
    use SoftDeletes;
    protected $table = 'item_groups';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'item_group_name_na',
            'item_group_name_fo',
            'description',
            'sector_id',
            'unit_id',
            'updated_at',
            'created_by',
            'updated_by',
            'deleted_by'

        ];


}