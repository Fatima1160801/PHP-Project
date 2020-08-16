<?php


namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class VisitType extends Model
{
  protected $table = 'c_visit_type';
  protected $primarykey = 'id';
  protected $fillable = [
      'id',
      'visit_name_na',
      'visit_name_fo',
      'is_hidden',
  ];

 }