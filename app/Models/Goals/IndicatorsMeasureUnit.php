<?php

namespace App\Models\Goals;

use Illuminate\Database\Eloquent\Model;

class IndicatorsMeasureUnit extends Model
{
    protected $table = 'c_measure_units';
    protected $primarykey = 'id';
    protected $fillable = ['id', 'unit_name_no', 'unit_name_fo', 'is_hidden'];
    public $timestamps = true;

}


