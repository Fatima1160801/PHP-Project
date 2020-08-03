<?php

namespace App\Models\Procurement;

use App\Models\Permission\UserDataPermission;
use App\Models\Permission\UserDataPermissionModule;
use App\Models\Project\ProjectResultObjective;
use App\Models\Project\ProjectSpecificObjective;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Plan_Items extends Model
{

   use SoftDeletes;

    protected $table = 'proc_plan_items';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'id',
            'plan_id',

            'item',
            'sector_id',
            'service_type_id',
            'item_group_id',
            'budget',
            'currency_id',
            'start_date',
            'delivery_date',
            'purchase_method_id',
            'created_by',
            'deleted_by',
            'updated_by',


        ];

    public function sector()
    {

        return $this->belongsTo('App\Models\Procurement\Sector','sector_id');
    }
    public function service()
    {

        return $this->belongsTo('App\Models\Procurement\Service','service_type_id','id');
    }
    public function itemgroup()
    {

        return $this->belongsTo('App\Models\Procurement\ItemGroups','item_group_id','id');
    }
    public function purchase()
    {

        return $this->belongsTo('App\Models\Procurement\Purchase','purchase_method_id','id');
    }
}
