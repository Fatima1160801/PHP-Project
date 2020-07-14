<?php

/* col_all_Class=> class => bootstrap grid column input&label  */
/* col_label_Class=>class => bootstrap grid column  label  */
/* col_input_Class=>class => bootstrap grid column  input  */
/* inputClass=>send class to input  */
/* attr =>send anther attribute to input*/
/* relatedWhere  add condition to relation query */
/* selectArray  send array to select , multi select , checkbox or radio */
/* SelectedArray   multi select =>selected from array */

if (!function_exists('generator')) {
    function generator($screen_id, $option = null, $data = null)
    {
        $language_id = Auth::user()->lang_id;
        $view = '<div class="row">';

        $labels_all = \App\Models\Setting\Label::where('language_id', $language_id)
            ->where(function ($query) use ($screen_id) {
                $query->where('screen_id', $screen_id)
                    ->orWhere('screen_id', '0');
            })
            ->orderBy('order_no')
            ->get();

        $labels_screen1 = $labels_all->where('screen_id', 0);
        $labels_screen2 = $labels_all->where('html_type', '15')
            ->where('screen_id', $screen_id);
        $labels_screen = $labels_screen1->merge($labels_screen2);
        $labels_screen = $labels_screen->map(function ($label) {
            return $label->only(['db_field_name', 'label']);
        })->toArray();
        //;
        $labels_array = [];
        foreach ($labels_screen as $labels) {
            $labels_array[$labels['db_field_name']] = $labels['label'];
        }


        // ->where('language_id',$language_id);
        $labels = $labels_all->where('screen_id', $screen_id)
            ->where('html_type', '!=', '15');

        foreach ($labels as $label) {
            if (!empty($option)) {
                if (array_key_exists($label->db_field_name, $option)) {
                    foreach ($option[$label->db_field_name] as $key => $value) {
                        $label->$key = $value;
                    }
                }
            }
        }
        $view .= draw($labels, $data);
        $view .= "</div>";
        $array = [$view, $labels_array];
        return $array;
    }
}
if (!function_exists('draw')) {
    function draw($labels = null, $data = null)
    {

        $view = "";
        foreach ($labels as $label) {
            if (empty($label->col_all_Class)) {
                $label->col_all_Class = "col-md-6";
            }
            if (empty($label->col_label_Class)) {
                $label->col_label_Class = "col-md-4";
            }
            if (empty($label->col_input_Class)) {
                $label->col_input_Class = "col-md-8";
            }
            if ($label->html_type != 10 && $label->is_related == 1 && $label->is_hide != 1) {
                $view .= related($label, $data[$label->db_field_name]);
            } elseif ($label->html_type == '1' && $label->is_hide != 1) {
                $view .= inputNumber($label, $data[$label->db_field_name]);
            } elseif ($label->html_type == '2' && $label->is_hide != 1) {
                $view .= inputText($label, $data[$label->db_field_name]);
            } elseif ($label->html_type == '4' && $label->is_hide != 1) {
                $label->inputClass = $label->inputClass . ' datetimepicker';
                $view .= inputDate($label, $data[$label->db_field_name]);
            } elseif ($label->html_type == '3' && $label->is_hide != 1) {
                $view .= inputTextArea($label, $data[$label->db_field_name]);
            } elseif ($label->html_type == '5' && $label->is_hide != 1) {
                $view .= inputSelectDropdown($label, $label->selectArray, $data[$label->db_field_name]);
            } elseif ($label->html_type == '6' && $label->is_hide != 1) {
                $view .= inputMultiSelectDropdown($label, $label->selectArray, $data[$label->db_field_name]);
            } elseif ($label->html_type == '7' && $label->is_hide != 1) {
                $view .= inputRadio($label, $label->selectArray, $data[$label->db_field_name]);
            } elseif ($label->html_type == '8' && $label->is_hide != 1) {
                $view .= inputCheckbox($label, $label->selectArray, $data[$label->db_field_name]);
            } elseif ($label->html_type == '10' && $label->is_hide != 1) {
                $view .= inputHidden($label, $data[$label->db_field_name]);
            } elseif ($label->html_type == '11' && $label->is_hide != 1) {
                $view .= inputPassword($label, $data[$label->db_field_name]);
            } elseif ($label->html_type == '12' && $label->is_hide != 1) {
                $view .= inputEmail($label, $data[$label->db_field_name]);
            } elseif ($label->html_type == '9' && $label->is_hide != 1) {
                //avater
                $view .= inputFile($label, $data[$label->db_field_name]);
            } elseif ($label->html_type == '16' && $label->is_hide != 1) {
                $view .= inputColor($label, $data[$label->db_field_name]);
            } elseif ($label->html_type == '17' && $label->is_hide != 1) {
                $view .= inputURl($label, $data[$label->db_field_name]);
            } elseif ($label->html_type == '14' && $label->is_hide != 1) {
                $view .= inputFile2($label, $data);
            }elseif ($label->html_type == '18' && $label->is_hide != 1) {
                $view .= inputCurrency($label, $data[$label->db_field_name]);
            }
        }
        return $view;
    }
}
if (!function_exists('inputText')) {
    function inputText($label, $data)
    {
        $view = "";
        $attr = inputAttr($label);
        $view = "<div class='" . $label->col_all_Class . "'>";
        $view .= "<div class='row'>";
        if($label->is_required==1){
        $req_star='<span style="color:red;">*</span>';
        }else{
        $req_star="";
        }
        if(!empty($label->label_hint)) {
            $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label . " <a data-toggle='tooltip' title='.$label->label_hint.'><i style='font-size: 16px;' class='fa fa-question-circle'>       </i></a>'.$req_star.'</label> ";
        }else{
            $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label ." ".$req_star. " </label> ";
        }
        $view .= "<div class=' $label->col_input_Class'>";
        $view .= "<div class='form-group has-default bmd-form-group'>";
        $view .= "<input type='text'  value='" . $data . "'  class='form-control  " . $label->inputClass . "'  name='" . $label->field_name . "' id='" . $label->field_name . "'  $label->attr  $attr  alt='" . $label->label . "'   autocomplete='off'   >";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        return $view;
    }
}
if (!function_exists('inputColor')) {
    function inputColor($label, $data)
    {
        if (!isset($data)) {
            $data = "#000000";
        }
        $view = "";
        $attr = inputAttr($label);
        $view = "<div class='" . $label->col_all_Class . "'>";
        $view .= "<div class='row'>";
        $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label . "</label>";
        $view .= "<div class=' $label->col_input_Class'>";
        $view .= "<div class='form-group has-default bmd-form-group'>";
        $view .= "<input type='color'  value='" . $data . "'  class='form-control  " . $label->inputClass . "'  name='" . $label->field_name . "' id='" . $label->field_name . "'  $label->attr  $attr  alt='" . $label->label . "'   >";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        return $view;
    }
}
if (!function_exists('inputDate')) {
    function inputDate($label, $data)
    {

        $dateValue = null;
        if (isset($data) && $data != null) {
            $startTime = strtotime($data);
            $dateValue = date('d-m-Y', $startTime);
        }

        $view = "";
        $attr = inputAttr($label);
        $view = "<div class='" . $label->col_all_Class . "'>";
        if($label->is_required==1){
            $req_star='<span style="color:red;">*</span>';
        }else{
            $req_star="";
        }
        $view .= "<div class='row'>";
        $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label ." ".$req_star. "</label>";
        $view .= "<div class=' $label->col_input_Class'>";
        $view .= "<div class='form-group has-default bmd-form-group'>";
        $view .= "<input type='text'  value='$dateValue'  class='form-control  " . $label->inputClass . "'  name='" . $label->field_name . "' id='" . $label->field_name . "'  $label->attr  $attr  alt='" . $label->label . "'   >";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        return $view;
    }
}
if (!function_exists('inputTextArea')) {


    function inputTextArea($label, $data)
    {
        $view = "";
        $attr = inputAttr($label);
        $view = "<div class='" . $label->col_all_Class . "'>";
        $view .= "<div class='row'>";
        if($label->is_required==1){
            $req_star='<span style="color:red;">*</span>';
        }else{
            $req_star="";
        }

        if(!empty($label->label_hint)) {
            $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label ." ".$req_star. " <a data-toggle='tooltip' title='.$label->label_hint.'><i style='font-size: 16px;' class='fa fa-question-circle'>       </i></a></label> ";
        }else{
            $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label ." ".$req_star. "</label> ";
        }
        $view .= "<div class='$label->col_input_Class'>";
        $view .= "<div class='form-group has-default bmd-form-group'>";
        $view .= "<textarea  class='form-control   " . $label->inputClass . "'  name='" . $label->field_name . "' id='" . $label->field_name . "'  $label->attr  $attr  alt='" . $label->label . "'  >";
        $view .= $data;
        $view .= "</textarea>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        return $view;
    }
}
if (!function_exists('inputNumber')) {
    function inputNumber($label, $data)
    {
        $view = "";
        $attr = inputAttr($label);
        $view = "<div class='" . $label->col_all_Class . "'>";
        $view .= "<div class='row'>";
        $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label . "</label>";
        $view .= "<div class=' $label->col_input_Class'>";
        $view .= "<div class='form-group has-default bmd-form-group'>";
        $view .= "<input type='number'  value='" . $data . "'  class='form-control  " . $label->inputClass . "'  name='" . $label->field_name . "' id='" . $label->field_name . "'  $label->attr  $attr  alt='" . $label->label . "'  >";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        return $view;
    }
}
if (!function_exists('inputHidden')) {
    function inputHidden($label, $data)
    {
        $view = "";
        $attr = inputAttr($label);
        $view .= "<input type='hidden'  value='" . $data . "'  class='form-control   " . $label->inputClass . "'  name='" . $label->field_name . "' id='" . $label->field_name . "'  $label->attr  $attr   >";
        return $view;
    }
}
if (!function_exists('inputPassword')) {
    function inputPassword($label, $data)
    {
        $view = "";
        $attr = inputAttr($label);
        $view = "<div class='" . $label->col_all_Class . "'>";
        $view .= "<div class='row'>";
        $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label . "</label>";
        $view .= "<div class='$label->col_input_Class'>";
        $view .= "<div class='form-group has-default bmd-form-group'>";
        $view .= "<input type='password'  value='" . $data . "'  class='form-control   " . $label->inputClass . "'  name='" . $label->field_name . "' id='" . $label->field_name . "'  $label->attr  $attr  alt='" . $label->label . "'  >";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        return $view;
    }
}
if (!function_exists('inputEmail')) {
    function inputEmail($label, $data)
    {
        $view = "";
        $attr = inputAttr($label);
        $view = "<div class='" . $label->col_all_Class . "'>";
        $view .= "<div class='row'>";
        $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label . "</label>";
        $view .= "<div class='$label->col_input_Class '>";
        $view .= "<div class='form-group has-default bmd-form-group'>";
        $view .= "<input type='email' class='form-control  " . $label->inputClass . "'  name='" . $label->field_name . "' id='" . $label->field_name . "'  $label->attr  $attr  alt='" . $label->label . "'  value='" . $data . "' >";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        return $view;
    }
}
if (!function_exists('inputAttr')) {
    function inputAttr($label)
    {
        $attr = "";
        $attrs = $label->toArray();
        $search_array = ['id', 'screen_id', 'language_id', 'table_name', 'db_field_name', 'field_name',
            'label', 'field_type_id', 'is_related', 'related_table', 'related_key', 'related_value'];
        foreach ($attrs as $key => $value) {
            if (!in_array($key, $search_array)) {

                if ($key == 'is_separated') {
                    if ($value == 1) {
                        $attr .= "step='0.001'";
                        $attr .= " ";
                    }
                } elseif ($key == 'is_required') {
                    if ($value == 1) {
                        $attr .= "required";
                        $attr .= " ";
                    }
                } elseif ($key == 'min_value') {
                    $attr .= "minLength='$value'";
                    $attr .= " ";
                } elseif ($key == 'max_value') {
                    $attr .= "maxLength='$value'";
                    $attr .= " ";
                } elseif ($key == 'is_hide') {
                    if ($value == 1) {
                        $attr .= "hidden='hidden' ";
                        $attr .= " ";
                    }
                } elseif ($key == 'is_display') {
                    if ($value == 1) {
                        $attr .= "readonly='readonly'";
                        $attr .= " ";
                    }
                }
            }

        }
        return $attr;

    }
}
if (!function_exists('related')) {
    function related($label, $data)
    {


//        DB::enableQueryLog();
        $view = "";

        if ($label->related_value && $label->related_key && $label->related_table) {

            $rel = \Illuminate\Support\Facades\DB::table($label->related_table);
            if ($label->relatedWhere) {

                $rel = $rel->whereRaw($label->relatedWhere);
            }
            $rel = $rel->orderBy('id', 'desc')
                ->pluck($label->related_value, $label->related_key);


        } else {
            return $view = " check  related to filed $label->label in labels Table  ";
        }

//        dd(DB::getQueryLog());
        if ($label->html_type == '5') {
            $view = inputSelectDropdown($label, $rel, $data);
        } elseif ($label->html_type == '6') {

            $view = inputMultiSelectDropdown($label, $rel, $label->SelectedArray);
        } elseif ($label->html_type == '7') {
            $view = inputRadio($label, $rel, $data);
        } elseif ($label->html_type == '8') {
            $view = inputCheckbox($label, $rel, $data);
        }elseif ($label->html_type == '19') {
                $view .= inputColorDropdown($label, $rel, $data);
       }

        return $view;
    }
}
if (!function_exists('inputSelectDropdown')) {
    function inputSelectDropdown($label, $rel, $data)
    {
        $view = "";
        $attr = inputAttr($label);
        $view = "<div class='" . $label->col_all_Class . "'>";
        $view .= "<div class='row'>";
        if ($label->is_required == 1) {
            $req_star = '<span style="color:red;">*</span>';
        } else {
            $req_star = "";
        }
        if ($label->field_name == "country_id" || $label->field_name == "state_id"){
            $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label . " " . $req_star . "  <span id='".$label->field_name."_loader"."' class='loader ml-3 position-absolute'></span> </label>";
        }else{
            $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label . " " . $req_star . "</label>";
        }
        $view .= "<div class='$label->col_input_Class'>";
        $view .= "<div class='form-group has-default bmd-form-group'>";
        $view .= "<select class='form-control  selectpicker  " . $label->inputClass . "' name='" . $label->field_name . "' data-style='btn btn-link' id='" . $label->field_name . "' $label->attr  $attr>";
        $view .= "<option  style='height: 37px;' value></option>";
        if ($rel) {
            foreach ($rel as $key => $value) {
                $selected = "";
                if ($data == $key) {
                    $selected = "selected";
                }
                $view .= "<option  value='" . $key . "'  {$selected}>" . $value . "</option>";
            }
        }
        // <option>1</option>

        $view .= "</select>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        return $view;
    }
}
if (!function_exists('inputMultiSelectDropdown')) {
    function inputMultiSelectDropdown($label, $rel, $data)
    {
        //SelectedArray
        $view = "";
        $attr = inputAttr($label);
        $view = "<div class='" . $label->col_all_Class . "'>";
        $view .= "<div class='row'>";
        if($label->is_required==1){
            $req_star='<span style="color:red;">*</span>';
        }else{
            $req_star="";
        }
        $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label ." ".$req_star. "</label>";
        $view .= "<div class='$label->col_input_Class'>";
        $view .= "<div class='form-group has-default bmd-form-group'>";
        $view .= "<select multiple  class='form-control  selectpicker  " . $label->inputClass . "' name='" . $label->field_name . "[]' data-style='btn btn-link' id='" . $label->field_name . "' $label->attr  $attr>";
        //   $view .= "<option  style='height: 37px;' value='null'></option>";

        if ($rel) {
            foreach ($rel as $key => $value) {
                $selected = "";
                if (is_array($data)) {

                    if (in_array($key, $data)) {
                        $selected = "selected";
                    }
                } else {
                    if ($data == $key) {
                        $selected = "selected";
                    }
                }
                $view .= "<option value='" . $key . "' {$selected}>" . $value . "</option>";
            }
        }
        $view .= "</select>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        return $view;
    }
}
if (!function_exists('inputRadio')) {
    function inputRadio($label, $rel, $data)
    {
        $view = "";
        $attr = inputAttr($label);
        $view = "<div class='" . $label->col_all_Class . "'>";
        $view .= "<div class='row'>";
        $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label . "</label>";
        $view .= "<div class='$label->col_input_Class'>";
        $view .= "<div class='form-group has-default bmd-form-group'>";
        if ($rel) {
            foreach ($rel as $key => $value) {
                $checked = "";
                if ($data == $key) {
                    $checked = "checked";
                }

                $view .= "<div class='form-check form-check-radio form-check-inline'>";
                $view .= "<label class='form-check-label'>";
                $view .= "<input class='form-check-input    $label->inputClass  ' type='radio' {$checked}  value='$key' name='" . $label->field_name . "' id='" . $label->field_name . "' $label->attr  $attr >";
                $view .= "$value<span class='circle'>";
                $view .= " <span class='check'></span>";
                $view .= "</span>";
                $view .= "</label>";
                $view .= "</div>";
            }
        }
        $view .= "</div > ";
        $view .= "</div > ";
        $view .= "</div > ";
        $view .= "</div > ";
        return $view;
    }
}
if (!function_exists('inputCheckbox')) {
    function inputCheckbox($label, $rel, $data = null)
    {
        $view = "";
        $attr = inputAttr($label);
        $view = "<div class='" . $label->col_all_Class . "'>";
        $view .= "<div class='row'>";
        $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label . "</label>";
        $view .= "<div class='$label->col_input_Class'>";
        $view .= "<div class='form-group has-default bmd-form-group'>";
        if ($rel) {
            foreach ($rel as $key => $value) {
                $checked = "";
                if ($data == $key) {
                    $checked = "checked";
                }

                $view .= "<div class='form-check  form-check-inline'>";
                $view .= "<label class='form-check-label'>";
                $view .= "<input class='form-check-input  $label->inputClass ' type='checkbox'   value='$key' name='" . $label->field_name . "[]' id='checkbox" . $key . "' $label->attr  $attr >";
                $view .= "$value<span class='form-check-sign'>";
                $view .= " <span class='check'></span>";
                $view .= "</span>";
                $view .= "</label>";
                $view .= "</div>";
            }
        } else {
            $checked = "";
            if ($data == 1) {
                $checked = "checked";
            }
            $view .= "<div class='form-check  form-check-inline'>";
            $view .= "<label class='form-check-label'>";
            $view .= "<input class='form-check-input  $label->inputClass ' type='checkbox'   value='$data' name='" . $label->field_name . "' id='" . $label->field_name . "' $label->attr  $attr  $checked>";
            $view .= "<span class='form-check-sign'>";
            $view .= " <span class='check'></span>";
            $view .= "</span>";
            $view .= "</label>";
            $view .= "</div>";
        }
        $view .= "</div > ";
        $view .= "</div > ";
        $view .= "</div > ";
        $view .= "</div > ";
        return $view;
        /* get selected value from multi checkbox
        var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
        */
    }
}

