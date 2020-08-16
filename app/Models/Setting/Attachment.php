<?php

namespace App\Models\Setting;

use App\Models\Setting\C\AttachmentTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use SoftDeletes;

    protected $table = 'system_attachments';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'activity_type',
        'attachment_type_id',
        'file_path',
        'file_type',
        'file_desc',
        'file_title',
        'primary_id'
    ];

    public $timestamps = true;

    public function attachmentType(){
        return $this->belongsTo(AttachmentTypes::class ,'attachment_type_id','id');
    }

    public function activityType(){
        return $this->belongsTo(AttachmentTypes::class ,'attachment_type_id','id');
    }
}
