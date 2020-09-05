<?php

namespace App\Models\Activity;

use Illuminate\Database\Eloquent\Model;


class BeneficiariesAllVw extends Model
{

    protected $table = 'beneficiaries_all_vw';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'type',
            'id_type',
            'beneficieris_types_name_na',
            'beneficieris_types_name_fo',
            'ben_name_na',
            'ben_name_fo',
            'ben_idno',
            'ben_name_na_id',
            'ben_name_fo_id',
            'gender_name',
            'marital_status_name',
            'ben_city',
            'city_name_no',
            'city_name_fo',
            'district_id',
            'district_name_na',
            'district_name_fo',
            'ben_address_na',
            'ben_address_fo',
            'ben_mobile_no',
            'ben_tel_no',
            'no_of_family',
            'desc_',
            'org_type',
            'ben_fax_no',
            'ben_email',
            'ben_url',
            'contact_person_na',
            'contact_person_fo',
            'contact_mobile',
            'contact_email',
            'contact_job_title',
            'is_hidden',
            'note',
        ];
    public $timestamps = false;
    public $incrementing = false;


    public static function getBeneficiary($id,$type){
        $BeneficiariesAllVw = BeneficiariesAllVw::where('id',$id)
            ->where('type',$type)
            ->first();
        if($BeneficiariesAllVw) {
            return $BeneficiariesAllVw->{'ben_name_'.lang_character()};
        }
        return ' ';
    }

}