if (!function_exists('inputFile')) {
    function inputFile($label, $data)
    {
      $col_label_Class = $label->col_label_Class ?? '';
      $col_input_Class = $label->col_input_Class ?? 'col-md-12';
        $view = "  ";
        $attr = inputAttr($label);
        $view .= "<div class='" . $label->col_all_Class . "'>";
        $view .= "<div class='row'>";
        $view .= "<div class='".$col_label_Class."'></div>";
        $view .= "<div class='".$col_input_Class."'>";
        $view .= "<div class='fileinput fileinput-new text-center' data-provides='fileinput'>";
        $view .= "<div class='fileinput-new thumbnail img-raised'>";
        if ($data) {
            $view .= "<img  style=' max-height: 100px; width: 100px; ' src =" . asset('images/user/photo/') . '/' . $data . " alt= '...' >";
        } else {
            $view .= "<img style=' max-height: 100px; width: 100px; ' src =" . asset('assets/img/placeholder.png') . " alt = '...' >";
        }
        $view .= "</div>";
        $view .= "<div class='fileinput-preview fileinput-exists thumbnail img-raised'>

</div>";
        $view .= "<div style=' float: right;padding-top: 14%; '>";
        $view .= "<span class='btn btn-sm  btn-rose btn-file'>";
        $view .= "<span class='fileinput-new'>$label->label</span>";
        $view .= "<span class='fileinput-exists'>Change</span>";
        $view .= "<input type='file' class='$label->inputClass ' name='$label->field_name' id='$label->field_name' $label->attr  $attr>";
        $view .= "</span>";
        $view .= "<a href=#pablo' class='btn btn-danger btn-sm  fileinput-exists' data-dismiss='fileinput'>";
        $view .= "<i class='fa fa-times'></i> Remove</a>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        return $view;

    }


}
if (!function_exists('inputFile2')) {
    function inputFile2($label, $data)
    {
        $view = "  ";
        $db_field_name = $label->db_field_name;
        $change = ' ';
        if ($data->$db_field_name != null) {
            $change = 'Change ';
            $view .= "<div class=' col-md-12'>";

            if ($label->table_name == "strategic_plan") {
                 $view .= "<div class='row'> <label class='col-md-2 col-form-label'>$label->label</label> <div class='col-md-10'> <a class='btn btn-info btn-sm' href='" . asset('images/strategic/') . "/" . $data['file'] . "'>" . $data['file_name'] . "</a></div> </div>";
            } else if ($label->table_name == "visits") {
                 $view .= "<div class='row'> <label class='col-md-2 col-form-label'>$label->label</label> <div class='col-md-10'><a class='btn btn-info btn-sm' href='" . asset('images/visit/') . "/" . $data[$label->db_field_name] . "'>" . $data[$label->db_field_name] . "</a></div> </div>";
            }
            $view .= "</div>";
        }

        $attr = inputAttr($label);

        $view .= "<div class='" . $label->col_all_Class . "'>";
        $view .= "<div class='row'>";
        $view .= "<div class='col-md-12'>";
        $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'> " . $change . $label->label . "</label>";

        $view .= "<div class='fileinput fileinput-new text-center' data-provides='fileinput'>";


        $view .= "<div class='fileinput-preview fileinput-exists thumbnail img-raised'>";
        $view .= "</div>";
        $view .= "<div'>";
        $view .= "<span class='btn btn-sm  btn-rose btn-file'>";
        $view .= "<span class='fileinput-new'>select file</span>";
        $view .= "<span class='fileinput-exists'>Change</span>";
        $view .= "<input type='file' class='$label->inputClass ' name='$label->field_name' id='$label->field_name' $label->attr  $attr>";
        $view .= "</span>";
        $view .= "<a href=#pablo' class='btn btn-danger btn-sm  fileinput-exists' data-dismiss='fileinput'>";
        $view .= "<i class='fa fa-times'></i> Remove</a>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        //$view .= "</div>";

        return $view;

    }


}

