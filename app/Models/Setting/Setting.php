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
    protected $fillable = ['id', 'organization_name', 'organization_logo','header_portrait',
                           'header_landscape','organization_mobile','organization_tel','organization_fax',
                           'organization_email','run_time_recording','project_objective_based_on'];

    public $timestamps = true;

    public  static function headerPortrait(){
       return Setting::find(1)->header_portrait;
    }
    public  static function headerLandscape(){
        return Setting::find(1)->header_landscape;
    }
    public  static function organization_name(){
        return Setting::find(1)->organization_name;
    }
    public  static function organization_logo(){
        return Setting::find(1)->organization_logo;
    }
    public  static function runTimeRecording(){
        return Setting::find(1)->run_time_recording;
    }
}