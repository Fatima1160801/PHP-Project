<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 9/30/2018
 * Time: 11:53 AM
 */

namespace App\Models\Report;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ReportMasterUser extends Model
{
    protected $table = 'global_report_master_users';
    protected $fillable = [
        'user_id',
        'rep_master_id',
        'rep_label', 'rep_orientation'
        ,'rep_ltr',
        'margin_top',
        'margin_left'
    ];

    /*protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('user_id', '=', $this->getAttribute('user_id'))
            ->where('rep_master_id', '=', $this->getAttribute('rep_master_id'));
        return $query;
    }*/
}