if (!function_exists('inputURL')) {
    function inputURL($label, $data)
    {
        $view = "";
        $attr = inputAttr($label);
        $view = "<div class='" . $label->col_all_Class . "'>";
        $view .= "<div class='row'>";
        $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label . "</label>";
        $view .= "<div class=' $label->col_input_Class'>";
        $view .= "<div class='form-group has-default bmd-form-group'>";
        $view .= "<input type='url'  value='" . $data . "'  class='form-control  " . $label->inputClass . "'  name='" . $label->field_name . "' id='" . $label->field_name . "'  $label->attr  $attr  alt='" . $label->label . "'   >";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        return $view;
    }
}


if (!function_exists('inputCurrency')) {
    function inputCurrency($label, $data)
    {
        $view = "";
        $attr = inputAttr($label);
        $view = "<div class='" . $label->col_all_Class . "'>";
        $view .= "<div class='row'>";
        if($label->is_required==1){
            $req_star='<span style="color:red;">*</span>';
        }else{
            $req_star="";
        }
        if(!empty($label->label_hint)) {
            $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label ." ".$req_star. " <a data-toggle='tooltip' title='.$label->label_hint.'><i style='font-size: 16px;' class='fa fa-question-circle'>       </i></a></label> ";
        }else{
            $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label ." ".$req_star. "</label> ";
        }
        $view .= "<div class=' $label->col_input_Class'>";
        $view .= "<div class='form-group has-default bmd-form-group'>";

        $carrancy__ = number_format($data,3,'.',',' );
        if($carrancy__ == 0.000){
            $carrancy__ = '';
        }
        $view .= "<input type='text'  value='" .  $carrancy__ . "'  class='form-control  input-currency-gf" . $label->inputClass . "'  name='" . $label->field_name . "' id='" . $label->field_name . "'  $label->attr  $attr  alt='" . $label->label . "'   >";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        return $view;
    }
}

