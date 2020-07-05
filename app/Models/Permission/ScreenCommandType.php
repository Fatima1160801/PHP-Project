<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;

class ScreenCommandType extends Model
{
    protected $table = 'screen_command_types';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'command_na', 'command_fo'];
    public $timestamps = false;


}
