<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 9/30/2018
 * Time: 11:54 AM
 */

namespace App\Models\Report;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ReportDetailUser extends Model
{
    protected $table = 'global_report_detail_users';
    protected $primaryKey = 'rep_detail_id';
    protected $fillable = ['user_id','rep_master_id', 'rep_detail_id', 'column_label'
        ,'column_order','column_width','column_aggregation','column_alignment'
    ];

    public $timestamps = true;
}