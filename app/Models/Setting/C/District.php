<?php


namespace App\Models\Setting\C;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use SoftDeletes;

    protected $table = 'c_districts';
    protected $primarykey = 'id';
    protected $fillable = [
        'id', 'city_id',
        'district_name_no',
        'district_name_fo',
        'longitude',
        'latitude',
        'is_hidden'
    ];

    public $timestamps = true;


    public function city()
    {
        return $this->belongsTo('App\Models\Setting\C\City','city_id','id');
    }
}