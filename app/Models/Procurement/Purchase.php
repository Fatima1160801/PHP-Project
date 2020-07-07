<?php
namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
use SoftDeletes;
protected $table = 'purchase_methods';
protected $primaryKey = 'id';
protected $fillable =
[
'id',
'method_name_na',
'method_name_fo',
'updated_at',
'created_by',
'updated_by',
'deleted_by'

];


}