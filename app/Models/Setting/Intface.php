<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Intface extends Model
{
    use SoftDeletes;
    protected $table = 'interface_types';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'interface_type_na',
            'interface_type_fo',
            'is_hidden',
        ];

    public function document()
    {
        // return $this->belongsTo('App\Document');
        return $this->belongsTo('App\Models\Setting\Document', 'foreign_key', 'id');
    }
}
