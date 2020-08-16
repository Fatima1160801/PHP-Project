<?php


namespace App\Models\Setting;

 use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterfaceAttachmentFixedVW extends Model
{
    use SoftDeletes;

    protected $table = 'interface_attachment_fixed_vw';
    protected $primarykey = 'id';

}
