<?php


namespace App\Models\Setting\C;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    protected $table = 'c_cities';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'city_name_no',
        'city_name_fo',
        'longitude',
        'latitude',
        'is_hidden'
    ];

    public $timestamps = true;
}