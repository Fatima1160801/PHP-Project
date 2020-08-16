<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 12/1/2018
 * Time: 5:06 PM
 */

namespace App\Models\Setting;


use App\Models\Goals\IndicatorsMeasureUnit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttachmentTypeMetrics extends Model
{
use  SoftDeletes;
  protected $table = 'c_achivement_type_metrics';
  protected $primarykey = 'id';
  protected $fillable = [
      'id',
      'c_achivement_type_id',
      'ach_type_metric_no',
      'ach_type_metric_fo',
      'measure_unit_id',
      'is_hidden',
  ];

  public function unit()
  {
    return $this->belongsTo(IndicatorsMeasureUnit::Class, 'measure_unit_id', 'id');
  }


  public static function attachmentTypeMetric($achievement_type_id){
    $AttachmentTypeMetrics =  AttachmentTypeMetrics::where('c_achivement_type_id',$achievement_type_id)
        ->whereNull('deleted_at')
         ->get();
    return $AttachmentTypeMetrics;


  }
}