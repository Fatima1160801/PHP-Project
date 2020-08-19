<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposal extends Model
{
     use SoftDeletes;
    protected $primaryKey = ['id'];
    public $incrementing = false;
    protected $fillable =
        [
            'id',
            'subject_na'
            , 'subject_fo',
            'description_na',
'description_fo'
, 'budget_value',
            'c_currency_id'
            , 'deadline',
            'expected_funder_feedback_dt'
            , 'team_leader_id'
            , 'contact_person_id'
            , 'proposal_status_id'
            , 'opportunity_id'
            , 'concept_id'
            , 'project_id'
            , 'is_hidden'
            , 'full_desc'
            , 'funder_contribution'
            , 'created_by', 'updated_by', 'confirmed_by',
            'confirmed_note', 'accepted_by', 'rejected_by', 'deleted_by'

        ];

}