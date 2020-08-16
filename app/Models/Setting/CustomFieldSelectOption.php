<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 12/15/2018
 * Time: 11:29 AM
 */

namespace App\Models\Setting;


use Illuminate\Database\Eloquent\Model;
use App\Models\Setting\CustomField;

class CustomFieldSelectOption extends Model
{
    protected $table = 'custom_fields_select_options';
    protected $primaryKey = 'id';
    protected $fillable = ['id','custom_field_id', 'option_name_na', 'option_name_fo','option_value'];

    public $timestamps = false;

    public function customField()
    {
        return $this->belongsTo(CustomField::class,'custom_field_id','id');
    }
}