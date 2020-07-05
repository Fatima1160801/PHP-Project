<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 12/31/2018
 * Time: 1:49 PM
 */

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;


class UserDataPermissionModule extends Model
{
    protected $table = 'user_data_perms_modules';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'user_id', 'module_id', 'primary_id'];
    public $timestamps = false;
}