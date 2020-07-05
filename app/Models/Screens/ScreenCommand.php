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

class ScreenCommand extends Model
{
    protected $table = 'screen_commands';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function commandType()
    {
        return $this->belongsTo(CommandType::class,'screen_command_type_id','id');
    }
}