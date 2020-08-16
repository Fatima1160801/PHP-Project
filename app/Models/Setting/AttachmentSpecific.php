<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AttachmentSpecific extends Model
{
    
    use SoftDeletes;
    protected $table = 'c_attachment_specific';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'attachment_type_na',
            'attachment_type_fo',
            'is_hidden',
        ];

    public function document()
    {
        // return $this->belongsTo('App\Document');
        return $this->belongsTo('App\Models\Setting\Document');
    }
}