if (!function_exists('inputColorDropdown')) {
    function inputColorDropdown($label, $rel, $data)
    {
        $view = "";
        $attr = inputAttr($label);
        $view = "<div class='" . $label->col_all_Class . "'>";
        $view .= "<div class='row'>";
        if($label->is_required==1){
            $req_star='<span style="color:red;">*</span>';
        }else{
            $req_star="";
        }
        $view .= "<label for='" . $label->field_name . "' class='$label->col_label_Class col-form-label'>" . $label->label ." ".$req_star. "</label>";
        $view .= "<div class='$label->col_input_Class'>";
        $view .= "<div class='form-group has-default bmd-form-group'>";
        $view .= "<select class='form-control  selectpicker  " . $label->inputClass . "' name='" . $label->field_name . "' data-style='btn btn-link' id='" . $label->field_name . "' $label->attr  $attr>";
        $view .= "<option  style='height: 37px;' value></option>";
        if ($rel) {
            foreach ($rel as $key => $value) {
                $selected = "";
                if ($data == $value) {
                    $selected = "selected";
                }
                $view .= "<option style='border-bottom:2px solid #fff;background:" . $value . "'  value='" . $value . "'  {$selected}>" . $value . "</option>";
            }
        }
        // <option>1</option>

        $view .= "</select>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        return $view;
    }
}

