<?php


namespace App\Models\Beneficiary;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BeneficiaryFamily extends Model
{
   // use SoftDeletes;
    protected $table = 'ben_families';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'ben_id', 'relation_type', 'ind_name_na'
        , 'ind_name_fo', 'ind_idno', 'gender', 'marital_status', 'desc_',
        'special_needs',
        'is_hidden',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public $timestamps = true;
}