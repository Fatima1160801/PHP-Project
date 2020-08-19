<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 9/26/2018
 * Time: 10:57 AM
 */

namespace App\Models\Beneficiary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BeneficiaryOrganization extends Model
{
   // use SoftDeletes;
    protected $table = 'org_beneficiary';
    protected $primaryKey = 'id';
    protected $fillable = ['id','org_type',
        'ben_name_na', 'ben_name_fo'
        ,'ben_address_na','ben_address_fo','ben_mobile_no','ben_tel_no','ben_fax_no','ben_email','ben_url','contact_person_na'
        ,'contact_person_fo','contact_mobile','contact_email',
        'contact_job_title',
        'is_hidden',
        'created_by',
        'updated_by',
        'deleted_by',
        'members_number',
        'note',
        'city_id',
        'district_id',
        'registration_number',
    ];

    public $timestamps = true;
}