//<div class="row">
//  <div class="col-md-6">
//    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
//       <div class="fileinput-new thumbnail img-raised">
//    	<img src="https://epicattorneymarketing.com/wp-content/uploads/2016/07/Headshot-Placeholder-1.png" alt="...">
//       </div>
//       <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
//       <div>
//    	<span class="btn btn-raised btn-round btn-rose btn-file">
//    	   <span class="fileinput-new">Select image</span>
//    	   <span class="fileinput-exists">Change</span>
//    	   <input type="file" name="..." />
//    	</span>
//            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput">
//            <i class="fa fa-times"></i> Remove</a>
//       </div>
//    </div>
//  </div>

if (!function_exists('inputButton')) {
    function inputButton($lang_id, $screen_id = 0)
    {

        $buttons = \App\Models\Setting\Label::where('language_id', $lang_id)
            ->where(function ($query) use ($screen_id) {
                $query->where('screen_id', $screen_id)
                    ->orWhere('screen_id', '0');
            })
            ->get()->toArray();
        $labels_array = [];
        foreach ($buttons as $labels) {
            $labels_array[$labels['db_field_name']] = $labels['label'];
        }

        return $labels_array;
    }
}

if (!function_exists('fieldInDatabase')) {
    function fieldInDatabase($screen_id, $input)
    {
        $lang_id = Auth::user()->lang_id;
        $labels = \App\Models\Setting\Label::where('screen_id', $screen_id)
            ->where('language_id', $lang_id)
            ->get();

        $field = [];
        $fieldIsValidation = [];

        foreach ($input as $key => $value) {
            if ($key != '_token' && $key != '_method') {
                $label = $labels->where('field_name', $key)->first();

                if ($label) {
                    if ($value != null) {
                        if ($label->field_type_id == 4) {
                            // $value = Carbon\Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
                            $value = dateFormatSite($value);
                        } else  if ($label->html_type == 18) {
                            $value = str_replace( ',', '',$value);
                        }
                    }
                    $field[$label->db_field_name] = $value;
                    $fieldIsValidation[] = $label;
                }
                $field[$key] = $value;
            }

        }
        $data = ['field' => $field, 'fieldIsValidation' => $fieldIsValidation];
        return $data;
    }

}


