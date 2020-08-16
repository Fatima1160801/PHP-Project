<?php


namespace App\Models\Setting\C;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttachmentTypes extends Model
{
    use SoftDeletes;

    protected $table = 'c_attachment_specific';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'attachment_type_na',
        'attachment_type_fo',
    ];

    public $timestamps = true;
}