<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 11/4/2018
 * Time: 8:50 AM
 */
use Ixudra\Curl\Facades\Curl;

function apiUrl($url){
    return "http://fprojects.ps/APIV2/public/".$url;
}
function localization(){

    if ( \Auth::user()->lang_id == 1 ) {

        \App::setLocale('en');

    } else {
        \App::setLocale('ar');
    }
}
function logTblHover($trans_type)
{
    if ($trans_type == 1) {
        return '';
    } else if ($trans_type == 2) {
        return '';
    } else if ($trans_type == 3) {
        return '';
    }
}

function logTblType($trans_type)
{
    if ($trans_type == 1) {
        return '<span class="badge badge-success">Add</span>';
    } else if ($trans_type == 2) {
        return '<span class="badge badge-info">Update</span>';
    } else if ($trans_type == 3) {
        return '<span class="badge badge-danger">Delete</span>';
    }
}

function agendaType($agenda_type)
{
    if ($agenda_type == 0) {
        return Auth::user()->lang_id == 1 ? 'Normal' : 'عادي';
    } else if ($agenda_type == 1) {
        return Auth::user()->lang_id == 1 ? 'Meeting' : 'مقابلة';
    } else if ($agenda_type == 2) {
        return Auth::user()->lang_id == 1 ? 'Event' : 'موعد او حدث';
    }
}


function agendaStatus($agenda_status)
{
    if ($agenda_status == 1) {
        return Auth::user()->lang_id == 1 ? '<span class="badge badge-primary">To Do</span>' : '<span class="badge badge-primary">بدها تنعمل</span>';
    } else if ($agenda_status == 2) {
        return Auth::user()->lang_id == 1 ? '<span class="badge badge-info">In Progress</span>' : '<span class="badge badge-info">قيد العمل</span>';
    } else if ($agenda_status == 3) {
        return Auth::user()->lang_id == 1 ? '<span class="badge badge-success">Done</span>' : '<span class="badge badge-success">مكتملة</span>';
    }
}

function agendaStatusDashboard($agenda_status)
{
    if ($agenda_status == 1) {
        return Auth::user()->lang_id == 1 ? '<span class="badge badge-primary">To Do</span>' : '<span class="badge badge-primary">بدها تنعمل</span>';
    } else if ($agenda_status == 2) {
        return Auth::user()->lang_id == 1 ? '<span class="badge badge-info">In Progress</span>' : '<span class="badge badge-info">قيد العمل</span>';
    } else if ($agenda_status == 3) {
        return Auth::user()->lang_id == 1 ? '<span class="badge badge-success">Done</span>' : '<span class="badge badge-success">مكتملة</span>';
    }
}


function agendaStatus_($agenda_status)
{
    if ($agenda_status == 1) {
        return "rose";
    } else if ($agenda_status == 2) {
        return "blue";
    } else if ($agenda_status == 3) {
        return "green";
    }
}

function agendaPriority($agenda_priority)
{
    if (Auth::user()->lang_id == 1) {
        if ($agenda_priority == 1) {
            return '<span class="badge badge-secondary">None</span>';
        } else if ($agenda_priority == 2) {
            return '<span class="badge badge-primary">low</span>';
        } else if ($agenda_priority == 3) {
            return '<span class="badge badge-warning">medium</span>';
        } else if ($agenda_priority == 4) {
            return '<span class="badge badge-danger">high</span>';
        }
    } else {
        if ($agenda_priority == 1) {
            return '<span class="badge badge-secondary">لا شيء</span>';
        } else if ($agenda_priority == 2) {
            return '<span class="badge badge-primary">منخفض</span>';
        } else if ($agenda_priority == 3) {
            return '<span class="badge badge-warning">متوسط</span>';
        } else if ($agenda_priority == 4) {
            return '<span class="badge badge-danger">مرتفع</span>';
        }
    }

}

function lang_character()
{
    if (Auth::user()->lang_id == 1) {
        return 'na';
    } else {
        return 'fo';
    }
}

function lang_character1()
{
    if (Auth::user()->lang_id == 1) {
        return 'no';
    } else {
        return 'fo';
    }
}

function statusLabel($status)
{
    if (Auth::user()->lang_id == 1) {
        if ($status == 0) {
            return '<span class="badge badge-success">Open</span>';
        } else if ($status == 1) {
            return '<span class="badge badge-danger">Closed</span>';
        }
    } else {
        if ($status == 0) {
            return '<span class="badge badge-success">فعال</span>';
        } else if ($status == 1) {
            return '<span class="badge badge-danger">مغلق</span>';
        }
    }

}

