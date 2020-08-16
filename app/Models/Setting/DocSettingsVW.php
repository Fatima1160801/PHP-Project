<?php

namespace App\Models\Setting;

use App\Models\Setting\C\AttachmentTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocSettingsVW extends Model
{
    protected $table = 'doc_settings_vw';
    protected $primarykey = 'id';

}
