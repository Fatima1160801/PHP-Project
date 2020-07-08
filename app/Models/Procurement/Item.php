<?php
namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
use SoftDeletes;
//protected $table = 'opportunity_status';
protected $primaryKey = 'id';
protected $fillable =
[
'id',
'item_name',
'sku',
'updated_at',
'created_by',
'updated_by',
'deleted_by',
    'short_description',
 'description',
'item_group_id',
'brand_id',
'unit_id',
'upc',
'ean',
'mpn',
'isbn', 'icon', 'thumb', 'photo','status'
];



}
