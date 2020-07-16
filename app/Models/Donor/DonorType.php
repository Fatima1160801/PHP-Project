<?php

namespace App\Models\Donor;

use Illuminate\Database\Eloquent\Model;

class DonorType extends Model
{
    protected $table = 'c_donor_types';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'type_name_na',
        'type_name_fo',
        'type_desc_na',
        'type_desc_fo',
        'is_hidden'
    ];
    public $timestamps = false;

//    public function getIsHiddenAttribute()
//    {
//        if($this->attributes['is_hidden'] == 0){
//            return 'Active';
//        }elseif($this->attributes['is_hidden'] == 1){
//            return 'InActive';
//        }
//        return ' ';
//    }

}
