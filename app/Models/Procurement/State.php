<?php

namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    // use SoftDeletes;
    protected $primaryKey = ['id','language_id'];
    public $incrementing = false;

}