function activeLabel($status)
{
     if (Auth::user()->lang_id == 1) {
        if ($status == 0) {
            return '<span class="badge badge-success">Active</span>';
        } else if ($status == 1) {
            return '<span class="badge badge-danger">Inactive</span>';
        }
    } else {
        if ($status == 0) {
            return '<span class="badge badge-success">فعال</span>';
        } else if ($status == 1) {
            return '<span class="badge badge-danger">غير فعال</span>';
        }
    }

}


function statusLang($status)
{
    if (Auth::user()->lang_id == 1) {
        if ($status == 0) {
            return ' Active ';
        } else if ($status == 1) {
            return 'Inactive';
        }
    } else {
        if ($status == 0) {
            return 'فعال';
        } else if ($status == 1) {
            return 'غير فعال';
        }
    }

}

function StaffTypeLabel($status)
{


    if (Auth::user()->lang_id == 1) {

        if ($status == 1) {
            return ' Inside the Institution ';
        } else if ($status == 2) {
            return ' Outside the Institution ';
        }
    } else {
        if ($status == 1) {
            return ' داخل المؤسسة ';
        } else if ($status == 2) {
            return 'خارج المؤسسة ';
        }
    }

}

function is_inside_outside($is_inside_outside)
{
    if (Auth::user()->lang_id == 1) {

        if ($is_inside_outside == 0) {
            return ' All';
        } else if ($is_inside_outside == 1) {
            return ' Inside ';
        } else if ($is_inside_outside == 2) {
            return ' Outside ';
        }
    } else {
        if ($is_inside_outside == 0) {
            return ' الكل';
        } else if ($is_inside_outside == 1) {
            return ' داخلي ';
        } else if ($is_inside_outside == 2) {
            return ' خارجي ';
        }
    }

}

function progressBarColor($completion_perc)
{
    $progress_class = '';

    if ($completion_perc > 0 && $completion_perc < 25) {
        $progress_class = 'primary';
    } else if ($completion_perc >= 25 && $completion_perc < 50) {
        $progress_class = 'info';
    } else if ($completion_perc >= 50 && $completion_perc < 75) {
        $progress_class = 'warning';
    } else if ($completion_perc >= 75 && $completion_perc < 100) {
        $progress_class = 'danger';
    } else if ($completion_perc == 100) {
        $progress_class = 'success';
    }

    return $progress_class;
}


function serializeArray($serialize_array)
{
    $serialize_array = json_decode($serialize_array, true);
    $data = [];
    $a = [];

    foreach ($serialize_array as $row) {
        if (isset($data[str_replace('[]', '', $row['name'])])) {
            array_push($a, $row['value']);
            $data[str_replace('[]', '', $row['name'])] = $a;
        } else {
            $data[str_replace('[]', '', $row['name'])] = $row['value'];
        }
    }

    return $data;
}


function attachments_allowed_types()
{
    $attachments_allowed_types = App\Models\Setting\AttachmentType::all()->pluck('attachment_type')->toArray();
     return $attachments_allowed_types;
}


function attachment_size($attachment_type)
{
    $attachments_allowed_types = App\Models\Setting\AttachmentType::all()->toArray();

    foreach ($attachments_allowed_types as $attach_type) {
        if ($attach_type['attachment_type'] == $attachment_type) {
            return $attach_type['attach_max_size'];
        }
    }
}


