<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Currencies extends Model
{
    protected $table = 'c_currencies';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'currency_name_na',
        'currency_name_fo',
        'currency_symbol',
        'currency_round',
        'is_hidden',
    ];


}
