<?php

namespace App\Models\Beneficiary;

use Illuminate\Database\Eloquent\Model;

class BeneficiaryType extends Model
{
    protected $table = 'c_beneficieris_types';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'beneficieris_types_name_fo',
        'beneficieris_types_name_na'
    ];
    public $timestamps = true;

}
