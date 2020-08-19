<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 9/24/2018
 * Time: 8:16 AM
 */

namespace App\Models\Beneficiary;

use App\Models\Activity\TypeActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class Beneficiary extends Model
{
   // use SoftDeletes;
    protected $table = 'beneficiary';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'ben_type_id', 'ben_name_na', 'ben_name_fo'
        , 'ben_idno', 'gender', 'marital_status', 'ben_city', 'ben_address_na', 'ben_address_fo'
        , 'ben_mobile_no', 'ben_tel_no', 'no_of_family'
        , 'desc_', 'is_hidden',
        'special_needs',
        'direct_income',
        'indirect_income',
        'created_by',
        'updated_by',
        'deleted_by',
        'no_males',
        'no_females',
        'no_special_needs',
        'note',
        'district_id'
    ];

    public $timestamps = true;


    public function beneficiaryType(){
        return $this->belongsTo(BeneficiaryType::class,'ben_type_id');
    }

}