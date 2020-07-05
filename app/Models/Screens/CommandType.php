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

class CommandType extends Model
{
    protected $table = 'screen_command_types';
    protected $primaryKey = 'id';
    public $timestamps = false;
}