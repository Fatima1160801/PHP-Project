<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 12/15/2018
 * Time: 12:19 PM
 */

namespace App\Models\Setting;


use Illuminate\Database\Eloquent\Model;
use App\Models\Setting\CustomFieldSelectOption;

class CustomField extends Model
{
    protected $table = 'custom_fields';
    protected $primaryKey = 'id';
    protected $fillable = ['id','table_name','primary_id','screen_id','field_type',
        'field_name', 'field_label_name_na','field_label_name_fo'
    ];

    public $timestamps = false;

    public function customFieldOptions()
    {
        return $this->hasMany(CustomFieldSelectOption::class,'custom_field_id','id');
    }

}