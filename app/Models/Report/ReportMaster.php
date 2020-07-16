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

class ReportMaster extends Model
{
    protected $table = 'global_report_masters';
    protected $primaryKey = 'id';
    protected $fillable = ['id','rep_name', 'rep_source', 'rep_label'
        ,'rep_orientation','rep_ltr','margin_top','margin_left'
    ];
}