<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 12/31/2018
 * Time: 1:33 PM
 */

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;


class UserDataPermission extends Model
{
    protected $table = 'user_data_perms';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'user_id', 'module_id', 'perm_type'];

    public $timestamps = false;
}