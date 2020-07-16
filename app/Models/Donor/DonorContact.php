<?php

namespace App\Models\Donor;

use Illuminate\Database\Eloquent\Model;

class DonorContact extends Model
{
    protected $table = 'donors_contacts';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'donor_id',
        'contact_person_na',
        'contact_person_fo',
        'contact_mobile',
        'contact_email',
        'contact_job_title',
        'is_hidden',
    ];
    public $timestamps = false;
}
//id int(11) AI PK
//donor_id int(11)
//contact_person_na varchar(100)
//contact_person_fo varchar(100)
//contact_mobile varchar(40)
//contact_email varchar(100)
//contact_job_title varchar(100)
//is_hidden int(11)
//created_at timestamp
//created_by int(11)
//updated_at timestamp
//updated_by int(11)
//deleted_at timestamp
//deleted_by int(11)