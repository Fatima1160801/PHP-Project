<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;

class StaffType extends Model
{
    protected $table = 'c_staff_types';
    protected $primarykey = 'id';
    protected $fillable = ['id', 'type_name_na', 'type_name_fo'];
    public $timestamps = false;
}