if (!function_exists('inputButtonName')) {
    function inputButtonName($name, $screen_id = 0)
    {

        $lang_id = \Illuminate\Support\Facades\Auth::user()->lang_id;
        $button = inputButton($lang_id, $screen_id);
        return $button[$name];
    }
}

use Illuminate\Foundation\Validation\ValidatesRequests;

if (!function_exists('inputValidator')) {
    function inputValidator($data, $optionValidator = null)
    {
        localization();

        $inputValidator = $data['field'];
        $fieldIsValidation = $data['fieldIsValidation'];
        //    dd($fieldIsValidation);
        $rulesFieldValidatorArray = [];
        $rulesFieldName = [];


        foreach ($fieldIsValidation as $field) {
            if ($field->is_validation == '1') {
                $rulesFieldName[$field->db_field_name] = $field->label;

                $roleField = [];
                if ($field->is_required == '1') {
                    $roleField ['required'] = 'required';

                }
                if ($field->html_type == '1' or $field->html_type == '5' or $field->html_type == '7') {
                    $roleField ['integer'] = 'integer';
                }
                if ($field->html_type == '2' or $field->html_type == '3') {
                    $roleField ['string'] = 'string';
                }
                if ($field->html_type == '4') {
                    $roleField ['date'] = 'date';
                }
                if ($field->html_type == '11') {
                    $roleField ['password'] = 'password';
                }
                if ($field->html_type == '12') {
                    $roleField ['email'] = 'email';
                }
                if ($field->field_type_id == '2') {
                    $roleField ['numeric'] = 'numeric';
                }

                if ($field->field_type_id != '2' and $field->field_type_id != '1' and $field->field_type_id != '4' and $field->html_type != '9' and $field->html_type != '8' and $field->html_type != '7' and $field->html_type != '6' and $field->html_type != '5') {
                    if ($field->min_value > 0) {
                        $roleField ['min'] = 'min:' . $field->min_value;

                    }
                    $roleField ['max'] = 'max:' . $field->max_value;
                }

                if ($field->field_type_id == '1' or $field->html_type == '1') {
                    $roleField ['digits_between'] = 'digits_between:' . $field->min_value . ',' . $field->max_value;
                }


                if (!empty($optionValidator)) {
                    if (array_key_exists($field->db_field_name, $optionValidator)) {
                        foreach ($optionValidator[$field->db_field_name] as $key => $value) {
                            if ($value != 'false') {
                                $roleField [$key] = $value;
                            }
//                            } elseif(is_object($value)){
//                                dd('yes Unique instanceof');
//
//                            }
                            else {

                                unset($roleField[$key]);
                            }

                        }
                    }
                }
                $rulesFieldValidatorArray[$field->db_field_name] = $roleField;
            }


        }

//dd($rulesFieldName);
        if (!empty($optionValidator)) {
            foreach ($optionValidator as $key => $value) {
                if (array_key_exists($key, $rulesFieldName)) {
                    //       dd($key, $value);
                    unset($optionValidator[$key]);
                }
            }
            foreach ($optionValidator as $key => $value) {
                $rulesFieldValidatorArray[$key] = $value;
            }
        }


        $sessionInputValidator = $inputValidator;
        if (array_key_exists('_files_', $sessionInputValidator)) {
            unset($sessionInputValidator['_files_']);
        }

        session(['inputFormFromValidator' => array_filter($sessionInputValidator, function ($v, $k) {

            return !($v instanceof \Symfony\Component\HttpFoundation\File\UploadedFile);


        }, ARRAY_FILTER_USE_BOTH)]);
        $validator = \Validator::make(
            $inputValidator,
            $rulesFieldValidatorArray,
            [],
            $rulesFieldName)
            ->validate();
    }
}

