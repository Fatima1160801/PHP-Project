<?php

namespace App\Models\Donor;

use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Model;

class FocalPoint extends Model
{
    protected $table = 'donors_focal_hist';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'donor_id',
        'staff_id',
        'start_date',
        'end_date',
    ];
    public $timestamps = true;


    public function getNameStaff($id){
        $staff=Staff::find($id);
        if($staff){
            return $staff->staff_name_na;
        }
        return '';
    }
}

