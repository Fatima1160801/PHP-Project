<?php

namespace App\Models\Activity;

use App\Models\Beneficiary\Beneficiary;
use App\Models\Beneficiary\BeneficiaryOrganization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ActivityBeneficiaries extends Model
{
    //use SoftDeletes;
    protected $table = 'activity_beneficiaries';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'activity_id',
            'ben_id',
            'ben_type_id',
            'governorate_id',
            'location_id',
        ];

    public function getName($ben_id, $ben_type_id)
    {

        if ($ben_type_id == 1 || $ben_type_id == 2) {

            $beneficiary = Beneficiary::find($ben_id);
            if ($beneficiary) {
                return $beneficiary->ben_name_na;
            } else {
                return 'Data Not Found';
            }
        } elseif ($ben_type_id == 3) {
            $BeneficiaryOrganization = BeneficiaryOrganization::find($ben_id);
            if ($BeneficiaryOrganization) {
                return $BeneficiaryOrganization->ben_name_na;
            } else {
                return 'Data Not Found';
            }
        }
    }
}