if (!function_exists('screenName')) {
    function screenName($screen_id)
    {
        return \App\Models\Permission\Screen::getNameByUserLang($screen_id);
    }
}

if (!function_exists('dateFormatDataBase')) {
    function dateFormatDataBase($var)
    {
        if ($var != null && $var != '') {
            $date = str_replace('/', '-', $var);
            return date('Y-m-d', strtotime($date));
        }
    }
}

if (!function_exists('dateFormatDataBase_')) {
    function dateFormatDataBase_($var)
    {
        $arr = explode('/', $var);
        $date_str = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
        return date('Y-m-d', strtotime($date_str));
    }
}

if (!function_exists('dateFormatSite')) {
    function dateFormatSite($var)
    {
        if ($var != null) {
            $date = str_replace('/', '-', $var);
            return date('d/m/Y', strtotime($date));
        }

    }
}


if (!function_exists('generatorFormLabel')) {
    function generatorFormLabel($screen_id, $lang_id)
    {

        $view = '<div class="row">';
        $labels = \App\Models\Setting\Label::where('screen_id', $screen_id)
            ->where('language_id', $lang_id)
            ->get();

        foreach ($labels as $label) {
            $view .= inputTextFormLabel($label);
        }

        $view .= "</div>";
        return $view;
    }
}

if (!function_exists('inputTextFormLabel')) {
    function inputTextFormLabel($label)
    {
        $lang = "";
        if ($label->language_id == 1) {
            $lang = 'English - ';
        } else {
            $lang = 'Arabic - ';
        }
        $view = "";
        $view = "<div class='col-md-12'>";
        $view .= "<div class='row'>";
        $view .= "<label for='" . $label->field_name . "' class='col-md-4 col-form-label'>" . $lang . $label->field_name . "</label>";
        $view .= "<div class='col-md-8'>";
        $view .= "<div class='form-group has-default bmd-form-group'>";
        $view .= "<input type='text'  value='" . $label->label . "'  class='form-control'  name='" . $label->field_name . "' id='" . $label->field_name . "'   alt='" . $label->label . "'   >";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        $view .= "</div>";
        return $view;
    }
}

        
if (!function_exists('number_currency_format')) {   
  function number_currency_format($value)   
  { 
    $carrancy__ = number_format($value, 3, '.', ',');   
    if ($carrancy__ == 0.000) { 
      $carrancy__ = ''; 
    }   
    return $carrancy__; 
  } 
}

