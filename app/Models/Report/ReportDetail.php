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

class ReportDetail extends Model
{
    protected $table = 'global_report_details';
    protected $primaryKey = 'rep_detail_id';
    protected $fillable = ['rep_master_id','rep_detail_id', 'column_name', 'column_data_type'
        ,'column_label','column_order','column_width','column_aggregation','column_alignment','is_deleted'
    ];
}