<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactPersons extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'full_name',
            'job_title_id',
            'tel_number',
            'email',
            'vendor_id',
            'updated_at',
            'created_by',
            'updated_by',
            'deleted_by'

        ];


}