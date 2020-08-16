<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 12/5/2018
 * Time: 9:35 AM
 */

namespace App\Models\Setting;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
  protected $table = 'setting';
  protected $primarykey = 'id';
  protected $fillable = ['id', 'organization_name', 'organization_logo', 'header_portrait',
      'header_landscape', 'organization_mobile', 'organization_tel', 'organization_fax',
      'organization_email', 'run_time_recording', 'project_objective_based_on'];

  public $timestamps = true;

  public static function headerPortrait()
  {
    return Setting::first()->header_portrait;
  }

  public static function headerLandscape()
  {
    return Setting::first()->header_landscape;
  }

  public static function organization_name()
  {
    return Setting::first()->organization_name;
  }

  public static function organization_logo()
  {
    return Setting::first()->organization_logo;
  }

  public static function runTimeRecording()
  {
    return Setting::first()->run_time_recording;
  }

  public static function onProgram()
  {
    $status = Setting::first()->project_objective_based_on;
    /*
     * 0  stratigic
 1 program
    */
    if ($status == 0) {
      return false;
    } else {
      return true;
    }
  }


}