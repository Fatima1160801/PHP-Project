<?php


namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomeRange extends Model
{
    use SoftDeletes;

    protected $table = 'c_income_range';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'income_name_na',
        'income_name_fo',
        'is_hidden',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public $timestamps = true;


}