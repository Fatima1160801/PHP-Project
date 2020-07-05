<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    protected $table = 'user_statuses';
    protected $primarykey = 'user_status_id';
    public $timestamps = false;
    protected $fillable = ['user_status_id', 'user_status_na', 'user_status_fo', 'is_hidden'];

}
