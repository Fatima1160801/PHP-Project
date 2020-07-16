<?php

namespace App\Models\Donor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donor extends Model
{
    use SoftDeletes;
    protected $table = 'donors';
    protected $primarykey = 'id';
    protected $fillable = ['id', 'donor_name_na', 'donor_name_fo', 'is_hidden','created_by','updated_by',
        'donor_type_id','donor_address_na','donor_address_fo','donor_mobile_no','donor_tel_no','donor_fax_no'
        ,'donor_email','donor_url','donor_logo','contact_person_na','contact_person_fo','contact_mobile','contact_email',
        'contact_job_title','is_hidden','focal_staff_id','type'];
    public $timestamps = true;

    public function projects()
    {
        return $this->belongsToMany('App\Models\Project\Project','project_donors');
    }

    public function getIsHiddenAttribute()
    {
        if($this->attributes['is_hidden'] == 0){
            return 'Active';
        }elseif($this->attributes['is_hidden'] == 1){
            return 'InActive';
        }
        return ' ';
    }
    /* public function DonorTypes(){
        return $this->belongsTo('App\Models\Donor\DonorType','id','id');
    } */

}
