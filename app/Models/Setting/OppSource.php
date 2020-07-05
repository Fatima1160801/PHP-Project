<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OppSource extends Model
{
    use SoftDeletes;
    protected $table = 'opportunity_sources';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'opportunity_source_na',
            'opportunity_source_fo',
            'is_hidden',
        ];
}
