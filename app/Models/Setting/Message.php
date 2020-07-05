<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $primarykey = 'id_sequent';
    protected $fillable = ['id_sequent','id', 'messages_na', 'messages_fo', 'messages_title_na','messages_title_fo','messages_type'];
    public $timestamps = false;


    public function getIdAttribute($value)
    {
        return $value;
    }
}