function customField($field, $fields_values)
{
    $field_html = '';
    $field_label = Auth::user()->lang_id == 1 ? $field->field_label_name_na : $field->field_label_name_fo;
    switch ($field->field_type) {
        case 1: // number
            $field_html .= '<div class="col-md-6">';
            $field_html .= '     <div class="row">';
            $field_html .= '         <label for="' . $field->field_name . '" class="col-md-4 col-form-label">' . $field_label . '</label>';
            $field_html .= '         <div class="col-md-8">';
            $field_html .= '             <div class="form-group has-default bmd-form-group">';
            $field_html .= '                 <input type="number" min=0 value="' . ($fields_values[$field->field_name] ?? "") . '" class="form-control" name="' . $field->field_name . '" id="' . $field->field_name . '" alt="">';
            $field_html .= '                 <input type="hidden" value="1" name="' . $field->field_name . '_type" id="' . $field->field_name . '_type" alt="">';
            $field_html .= '             </div>';
            $field_html .= '         </div>';
            $field_html .= '     </div>';
            $field_html .= '</div>';
            break;
        case 2: // text
            $field_html .= '<div class="col-md-6">';
            $field_html .= '     <div class="row">';
            $field_html .= '         <label for="' . $field->field_name . '" class="col-md-4 col-form-label">' . $field_label . '</label>';
            $field_html .= '         <div class="col-md-8">';
            $field_html .= '             <div class="form-group has-default bmd-form-group">';
            $field_html .= '                 <input type="text" value="' . ($fields_values[$field->field_name] ?? "") . '" class="form-control" name="' . $field->field_name . '" id="' . $field->field_name . '" alt="">';
            $field_html .= '                 <input type="hidden" value="2" name="' . $field->field_name . '_type" id="' . $field->field_name . '_type" alt="">';
            $field_html .= '             </div>';
            $field_html .= '         </div>';
            $field_html .= '     </div>';
            $field_html .= '</div>';
            break;
        case 3: // textarea
            $field_html .= '<div class="col-md-6">';
            $field_html .= '     <div class="row">';
            $field_html .= '         <label for="' . $field->field_name . '" class="col-md-4 col-form-label">' . $field_label . '</label>';
            $field_html .= '         <div class="col-md-8">';
            $field_html .= '             <div class="form-group has-default bmd-form-group">';
            $field_html .= '                 <textarea class="form-control" rows="4" name="' . $field->field_name . '" id="' . $field->field_name . '" alt="">' . ($fields_values[$field->field_name] ?? "") . '</textarea>';
            $field_html .= '                 <input type="hidden" value="3" name="' . $field->field_name . '_type" id="' . $field->field_name . '_type" alt="">';
            $field_html .= '             </div>';
            $field_html .= '         </div>';
            $field_html .= '     </div>';
            $field_html .= '</div>';
            break;
        case 4: // date
            $field_html .= '<div class="col-md-6">';
            $field_html .= '     <div class="row">';
            $field_html .= '         <label for="' . $field->field_name . '" class="col-md-4 col-form-label">' . $field_label . '</label>';
            $field_html .= '         <div class="col-md-8">';
            $field_html .= '             <div class="form-group has-default bmd-form-group">';
            $field_html .= '                 <input type="text" value="' . ($fields_values[$field->field_name] ?? "") . '" class="form-control datetimepicker" name="' . $field->field_name . '" id="' . $field->field_name . '" alt="" autocomplete="off">';
            $field_html .= '                 <input type="hidden" value="4" name="' . $field->field_name . '_type" id="' . $field->field_name . '_type" alt="">';
            $field_html .= '             </div>';
            $field_html .= '         </div>';
            $field_html .= '     </div>';
            $field_html .= '</div>';
            break;
        case 5: // select
            $field_html .= '<div class="col-md-6">';
            $field_html .= '     <div class="row">';
            $field_html .= '         <label for="' . $field->field_name . '" class="col-md-4 col-form-label">' . $field_label . '</label>';
            $field_html .= '         <div class="col-md-8">';
            $field_html .= '             <div class="form-group has-default bmd-form-group">';
            $field_html .= '                 <select class="form-control selectpicker" name="' . $field->field_name . '" id="' . $field->field_name . '" data-style="btn btn-link">';
            $field_html .= '                         <option style="height: 37px;" value></option>';
            if ($field->customFieldOptions()->count() > 0) {
                foreach ($field->customFieldOptions as $customFieldOption) {
                    $field_html .= '<option value="' . $customFieldOption->option_value . '" ' . (!empty($fields_values[$field->field_name]) && is_array($fields_values[$field->field_name]) && in_array($customFieldOption->option_value, $fields_values[$field->field_name]) ? "selected" : "") . '>' . (Auth::user()->lang_id == 1 ? $customFieldOption->option_name_na : $customFieldOption->option_name_fo) . '</option>';
                }
            }
            $field_html .= '                 </select>';
            $field_html .= '                 <input type="hidden" value="5" name="' . $field->field_name . '_type" id="' . $field->field_name . '_type" alt="">';
            $field_html .= '             </div>';
            $field_html .= '         </div>';
            $field_html .= '     </div>';
            $field_html .= '</div>';
            break;
        case 6: // multi select
            $field_html .= '<div class="col-md-6">';
            $field_html .= '     <div class="row">';
            $field_html .= '         <label for="' . $field->field_name . '" class="col-md-4 col-form-label">' . $field_label . '</label>';
            $field_html .= '         <div class="col-md-8">';
            $field_html .= '             <div class="form-group has-default bmd-form-group">';
            $field_html .= '                 <select multiple class="form-control selectpicker" name="' . $field->field_name . '[]" id="' . $field->field_name . '" data-style="btn btn-link">';
            $field_html .= '                         <option style="height: 37px;" value></option>';
            if ($field->customFieldOptions()->count() > 0) {
                foreach ($field->customFieldOptions as $customFieldOption) {
                    $field_html .= '<option value="' . $customFieldOption->option_value . '" ' . (!empty($fields_values[$field->field_name]) && is_array($fields_values[$field->field_name]) && in_array($customFieldOption->option_value, $fields_values[$field->field_name]) ? "selected" : "") . '>' . (Auth::user()->lang_id == 1 ? $customFieldOption->option_name_na : $customFieldOption->option_name_fo) . '</option>';
                }
            }
            $field_html .= '                 </select>';
            $field_html .= '                 <input type="hidden" value="6" name="' . $field->field_name . '_type" id="' . $field->field_name . '_type" alt="">';
            $field_html .= '             </div>';
            $field_html .= '         </div>';
            $field_html .= '     </div>';
            $field_html .= '</div>';
            break;
        case 7: // radio
            $field_html .= '<div class="col-md-6">';
            $field_html .= '<div class="row">';
            $field_html .= '<label class="col-md-4 col-form-label" for="gender">' . $field_label . '</label>';
            $field_html .= '<div class="col-md-8">';
            $field_html .= '<div class="form-group has-default bmd-form-group">';
            if ($field->customFieldOptions()->count() > 0) {
                foreach ($field->customFieldOptions as $customFieldOption) {
                    $field_html .= '<div class="form-check form-check-radio form-check-inline">';
                    $field_html .= '<label class="form-check-label"><input ' . (!empty($fields_values[$field->field_name]) && $fields_values[$field->field_name] == $customFieldOption->option_value ? "checked" : "") . ' class="form-check-input" id="" maxlength="10" name="' . $field->field_name . '" type="radio" value="' . $customFieldOption->option_value . '">' . (Auth::user()->lang_id == 1 ? $customFieldOption->option_name_na : $customFieldOption->option_name_fo) . ' <span class="circle"><span class="check"></span></span></label>';
                    $field_html .= '</div>';
                }
            }
            $field_html .= '</div>';
            $field_html .= '                          <input type="hidden" value="7" name="' . $field->field_name . '_type" id="' . $field->field_name . '_type" alt="">';
            $field_html .= '</div>';
            $field_html .= '</div>';
            $field_html .= '</div>';
            break;
        case 8: // checkbox
            $field_html .= '<div class="col-md-6">';
            $field_html .= '<div class="row">';
            $field_html .= '<label class="col-md-4 col-form-label" for="gender">' . $field_label . '</label>';
            $field_html .= '<div class="col-md-8">';
            $field_html .= '<div class="form-group has-default bmd-form-group">';
            if ($field->customFieldOptions()->count() > 0) {
                foreach ($field->customFieldOptions as $customFieldOption) {
                    $field_html .= '<div class="form-check form-check-inline">';
                    $field_html .= '<label class="form-check-label"><input ' . (!empty($fields_values[$field->field_name]) && is_array($fields_values[$field->field_name]) && in_array($customFieldOption->option_value, $fields_values[$field->field_name]) ? "checked" : "") . ' class="form-check-input" id="" maxlength="10" name="' . $field->field_name . '[]" type="checkbox" value="' . $customFieldOption->option_value . '">' . (Auth::user()->lang_id == 1 ? $customFieldOption->option_name_na : $customFieldOption->option_name_fo) . ' <span class="form-check-sign"><span class="check"></span></span></label>';
                    $field_html .= '</div>';
                }
            }
            $field_html .= '</div>';
            $field_html .= '                          <input type="hidden" value="8" name="' . $field->field_name . '_type" id="' . $field->field_name . '_type" alt="">';
            $field_html .= '</div>';
            $field_html .= '</div>';
            $field_html .= '</div>';
            break;
        case 9: // email
            $field_html .= '<div class="col-md-6">';
            $field_html .= '     <div class="row">';
            $field_html .= '         <label for="' . $field->field_name . '" class="col-md-4 col-form-label">' . $field_label . '</label>';
            $field_html .= '         <div class="col-md-8">';
            $field_html .= '             <div class="form-group has-default bmd-form-group">';
            $field_html .= '                 <input type="email" value="' . ($fields_values[$field->field_name] ?? "") . '" class="form-control" name="' . $field->field_name . '" id="' . $field->field_name . '" alt="">';
            $field_html .= '                 <input type="hidden" value="9" name="' . $field->field_name . '_type" id="' . $field->field_name . '_type" alt="">';
            $field_html .= '             </div>';
            $field_html .= '         </div>';
            $field_html .= '     </div>';
            $field_html .= '</div>';
            break;
        case 10: // file
            $field_html .= '<div class="col-md-6">';
            $field_html .= '     <div class="row">';
            $field_html .= '         <label for="' . $field->field_name . '" class="col-md-4 col-form-label">' . $field_label . '</label>';
            $field_html .= '         <div class="col-md-8">';
            $field_html .= '             <div class="form-group has-default bmd-form-group">';
            $field_html .= '                 <input type="file" class="form-control" name="' . $field->field_name . '" id="' . $field->field_name . '" alt="">';
            $field_html .= '                 <input type="hidden" value="10" name="' . $field->field_name . '_type" id="' . $field->field_name . '_type" alt="">';
            $field_html .= '             </div>';
            $field_html .= '         </div>';
            $field_html .= '     </div>';
            $field_html .= '</div>';
            break;
    }

    return $field_html;
}


