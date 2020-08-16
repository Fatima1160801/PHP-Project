<?php


namespace App\Models\Setting;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interface_AttachmentVW extends Model
{
    use SoftDeletes;

    protected $table = 'interface_attachment_view';
    protected $primarykey = 'id';

}
