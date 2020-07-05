<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $table = 'labels';
    protected $primarykey = 'id';
    protected $fillable = ['id', 'screen_id', 'language_id', 'table_name','db_field_name',
        'field_name', 'label', 'is_required', 'min_value','max_value',
        'field_type_id', 'is_hide', 'is_display', 'is_separated','is_related',
        'related_table', 'related_key', 'related_value','order_no'
    ];
    public $timestamps = false;


}