function time_elapsed_string($ptime)
{
    date_default_timezone_set("Asia/Gaza");
    $ptime1 = strtotime($ptime);
    $etime = time() - $ptime1;

    if ($etime < 1) {
        return 'minute';
    }

    $a = [
        365 * 24 * 60 * 60 => 'year',
        30 * 24 * 60 * 60 => 'month',
        24 * 60 * 60 => 'day',
        60 * 60 => 'hour',
        60 => 'minute',
        1 => 'second'
    ];

    $a_plural = [
        'year' => 'years',
        'month' => 'months',
        'day' => 'days',
        'hour' => 'hours',
        'minute' => 'mins',
        'second' => 'sec'
    ];

    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $a_plural[$str]) . ' ago';
        }
    }
}

function p_url($spec){
    return url('public/attach/').$spec;
}

    function statusBar($status_id){
//    return true;
//        $status_text ="";
//        $status_name=\App\Models\Opportunity\OpportunityStatus::where('id',$status_id)->first();
//        if(!empty($status_name)){
//            $status_text=$status_name->{'opportunity_status_'.lang_character()}  ;
//        }
//        if($status_id==1){
//            $color="#FF9800";
//        }elseif($status_id==2){
//            $color="#009688";
//        }else{
//            $color="#F44336";
//        }
//         $field_name = Auth::user()->lang_id == 1 ? Auth::user()->user_full_name : "";
//         $field_html = '';
//         $at= Carbon\Carbon::now();
//         $field_html .=  '<h6 style="text-transform: capitalize;font-weight: bold;" class="pull-left mr-5">Status : <span style="text-transform: capitalize;font-weight:normal;color:'.$color.';" id="title-app-rej">'.$status_text.'</span></h6>';
//        // $field_html .= '<h6 style="text-transform: capitalize;font-weight: bold;" class="pull-left mr-5">By : <span id="title-app-rej-by" style="text-transform: capitalize;font-weight: normal;color:'.$color.';">'.$field_name.'</span></h6>';
//        // $field_html .= '<h6 style="text-transform: capitalize;font-weight: bold;" class="pull-left mr-5">Date : <span id="title-app-rej-date" style="text-transform: capitalize;font-weight: normal;color:'.$color.';">'.$at.'</span></h6>';
//        // $field_html .= '<h6 style="text-transform: capitalize;font-weight: bold;" class="pull-right mr-5">Created By : <span id="title-create-by" style="text-transform: capitalize;font-weight: normal;">'.$field_name.'</span></h6>';
//         //$field_html .= '<div class="clearfix"></div>';
//        return $field_html;
    }

    function api_call($url,$type="GET"){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL =>$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $type,
            // CURLOPT_HTTPHEADER => array(
            //     'Content-Type: application/json',
            // ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $online_res = json_decode($response);
        return $online_res;
    }

    function connectToApi($url,$method="GET",$body)
    {
        try {
            $options = [
                'http_errors' => false,
                'force_ip_resolve' => 'v4',
                'connect_timeout' => 10,
                'read_timeout' => 10,
                'timeout' => 10,
                'verify' => false
            ];
            $client = new \GuzzleHttp\Client($options);
            if($method=="GET"){
                $response = $client->get($url, [
                    'headers' => ['Accept' => '*/*', 'User-Agent' => null],
                    'allow_redirects' => false,
                    'timeout' => 500
                ]);
            }else{
                $response = $client->post($url, [
                    'headers' => ['Accept' => '*/*', 'User-Agent' => null],
                    'allow_redirects' => false,
                    'timeout' => 500,
                    'body' => $body
                ]);
            }


            return json_decode($response->getBody());
        } catch (Exception $ex) {
            \Log::error($ex);
            return null;
        }
    }
        //primary id =opp_id,concept_id,proposal_id //interface id ,opp,concept,proposal
        function storeNotifiEmailMessage($screen_id,$command_type,$command_id,$primary_id,$interface_id){
            $setting_email_subject="";
            $setting_email_text="";
           // dd($screen_id,$command_type,$command_id);
           $check= \App\Models\Screens\EmailNotificationSettings::where('screen_id',$screen_id)->where('command_id',$command_id)->where("screen_command_type_id",$command_type)->first();
           if(!empty($check)) {
               if ($check->apply_email_message_flag == 1) {

                   if (!empty($check)) {
                       $setting_email_subject = $check->email_subject ?? "";
                       $setting_email_text = $check->email_text ?? "";
                   } else {

                   }

                   $appended_subject = "";
                   $appended_text = "";
                   $follower_email = [];
                   if ($interface_id == 10) {
                       $follower_email = \App\Models\Opportunity\opportunity_to_followers::where("opportunity_id", $primary_id)->where("is_hidden", 0)->pluck("follower_email")->toArray();
                       /////////////////////////////////////////////////////////////////////////////////////////////////

                       $contact_leader = \App\Models\Opportunity\Opportunity::where('id', $primary_id)->first(["contact_person_id", 'team_leader_id']);
                       if (!empty($contact_leader)) {
                           $in_opp = [];
                           if (!empty($contact_leader->contact_person_id)) {
                               $in_opp[] = $contact_leader->contact_person_id;
                           }
                           if (!empty($contact_leader->team_leader_id)) {
                               $in_opp[] = $contact_leader->team_leader_id;
                           }
                       }
                       /**********************************************/
                       $team_members = \App\Models\Opportunity\opportunity_team::where('opportunity_id', $primary_id)->pluck("staff_id")->toArray();
                       $opp_list1 = [];
                       $opp_list3 = [];
                       if (!empty($team_members)) {
                           $opp_list1 = $team_members;
                       }
                       $opp_list2 = array_unique(array_merge($in_opp, $opp_list1));
                       if (sizeof($opp_list2) > 0) {
                           $opp_list3 = \App\Models\Staff\Staff::whereIn('id', $opp_list2)->where("email", "!=", null)->pluck("email")->toArray();
                       }
                       //var_dump($follower_email);
                       $follower_email = array_unique(array_merge($follower_email, $opp_list3));
                       //dd($follower_email);
                       /////////////////////////////////////////////////////////////////////////////////////////////////
                       $show_url=route("opportunity.opportunity.edit",$primary_id);
                       $appended_subject = $setting_email_subject . "";
                       $appended_text = \Auth::user()->user_full_name." made action (".$setting_email_text . ') with number '.$primary_id."<br><p>For more Information, click on the following link:</p><a  href='".$show_url."'>show</a>";
                   } elseif ($interface_id == 11) {//concept
                       $follower_email = \App\Models\Concept\concept_to_followers::where("concept_id", $primary_id)->where("is_hidden", 0)->pluck("follower_email")->toArray();
                       /////////////////////////////////////////////////////////////////////////////////////////////////

                       $contact_leader = \App\Models\Concept\concepts::where('id', $primary_id)->first(["contact_person_id", 'team_leader_id']);
                       if (!empty($contact_leader)) {
                           $in_concept = [];
                           if (!empty($contact_leader->contact_person_id)) {
                               $in_concept[] = $contact_leader->contact_person_id;
                           }
                           if (!empty($contact_leader->team_leader_id)) {
                               $in_concept[] = $contact_leader->team_leader_id;
                           }
                       }
                       /**********************************************/
                       $team_members = \App\Models\Concept\concept_teams::where('concept_id', $primary_id)->pluck("staff_id")->toArray();
                       $concept_list1 = [];
                       $concept_list3 = [];
                       if (!empty($team_members)) {
                           $concept_list1 = $team_members;
                       }
                       $concept_list2 = array_unique(array_merge($in_concept, $concept_list1));
                       if (sizeof($concept_list2) > 0) {
                           $concept_list3 = \App\Models\Staff\Staff::whereIn('id', $concept_list2)->where("email", "!=", null)->pluck("email")->toArray();
                       }
                       //var_dump($follower_email);
                       $follower_email = array_unique(array_merge($follower_email, $concept_list3));
                       //dd($follower_email);
                       /////////////////////////////////////////////////////////////////////////////////////////////////
                       $show_url=route("concept.concept.edit",$primary_id);

                       $appended_subject = $setting_email_subject . "";
                       $appended_text = \Auth::user()->user_full_name." made action (".$setting_email_text . ') with number '.$primary_id."<br><p>For more Information, click on the following link:</p><a  href='".$show_url."'>show</a>";
                   } elseif ($interface_id == 12) {
                       $follower_email = \App\Models\Proposal\proposal_to_followers::where("proposal_id", $primary_id)->where("is_hidden", 0)->pluck("follower_email")->toArray();
                       /////////////////////////////////////////////////////////////////////////////////////////////////

                       $contact_leader = \App\Models\Proposal\proposals::where('id', $primary_id)->first(["contact_person_id", 'team_leader_id']);
                       if (!empty($contact_leader)) {
                           $in_proposal = [];
                           if (!empty($contact_leader->contact_person_id)) {
                               $in_proposal[] = $contact_leader->contact_person_id;
                           }
                           if (!empty($contact_leader->team_leader_id)) {
                               $in_proposal[] = $contact_leader->team_leader_id;
                           }
                       }
                       /**********************************************/
                       $team_members = \App\Models\Proposal\proposal_teams::where('proposal_id', $primary_id)->pluck("staff_id")->toArray();
                       $proposal_list1 = [];
                       $proposal_list3 = [];
                       if (!empty($team_members)) {
                           $proposal_list1 = $team_members;
                       }
                       $proposal_list2 = array_unique(array_merge($in_proposal, $proposal_list1));
                       if (sizeof($proposal_list2) > 0) {
                           $proposal_list3 = \App\Models\Staff\Staff::whereIn('id', $proposal_list2)->where("email", "!=", null)->pluck("email")->toArray();
                       }
                       //var_dump($follower_email);
                       $follower_email = array_unique(array_merge($follower_email, $proposal_list3));
                       //dd($follower_email);
                       /////////////////////////////////////////////////////////////////////////////////////////////////
                       $show_url=route("proposal.proposal.edit",$primary_id);
                       $appended_subject = $setting_email_subject . "";
                       $appended_text = \Auth::user()->user_full_name." made action (".$setting_email_text . ') with number '.$primary_id."<br><p>For more Information, click on the following link:</p><a  href='".$show_url."'>show</a>";
                   } else {

                   }
                   $final_email_subject = $appended_subject;
                   $final_email_text = $appended_text;

                   if (!empty($follower_email) && sizeof($follower_email) > 0) {
                       foreach ($follower_email as $email) {
                           $new = new \App\Models\Screens\EmailMessages();
                           $new->email_subject = $final_email_subject;
                           $new->email_text = $final_email_text;
                           $new->follower_email = $email ?? "";//"wasim.safi@fis.ps";//$email ?? "";
                           $new->created_by = \Auth::user()->id ?? 0;
                           $new->save();
                       }
                   } else {

                   }
                   //////////////call api for scheduale email api after action
                   callsendEmailSchedual();
               }else {

               }
           }else{

           }

               return true;
        }

        function callsendEmailSchedual(){
            try {
            $url= apiUrl("api/send/email/schedule");
                $response = Curl::to($url)
                    ->withHeader('Authorization: Bearer '.\Session::get('apiToken'))
                    ->get();
//            $client = new \GuzzleHttp\Client();
//            $response = $client->get($url, [
//                'headers' => ['Accept' => '*/*', 'User-Agent' => null,"Authorization"=>"Bearer ".\Session::get('apiToken')],
//                'allow_redirects' => false,
//                'timeout' => 500
//            ]);
//$online_res = json_decode($response);
            //dd($response->getBody());
                //return json_decode($online_res);
            } catch (Exception $ex) {
                \Log::error($ex);
               // dd($ex);
               // return false;
            }
            return true;
        }



        function getParentOfNote($note_id,$interface_id){
            if($interface_id==10){
              $data=\App\Models\Opportunity\OpportunityNotes::where("id",$note_id)->first(["opportunity_id"]);
              $id=$data->opportunity_id ?? 0;
            }elseif($interface_id==11){
             $data=\App\Models\Concept\Concept_notes::where("id",$note_id)->first(["concept_id"]);
             $id=$data->concept_id ?? 0;
            }else{
             $data=\App\Models\Proposal\Proposal_notes::where("id",$note_id)->first(["proposal_id"]);
             $id=$data->proposal_id ?? 0;
            }
            return $id;

        }


     function teamMemberCheck($primary_id,$interface_id){
         $staff_in=false;
         $user_owner=0;
         $staff_id=\Auth::user()->staff_id ?? 0;

         if($interface_id==10){
             $follower_ids= \App\Models\Opportunity\opportunity_to_followers::where("opportunity_id", $primary_id)->where("is_hidden", 0)->pluck("user_id")->toArray();
             $staff_ids= \App\Models\Permission\User::whereIn("id", $follower_ids)->pluck("staff_id")->toArray();
             /////////////////////////////////////////////////////////////////////////////////////////////////
             $contact_leader = \App\Models\Opportunity\Opportunity::where('id', $primary_id)->first(["contact_person_id", 'team_leader_id','created_by']);
             $in_opp = [];
             if (!empty($contact_leader)) {
                 if (!empty($contact_leader->contact_person_id)) {
                     $in_opp[] = $contact_leader->contact_person_id;
                 }
                 if (!empty($contact_leader->team_leader_id)) {
                     $in_opp[] = $contact_leader->team_leader_id;
                 }
                 if (!empty($contact_leader->created_by)) {
                     $user_owner = $contact_leader->created_by;
                 }
             }


             /**********************************************/
             $team_members = \App\Models\Opportunity\opportunity_team::where('opportunity_id', $primary_id)->pluck("staff_id")->toArray();
             $opp_list1 = [];
             $opp_list3 = [];
             if (!empty($team_members)) {
                 $opp_list1 = $team_members;
             }
             $opp_list2 = array_unique(array_merge($staff_ids,$in_opp, $opp_list1));
             if (in_array($staff_id, $opp_list2))
             {
                 $staff_in=true;
             }
             //dd($opp_list2);
         }elseif($interface_id==11){
             $follower_ids = \App\Models\Concept\concept_to_followers::where("concept_id", $primary_id)->where("is_hidden", 0)->pluck("user_id")->toArray();
             $staff_ids= \App\Models\Permission\User::whereIn("id", $follower_ids)->pluck("staff_id")->toArray();
             /////////////////////////////////////////////////////////////////////////////////////////////////
             $contact_leader = \App\Models\Concept\concepts::where('id', $primary_id)->first(["contact_person_id", 'team_leader_id','created_by']);
             $in_concept = [];
             if (!empty($contact_leader)) {
                 if (!empty($contact_leader->contact_person_id)) {
                     $in_concept[] = $contact_leader->contact_person_id;
                 }
                 if (!empty($contact_leader->team_leader_id)) {
                     $in_concept[] = $contact_leader->team_leader_id;
                 }
                 if (!empty($contact_leader->created_by)) {
                     $user_owner = $contact_leader->created_by;
                 }
             }
             /**********************************************/
             $team_members = \App\Models\Concept\concept_teams::where('concept_id', $primary_id)->pluck("staff_id")->toArray();
             $concept_list1 = [];
             $concept_list3 = [];
             if (!empty($team_members)) {
                 $concept_list1 = $team_members;
             }
             $concept_list2 = array_unique(array_merge($staff_ids,$in_concept, $concept_list1));
             if (in_array($staff_id, $concept_list2))
             {
                 $staff_in=true;
             }
         }else{
             $follower_ids = \App\Models\Proposal\proposal_to_followers::where("proposal_id", $primary_id)->where("is_hidden", 0)->pluck("user_id")->toArray();
             $staff_ids= \App\Models\Permission\User::whereIn("id", $follower_ids)->pluck("staff_id")->toArray();
             /////////////////////////////////////////////////////////////////////////////////////////////////
             $contact_leader = \App\Models\Proposal\proposals::where('id', $primary_id)->first(["contact_person_id", 'team_leader_id','created_by']);
             $in_proposal = [];
             if (!empty($contact_leader)) {
                 if (!empty($contact_leader->contact_person_id)) {
                     $in_proposal[] = $contact_leader->contact_person_id;
                 }
                 if (!empty($contact_leader->team_leader_id)) {
                     $in_proposal[] = $contact_leader->team_leader_id;
                 }
                 if (!empty($contact_leader->created_by)) {
                     $user_owner = $contact_leader->created_by;
                 }
             }
             /**********************************************/
             $team_members = \App\Models\Proposal\proposal_teams::where('proposal_id', $primary_id)->pluck("staff_id")->toArray();
             $proposal_list1 = [];
             $proposal_list3 = [];
             if (!empty($team_members)) {
                 $proposal_list1 = $team_members;
             }
             $proposal_list2 = array_unique(array_merge($in_proposal, $proposal_list1));
             if (in_array($staff_id, $proposal_list2))
             {
                 $staff_in=true;
             }
         }
         //dd($user_owner);
         if(\ Auth::user()->id == 1){
             $staff_in=true;
         }
         if(\ Auth::user()->id == $user_owner){
             $staff_in=true;
         }

         if (!$staff_in ) {
                 if (request()->ajax()) {
                     abort(409, 'You are not in team members,so you don’t have permissions to view this page Please contact your administration!');
                 } else {
                     abort(401, 'You are not in team members,so you don’t have permissions to view this page Please contact your administration!');
                 }
         }
         //dd($staff_in);
         return $staff_in;
     }


     function loginToApi($email,$password){
         $response = Curl::to(apiUrl('/api/login'))
        // $response = Curl::to('http://localhost/fporjects-api/public/api/login')
             //->withHeader('X-Api-Key: us4ae594fa98adc1ad4801b68b1055c775584cbe00')
                ->withData(array('email' => $email, 'password' => $password))
             ->post();
         $online_res = json_decode($response);
         if(!empty($online_res)){
             if(!empty($online_res->status==true)){
                 if(!empty($online_res->token)){
                     /////save token to session
                       // dd($online_res->token);
                     \Session::put('apiToken', $online_res->token ?? "0");
                    return true;
                 }
             }else{
               return false;
             }
         }else{
             return false;
         }
     }


 