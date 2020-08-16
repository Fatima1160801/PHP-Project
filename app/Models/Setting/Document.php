<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    // use SoftDeletes;
    protected $table = 'doc_settings';
    protected $primaryKey = ['interface_type_id', 'attachment_type_id'];
    protected $fillable =
        [
            'interface_type_id',
            'attachment_type_id',
            'fixed_in_interface_flag',
            'is_hidden',
        ];
    
    public $incrementing = false;

    public function attachment()
    {
      	return $this->hasOne('App\Models\Setting\AttachmentSpecific', 'id', 'attachment_type_id');
    }   

    public function Intface()
    {
        return $this->hasOne('App\Models\Setting\Intface', 'id', 'interface_type_id');
    }    
}
