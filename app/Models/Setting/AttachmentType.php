<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 12/1/2018
 * Time: 5:06 PM
 */

namespace App\Models\Setting;


use Illuminate\Database\Eloquent\Model;

class AttachmentType extends Model
{
    protected $table = 'attachment_types';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'attachment_type',
        'attach_max_size'
    ];

}