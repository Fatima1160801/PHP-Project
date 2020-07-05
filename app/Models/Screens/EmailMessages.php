<?php
namespace App\Models\Screens;


use Illuminate\Database\Eloquent\Model;
use App\Models\Setting\CustomField;

class EmailMessages extends Model
{
    protected $table = 'email_messages';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'message_send_flag',
        'email_subject',
        'email_text',
        'follower_email',
        'created_at',
        'created_by',
    ];


}