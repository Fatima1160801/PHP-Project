<?php
/**
 * Created by PhpStorm.
 * User: wasim safi
 * Date: 06/09/2020
 * Time: 11:29 AM
 */

namespace App\Models\Screens;


use Illuminate\Database\Eloquent\Model;
use App\Models\Setting\CustomField;

class EmailNotificationSettings extends Model
{
    protected $table = 'email_notification_settings';
    protected $primaryKey = ['screen_id','command_id'];
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'screen_id',
        'command_id',
        'screen_command_type_id',
        'apply_notification_flag',
        'apply_email_message_flag',
        'notification_text',
        'email_subject',
        'email_text',
        'is_hidden',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by ',
        ];


}