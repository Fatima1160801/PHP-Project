<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 11/25/2018
 * Time: 9:47 AM
 */

namespace App\Models\Setting;


use Illuminate\Database\Eloquent\Model;

class DashboardBlock extends Model
{
    protected $table = 'dash_blocks';
    protected $primarykey = 'id';
    protected $fillable = ['id', 'block_name'];
}