<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Screen extends Model
{
    protected $table = 'screens';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'screen_name_na', 'screen_name_fo', 'module_id'];


    public function module()
    {
        return $this->belongsTo('App\Models\Permission\Modules','module_id');
    }

    public function screen_commands(){
        return $this->hasMany('App\Models\Permission\ScreenCommand','screen_id','id');
    }

    public static function getNameByUserLang($screen_id){
        $lang_id = Auth::user()->lang_id;
        $screen = Screen::find($screen_id);
        if($lang_id == 1){
            return $screen->screen_name_na;
        }elseif($lang_id == 2){
            return $screen->screen_name_fo;
        }
    }


}
