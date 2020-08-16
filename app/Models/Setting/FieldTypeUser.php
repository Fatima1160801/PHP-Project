<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 12/15/2018
 * Time: 11:27 AM
 */

namespace App\Models\Setting;


use Illuminate\Database\Eloquent\Model;

class FieldTypeUser extends Model
{
    protected $table = 'field_types_user';
    protected $primaryKey = 'id';
    protected $fillable = ['id','field_type_name', 'html_type', 'field_type_name_user_na','field_type_name_user_fo'];

    public $timestamps = false;
}