<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;

class ScreenCommand extends Model
{

    protected $table = 'screen_commands';
    protected $primaryKey = ['screen_id', 'command_id', 'command_type_id'];
    protected $fillable = ['screen_id', 'command_id', 'screen_command_type_id', 'action',
        'controller', 'command_name'];
    public $incrementing = false;
    public $timestamps = false;

    public function screen()
    {
        return $this->belongsTo('App\Models\Permission\Screen', 'screen_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Permission\ScreenCommandType', 'screen_command_type_id');
    }

    public static function checkScreenCommand($screen_id, $command_id, $command_type_id, $action = null, $controller = null)
    {
        $screenCommand = ScreenCommand::
        where('screen_id', $screen_id)
            ->where('id', $command_id)
            ->where('screen_command_type_id', $command_type_id);
        if (!$action == null) {
            $screenCommand->where('action', $action);
        }
        if (!$controller == null) {
            $screenCommand->where('controller', $controller);
        }

        $screenCommand->first();
        if ($screenCommand) {
            return true;
        } else {
            return false;
        }

    }
}
