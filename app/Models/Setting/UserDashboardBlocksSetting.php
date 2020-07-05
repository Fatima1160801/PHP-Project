<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 11/25/2018
 * Time: 9:33 AM
 */

namespace App\Models\Setting;


use Illuminate\Database\Eloquent\Model;

class UserDashboardBlocksSetting extends Model
{
    protected $table = 'admin_dash_settings';
    protected $primarykey = 'id';
    protected $fillable = ['id', 'user_id', 'block_id'];

    public $timestamps = false;
}