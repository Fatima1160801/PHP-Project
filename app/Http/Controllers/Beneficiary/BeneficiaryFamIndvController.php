<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 9/24/2018
 * Time: 8:13 AM
 */

namespace App\Http\Controllers\Beneficiary;

use App\Http\Controllers\Controller;

use App\Helpers\Log;
use App\Models\Project\ActuallyTargetedBeneficiaries;
use Session;
use App\Http\Controllers\Report\BeneficiaryFamiliesReportExportExcel;
use App\Http\Controllers\Report\BeneficiaryReportExportExcel;
use App\Models\Activity\ActivityBeneficiaries;
use App\Models\Beneficiary\Beneficiary;
use App\Models\Report\Beneficiary\ReportBeneficiary;
use App\Models\Report\ReportMaster;
use App\Models\Report\ReportMasterUser;
use App\Models\Setting\C\District;
use App\Models\Setting\CustomField;
use App\Models\Setting\CustomFieldSelectOption;
use App\Models\Setting\FieldTypeUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Beneficiary\BeneficiaryFamily;
use DB;
use Validator;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use File;


use App\Imports;
use Maatwebsite\Excel\Facades\Excel;


class BeneficiaryFamIndvController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');


    }

    public function index(Request $request)
    {
        is_permitted(25, getClassName(__CLASS__), __FUNCTION__, 69, 7);

        $beneficiaries = Beneficiary::get();
        $messageDeleteBeneficiary = getMessage('2.46');
        $labels = inputButton(Auth::user()->lang_id, 25);
        $userPermissions = getUserPermission();
        if ($request->ajax()) {
            $html= view('beneficiary.families_individuals.table_render', compact('labels', 'beneficiaries', 'messageDeleteBeneficiary', 'userPermissions'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('beneficiary.families_individuals.index', compact('labels', 'beneficiaries', 'messageDeleteBeneficiary', 'userPermissions'));
        }
    }

    public function getCreate(Request $request)
    {
        is_permitted(25, getClassName(__CLASS__), 'store', 70, 1);

        $gender_a = [
            1 => ['1' => 'Male', '2' => 'Female'],
            2 => ['1' => 'ذكر', '2' => 'أنثى']
        ];
        $ben_type_id = ['relatedWhere' => 'id in (1,2) ', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-4', 'html_type' => '5'];
        $gender = ['html_type' => '7', 'selectArray' => $gender_a[Auth::user()->lang_id]];
        $ben_city = ['html_type' => '5', 'relatedWhere' => 'deleted_at is null and is_hidden =0','attr' => ' data-live-search="true"'];
        $marital_status = ['html_type' => '5', 'selectArray' => ['1' => 'Single', '2' => 'Married', '3' => 'Widowed', '4' => 'Divorced'],'attr' => ' data-live-search="true"'];
        $ben_desc = ['html_type' => '3', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $is_hidden = ['html_type' => '13'];
        $ben_idno = ['inputClass' => 'check-is-number'];
        $ben_mobile_no = ['inputClass' => 'check-is-number'];
        $ben_tel_no = ['inputClass' => 'check-is-number'];
        $note = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $no_of_family = ['inputClass' => 'check-is-number'];
        $no_males = ['inputClass' => 'check-is-number'];
        $no_females = ['inputClass' => 'check-is-number'];

        $option = [
            'ben_type_id' => $ben_type_id,
            'gender' => $gender,
            'ben_city' => $ben_city,
            'marital_status' => $marital_status,
            'desc_' => $ben_desc,
            'is_hidden' => $is_hidden,
            'ben_mobile_no' => $ben_mobile_no,
            'ben_idno' => $ben_idno,
            'ben_tel_no' => $ben_tel_no,
            'note' => $note,
            'no_of_family' => $no_of_family,
            'no_males' => $no_males,
            'no_females' => $no_females,
            'district_id'=>['attr' => ' data-live-search="true"'],
        ];

        $beneficiary = new Beneficiary();
        $beneficiary->special_needs = 0;

        $customFields = CustomField::where('table_name', 'beneficiary')->get();
        $customFieldTypes = FieldTypeUser::all();

        $generator = generator(25, $option, $beneficiary);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();

        if ($request->ajax()) {
            $html= view('beneficiary.families_individuals.create_render', compact('labels', 'html', 'beneficiary', 'customFieldTypes', 'customFields', 'userPermissions'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('beneficiary.families_individuals.create', compact('labels', 'html', 'beneficiary', 'customFieldTypes', 'customFields', 'userPermissions'));
        }

    }

    public function store(Request $request)
    {
        is_permitted(25, getClassName(__CLASS__), __FUNCTION__, 70, 1);

        $input = $request->all();
        $data = fieldInDatabase(25, $input);

        $optionValidator = [
            'ben_idno' => [
                'unique' => 'unique:beneficiary,ben_idno'
            ],
            'no_males' => [
                'nullable' => 'nullable'
            ],
            'no_females' => [
                'nullable' => 'nullable'
            ],
            'no_special_needs' => [
                'nullable' => 'nullable'
            ],
        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        if ($input['flagID'] == 0) {
            $beneficiaryFamily = BeneficiaryFamily::where('ind_idno', $input['ben_idno'])->first();

            if ($beneficiaryFamily) {
                $Beneficiary = Beneficiary::find($beneficiaryFamily->ben_id);
                $BeneficiaryName = $Beneficiary->ben_name_fo;
                $BeneficiaryId = $Beneficiary->ben_idno;
                // $beneficiary=['name'=>$BeneficiaryName,'id'=>$BeneficiaryId];
                $text = "المستفيد المضاف موجود كفرد اسرة للمستفيد:";
                $text .= "<strong>" . $BeneficiaryName . "</strong>";
                $text .= "  حامل هوية رقم:";
                $text .= "<strong>" . $BeneficiaryId . "</strong> ";
                $text .= "<br> ";
                $text .= " هل تريد الاستمرار؟ ";

                return response(['success' => 'individual', 'text' => $text]);

            }
        }


        $beneficiary = new Beneficiary();
        $beneficiary->fill($field);
        $beneficiary->created_by = Auth::id();

        if (!empty($field['special_needs'])) {
            $beneficiary->special_needs = 1;
        } else {
            $beneficiary->special_needs = 0;
        }
        $custom_fields = [];
        $cf_options = [];
        if (!empty($input['custom_fields_count']) && $input['custom_fields_count'] > 0) {
            for ($i = 1; $i <= $input['custom_fields_count']; $i++) {
                if (in_array($input['beneficiary_custom_field_' . $i . '_type'], [6, 8])) {
                    if (is_array($input['beneficiary_custom_field_' . $i]) && count($input['beneficiary_custom_field_' . $i]) > 0) {
                        foreach ($input['beneficiary_custom_field_' . $i] as $option) {
                            array_push($cf_options, $option);
                        }
                    }
                    $custom_fields['beneficiary_custom_field_' . $i] = $cf_options;
                } else if (in_array($input['beneficiary_custom_field_' . $i . '_type'], [1, 2, 3, 4, 5, 7, 9])) {
                    $custom_fields['beneficiary_custom_field_' . $i] = $input['beneficiary_custom_field_' . $i];
                }
                $cf_options = [];
            }
        }

        $beneficiary->custom_fields = json_encode($custom_fields);
        $beneficiary->save();

        Log::instance()->record('2.11', null, 25, null, null, null, null);
        Log::instance()->save();
//dd($beneficiary->ben_type_id);
//        if ($beneficiary->ben_type_id == 1) {
        return response(['success' => true, 'message' => getMessage('2.37')]);
//        } else if ($beneficiary->ben_type_id == 2) {
//            $message = getMessage('2.38');
//            $prefix = $beneficiary->gender == 1 ? 'his' : 'her';
//            $message['text'] = str_replace('_G_', $prefix, $message['text']);
//            return response(['success' => true, 'message' => $message]);
//        }

    }

    public function getEdit($id,Request $request)
    {

        is_permitted(25, getClassName(__CLASS__), 'postEdit', 71, 2);

        $beneficiary = Beneficiary::where('id', $id)->first();


        if ($beneficiary == null) {
            return redirect()->route('beneficiary.fam_indev.index');
        }

        if ($beneficiary->ben_type_id == 2) {
            $beneficiary_familiy = BeneficiaryFamily::where('ben_id', $id)->get();
        }

        $ms = [1 => ['1' => 'Single', '2' => 'Married', '3' => 'Widowed', '4' => 'Divorced'],
            2 => ['1' => 'أعزب', '2' => 'متزوج', '3' => 'أرمل', '4' => 'مطلّق']
        ];
        $pst = [1 => ['0' => 'Active', '1' => 'Inactive'],
            2 => ['0' => 'مفعل', '1' => 'غير مفعل']
        ];
        $gender_a = [1 => ['1' => 'Male', '2' => 'Female'],
            2 => ['1' => 'ذكر', '2' => 'أنثى']
        ];
        $ben_type_id = ['relatedWhere' => 'id != 3', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-4', 'html_type' => '5'];
        $gender = ['html_type' => '7', 'selectArray' => $gender_a[Auth::user()->lang_id]];
        $ben_city = ['html_type' => '5', 'relatedWhere' => 'deleted_at is null  and is_hidden =0','attr' => ' data-live-search="true"'];
        $marital_status = ['html_type' => '5', 'selectArray' => $ms[Auth::user()->lang_id]];
        $ben_desc = ['html_type' => '3', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $is_hidden = ['html_type' => '5', 'selectArray' => $pst[Auth::user()->lang_id]];
        $b_id = ['html_type' => '10'];
        $ben_idno = ['inputClass' => 'check-is-number'];
        $ben_mobile_no = ['inputClass' => 'check-is-number'];
        $ben_tel_no = ['inputClass' => 'check-is-number'];
        $note = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];

        $no_of_family = ['inputClass' => 'check-is-number'];
        $no_males = ['inputClass' => 'check-is-number'];
        $no_females = ['inputClass' => 'check-is-number'];

        if ($beneficiary->ben_city != null) {
            $district_id = ['relatedWhere' => 'is_hidden = 0 and deleted_at is null and city_id=' . $beneficiary->ben_city, 'col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];

        } else {
            $district_id = ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];
        }

        $option = [
            'ben_type_id' => $ben_type_id,
            'gender' => $gender,
            'ben_city' => $ben_city,
            'marital_status' => $marital_status,
            'desc_' => $ben_desc,
            'is_hidden' => $is_hidden,
            'ben_idno' => $ben_idno,
            'ben_mobile_no' => $ben_mobile_no,
            'id' => $b_id,
            'ben_tel_no' => $ben_tel_no,
            'note' => $note,
            'district_id' => $district_id,
            'no_of_family' => $no_of_family,
            'no_males' => $no_males,
            'no_females' => $no_females,
            'district_id'=>['attr' => ' data-live-search="true"'],
        ];
        $customFields = CustomField::where('table_name', 'beneficiary')->get();
        $customFieldTypes = FieldTypeUser::all();

        $generator = generator(25, $option, $beneficiary);
        $html = $generator[0];
        $labels = $generator[1];
        $ben_familiy_members = $beneficiary->ben_type_id == 2 ? $beneficiary_familiy : [];
        $messageDeleteBeneficiaryFam = getMessage('2.41');
        $userPermissions = getUserPermission();

        if ($request->ajax()) {
            $html=  view('beneficiary.families_individuals.update_render', compact('labels', 'html', 'beneficiary', 'ben_familiy_members', 'messageDeleteBeneficiaryFam', 'beneficiary', 'customFieldTypes', 'customFields', 'userPermissions'))->render();
            //$html= view('beneficiary.families_individuals.create_render', compact('labels', 'html', 'beneficiary', 'customFieldTypes', 'customFields', 'userPermissions'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('beneficiary.families_individuals.update', compact('labels', 'html', 'beneficiary', 'ben_familiy_members', 'messageDeleteBeneficiaryFam', 'beneficiary', 'customFieldTypes', 'customFields', 'userPermissions'));
        }
    }

    public function postEdit(Request $request)
    {
        is_permitted(25, getClassName(__CLASS__), __FUNCTION__, 71, 2);

        $input = $request->all();

        $data = fieldInDatabase(25, $input);
        $field = $data['field'];
        $optionValidator = [
            'ben_idno' => [
                'unique' => 'unique:beneficiary,ben_idno,' . $field['id']
            ],
            'no_males' => [
                'nullable' => 'nullable'
            ],
            'no_females' => [
                'nullable' => 'nullable'
            ],
            'no_special_needs' => [
                'nullable' => 'nullable'
            ],
        ];
        inputValidator($data, $optionValidator);


        if ($request->get('id') != null) {
            $beneficiary = Beneficiary::find($request->get('id'));
            Log::instance()->record('2.12', $field['id'], 25, null, null, $field, $beneficiary);
            $beneficiary_type_id_befor = $beneficiary->ben_type_id;
            $beneficiary->fill($field);
            if (!empty($field['special_needs'])) {
                $beneficiary->special_needs = 1;
            } else {
                $beneficiary->special_needs = 0;
            }
            $beneficiary->updated_by = Auth::id();

            $custom_fields = [];
            $cf_options = [];
            if (!empty($input['custom_fields_count']) && $input['custom_fields_count'] > 0) {
                for ($i = 1; $i <= $input['custom_fields_count']; $i++) {
                    if (in_array($input['beneficiary_custom_field_' . $i . '_type'], [6, 8])) {
                        if (is_array($input['beneficiary_custom_field_' . $i]) && count($input['beneficiary_custom_field_' . $i]) > 0) {
                            foreach ($input['beneficiary_custom_field_' . $i] as $option) {
                                array_push($cf_options, $option);
                            }
                        }
                        $custom_fields['beneficiary_custom_field_' . $i] = $cf_options;
                    } else if (in_array($input['beneficiary_custom_field_' . $i . '_type'], [1, 2, 3, 4, 5, 7, 9])) {
                        $custom_fields['beneficiary_custom_field_' . $i] = $input['beneficiary_custom_field_' . $i];
                    } else if ($input['beneficiary_custom_field_' . $i . '_type'] == 10) {

                    }
                    $cf_options = [];
                }
            }

            $beneficiary->custom_fields = json_encode($custom_fields);
            $beneficiary->save();
            Log::instance()->save();
            $message = getMessage('2.39');
        }

        return response(['success' => true, 'message' => $message, 'ben_type_befor' => $beneficiary_type_id_befor, 'ben_type_after' => $beneficiary->ben_type_id]);
    }


    public function getcreatefm($id)
    {
        is_permitted(26, getClassName(__CLASS__), 'storefm', 137, 1);

        $beneficiary = Beneficiary::find($id);
        //dd($beneficiary);
        $ms = [1 => ['1' => 'Single', '2' => 'Married', '3' => 'Widowed', '4' => 'Divorced'],
            2 => ['1' => 'أعزب', '2' => 'متزوج', '3' => 'أرمل', '4' => 'مطلّق']
        ];
        $gender_a = [1 => ['1' => 'Male', '2' => 'Female'],
            2 => ['1' => 'ذكر', '2' => 'أنثى']
        ];
        $ben_id = ['html_type' => '10'];
        $gender = ['html_type' => '7', 'selectArray' => $gender_a[Auth::user()->lang_id]];
        $relation_type = ['html_type' => '5'];
        $marital_status = ['html_type' => '5', 'selectArray' => $ms[Auth::user()->lang_id]];
        $ben_desc = ['html_type' => '3', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $is_hidden = ['html_type' => '13'];
        $ind_idno = ['inputClass' => 'check-is-number'];

        $option = [
            'ben_id' => $ben_id,
            'relation_type' => $relation_type,
            'gender' => $gender,
            'marital_status' => $marital_status,
            'desc_' => $ben_desc,
            'is_hidden' => $is_hidden,
            'ind_idno' => $ind_idno
        ];

        $beneficiaryFamily = new BeneficiaryFamily();
        $beneficiaryFamily->ben_id = $beneficiary->id;
        $beneficiaryFamily->special_needs = 0;
        $generator = generator(26, $option, $beneficiaryFamily);
        $html = $generator[0];
        //$labels =$generator['1'];

        $screenName = "Add Family Individual for Beneficiary (" . ((Auth::user()->lang_id == 1) ? $beneficiary->ben_name_na : $beneficiary->ben_name_fo) . ")";
//       dd($html);
        return response(['status'=>true,'html'=>$html]);
        // return view('beneficiary.families_individuals.families.create', compact('html', 'screenName','beneficiary','id'));
    }


    public function storefm(Request $request)
    {
        is_permitted(26, getClassName(__CLASS__), __FUNCTION__, 137, 1);

        $input = $request->all();
        $data = fieldInDatabase(26, $input);

        $optionValidator = [
            'ind_idno' => [
                'unique' => 'unique:ben_families,ind_idno'
            ],
        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];
        //ben_type_id

        $beneficiaryFamily = new BeneficiaryFamily();
        $beneficiaryFamily->fill($field);
        $beneficiaryFamily->created_by = Auth::id();
        if (isset($field['special_needs'])) {
            $beneficiaryFamily->special_needs = 1;
        } else {
            $beneficiaryFamily->special_needs = 0;
        }
        $beneficiaryFamily->save();

        Log::instance()->record('2.14', null, 26, null, null, null, null);
        Log::instance()->save();

        $x = DB::table('c_relation_types')->where('id', $beneficiaryFamily->relation_type)->first();
        $beneficiaryFamily->relation_type = Auth::user()->lang_id == 1 ? $x->relation_name_na : $x->relation_name_fo;

        return response(['success' => true, 'message' => getMessage('2.42'), 'beneficiaryFamily' => $beneficiaryFamily, 'redirect' => route('beneficiary.fam_indev.getedit', $field['ben_id'])]);
    }


    public function getEditFM($id)
    {

        is_permitted(26, getClassName(__CLASS__), 'postEditFM', 72, 2);

        $beneficiaryFamily = BeneficiaryFamily::where('id', $id)->first();

        if ($beneficiaryFamily == null) {
            return back();
        }

        $ms = [
            1 => ['1' => 'Single', '2' => 'Married', '3' => 'Widowed', '4' => 'Divorced'],
            2 => ['1' => 'أعزب', '2' => 'متزوج', '3' => 'أرمل', '4' => 'مطلّق']
        ];
        $gender_a = [
            1 => ['1' => 'Male', '2' => 'Female'],
            2 => ['1' => 'ذكر', '2' => 'أنثى']
        ];
        $ben_id = ['html_type' => '10'];
        $gender = ['html_type' => '7', 'selectArray' => $gender_a[Auth::user()->lang_id]];
        $relation_type = ['html_type' => '5'];
        $marital_status = ['html_type' => '5', 'selectArray' => $ms[Auth::user()->lang_id]];
        $ben_desc = ['html_type' => '3', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $is_hidden = ['html_type' => '5', 'selectArray' => ['0' => 'Active', '1' => 'Inactive']];
        $ind_idno = ['inputClass' => 'check-is-number'];

        $option = [
            'ben_id' => $ben_id,
            'relation_type' => $relation_type,
            'gender' => $gender,
            'marital_status' => $marital_status,
            'desc_' => $ben_desc,
            'is_hidden' => $is_hidden,
            'ind_idno' => $ind_idno,
        ];

        $generator = generator(26, $option, $beneficiaryFamily);
        $html = $generator[0];
        // $labels =$generator['1'];

        $screenName = "Edit Beneficiary Familiy Individual";
        $messageDeleteBeneficiaryFam = getMessage('2.41');
//        return $html;
        return response(['status'=>true,'html'=>$html]);
        //return view('beneficiary.families_individuals.families.update', compact('html', 'screenName','beneficiary','ben_familiy_members','messageDeleteBeneficiaryFam','beneficiary'));
    }


    public function deleteFM($id)
    {
        is_permitted(26, getClassName(__CLASS__), __FUNCTION__, 74, 4);

        try {
//            $ActuallyTargetedBeneficiaries = ActuallyTargetedBeneficiaries::where('beneficiaries_all_vw_id', $id)
//                ->where('beneficiaries_all_vw_type', 1)
//                ->get()->count();
//            if ($ActuallyTargetedBeneficiaries > 0) {
//                $message = getMessage('2.198');
//                return response(['status' => 'false', 'message' => $message]);
//            }
            $beneficiary = Beneficiary::where('id', $id)->first();
           if(!empty($beneficiary)){
            $activity_beneficiaries = ActivityBeneficiaries::where('ben_id', $beneficiary->id)
                ->where('ben_type_id', $beneficiary->ben_type_id)
                ->get()
                ->count();
            if ($activity_beneficiaries> 0) {
                $message = getMessage('2.109');
                return response(['status' => 'false', 'message' => $message]);
            }

            else {
                $beneficiaryFamily = BeneficiaryFamily::where('id', $id)->first();
                $beneficiaryFamily->deleted_by = Auth::id();
                $beneficiaryFamily->save();
                $beneficiaryFamily->delete();
                $message = getMessage('2.43');
//                Log::instance()->record('2.16', $id, 26, null, null, null, null);
//                Log::instance()->save();
                return response(['status' => 'true', 'message' => $message]);
            }}
           else{
               $beneficiaryFamily = BeneficiaryFamily::where('id', $id)->first();
               $beneficiaryFamily->deleted_by = Auth::id();
               $beneficiaryFamily->save();
               $beneficiaryFamily->delete();
               $message = getMessage('2.43');
//                Log::instance()->record('2.16', $id, 26, null, null, null, null);
//                Log::instance()->save();
               return response(['status' => 'true', 'message' => $message]);
           }
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.198');
            return response(['status' => 'false', 'message' => $message]);
        }
    }

    public function delete($id)
    {
        is_permitted(25, getClassName(__CLASS__), __FUNCTION__, 73, 4);

        try {
            $beneficiary = Beneficiary::where('id', $id)->first();
            $activity_beneficiaries = ActivityBeneficiaries::where('ben_id', $beneficiary->id)
                ->where('ben_type_id', $beneficiary->ben_type_id)
                ->get()
                ->count();
            if ($activity_beneficiaries> 0) {
                $message = getMessage('2.109');
                return response(['status' => 'false', 'message' => $message]);
            }
            $beneficiary->deleted_by = Auth::id();
            $beneficiary->save();
            $beneficiary->delete();
            Log::instance()->record('2.13', $id, 25, null, null, null, null);
            Log::instance()->save();
            $message = getMessage('2.45');
            return response(['status' => 'true', 'message' => $message]);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.24');
            return response(['status' => 'false', 'message' => $message]);
        }
    }


    public function postEditFM(Request $request)
    {
        is_permitted(26, getClassName(__CLASS__), __FUNCTION__, 72, 2);

        $input = $request->all();
        $data = fieldInDatabase(26, $input);
        $field = $data['field'];
        $optionValidator = [
            'ind_idno' => [
                'unique' => 'unique:ben_families,ind_idno,' . $field['id']
            ],
        ];

        inputValidator($data, $optionValidator);

        $field = $data['field'];

        if ($request->get('id') != null) {
            $beneficiaryFamily = BeneficiaryFamily::find($request->get('id'));
            Log::instance()->record('2.15', $field['id'], 26, null, null, $field, $beneficiaryFamily);
            $beneficiaryFamily->fill($field);
            $beneficiaryFamily->updated_by = Auth::id();
            if (isset($field['special_needs'])) {

                $beneficiaryFamily->special_needs = 1;
            } else {
                $beneficiaryFamily->special_needs = 0;
            }
            Log::instance()->save();
            $beneficiaryFamily->save();
            $message = getMessage('2.44');
        }

        return response(['success' => true, 'message' => $message,'beneficiaryFamily'=>$beneficiaryFamily]);
    }

    public function reportBeneficiary()
    {
        is_permitted(110, 'BeneficiaryFamIndvController', 'report', 225, 10);
        $BeneficiaryFamily = new BeneficiaryFamily();
        $ben_type_id = ['attr' => ' data-live-search="true" '];
        $ben_name_na = [];
        $ben_name_fo = [];
        $ben_idno = [];
        $gender = ['selectArray' => ['1' => 'Male', '2' => 'Female']];
        $marital_status = ['selectArray' => ['1' => 'single', '2' => 'Married', '3' => 'Widowed', '4' => 'Absolute']];
        $ben_city = ['attr' => ' data-live-search="true" '];
        $no_of_family = [];
        $is_hidden = ['selectArray' => ['0' => 'Active', '1' => 'UnActive']];
        // $act_budget_max = ['col_all_Class' => 'col-md-3', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-5'];

        $option = [
            'ben_type_id' => $ben_type_id,
            'ben_name_na' => $ben_name_na,
            'ben_name_fo' => $ben_name_fo,
            'ben_idno' => $ben_idno,
            'gender' => $gender,
            'marital_status' => $marital_status,
            'ben_city' => $ben_city,
            'no_of_family' => $no_of_family,
            'is_hidden' => $is_hidden,
        ];
        $generator = generator(54, $option, $BeneficiaryFamily);
        $html = $generator[0];
        $labels = $generator[1];
        $id = 'report_families_individuals';
        $userPermissions = getUserPermission();

        return view('beneficiary.report.reportBeneficiary', compact('id', 'html', 'labels', 'userPermissions'));
    }

    public function search(Request $request)
    {

        $input = $request->all();
        $rep_master_id = 5;
        $report_master = ReportMaster::find($rep_master_id);
        if ($report_master == null) {
            return redirect()->route('home');
        }
        $reportMasterUser = ReportMasterUser::where('rep_master_id', $rep_master_id)
            ->where('user_id', Auth::id())
            ->first();

        $reportDetailColumnsNames = DB::table('global_report_detail_users')
            ->join('global_report_details', 'global_report_details.rep_detail_id', '=', 'global_report_detail_users.rep_detail_id')
            ->where(['global_report_detail_users.rep_master_id' => $rep_master_id, 'global_report_detail_users.user_id' => Auth::id()])
            ->orderBy('global_report_detail_users.column_order', 'asc')
            ->pluck('global_report_details.column_name');

        $reportDetailUser = DB::table('global_report_detail_users')
            ->select('global_report_details.column_name', 'global_report_details.column_data_type', 'global_report_detail_users.rep_detail_id', 'global_report_detail_users.rep_master_id',
                'global_report_detail_users.user_id', 'global_report_detail_users.column_label', 'global_report_detail_users.column_order', 'global_report_detail_users.column_width',
                'global_report_detail_users.column_aggregation', 'global_report_detail_users.column_alignment')
            ->join('global_report_details', 'global_report_details.rep_detail_id', '=', 'global_report_detail_users.rep_detail_id')
            ->where(['global_report_detail_users.rep_master_id' => $rep_master_id, 'global_report_detail_users.user_id' => Auth::id()])
            ->orderBy('global_report_detail_users.column_order', 'asc')
            ->get();

        $reportDetailColumnsNames = array_values((array)$reportDetailColumnsNames)[0];

        if ($reportDetailColumnsNames) {
            foreach ($reportDetailUser as $x) {
                $y = DB::table($report_master->rep_source)->pluck($x->column_name);
                $x->values = array_values((array)$y)[0];
            }
            $query = ReportBeneficiary::query();
            $query->select($reportDetailColumnsNames);
            if ($request->has('ben_type_id') && $request->get('ben_type_id') != null) {
                $query->where('ben_type_id', $input['ben_type_id']);
            }
            if ($request->has('is_hidden') && $request->get('is_hidden') != null) {
                $query->where('is_hidden', '=', $input['is_hidden']);
            }
            if ($request->has('ben_name_na') && $request->get('ben_name_na') != null) {
                $query->where('ben_name_na', 'like', '%' . $input['ben_name_na'] . '%');
            }
            if ($request->has('ben_name_fo') && $request->get('ben_name_fo') != null) {
                $query->where('ben_name_fo', 'like', '%' . $input['ben_name_fo'] . '%');
            }
            if ($request->has('ben_idno') && $request->get('ben_idno') != null) {
                $query->where('ben_idno', $input['ben_idno']);
            }
            if ($request->has('gender') && $request->get('gender') != null) {
                $query->where('gender', $input['gender']);
            }
            if ($request->has('donor_id') && $request->get('donor_id') != null) {
                $query->where('donor_id', $input['donor_id']);
            }
            if ($request->has('marital_status') && $request->get('marital_status') != null) {
                $query->where('marital_status', $input['marital_status']);
            }
            if ($request->has('ben_city') && $request->get('ben_city') != null) {
                $query->where('ben_city', $input['ben_city']);
            }
            if ($request->has('no_of_family') && $request->get('no_of_family') != null) {
                $query->where('no_of_family', $input['no_of_family']);
            }

            $report_data = $query->get();
            $userPermissions = getUserPermission();

            return view('report.modal.report_table', compact('report_master', 'reportMasterUser', 'reportDetailUser', 'reportDetailColumnsNames', 'report_data', 'userPermissions'));
        } else {
            $message = getMessage('2.82');
            return response(['status' => 'false', 'message' => $message]);
        }


    }

    public function reportExportExcel(Request $request)
    {

        $reportMasterUser = ReportMasterUser::where('rep_master_id', 5)
            ->where('user_id', Auth::id())
            ->first();
        return \Maatwebsite\Excel\Facades\Excel::download(new BeneficiaryFamiliesReportExportExcel(5, $request), $reportMasterUser->rep_label . '.xlsx');
    }

    public function reportExportPDF(Request $request)
    {
        // return pdfDataExport($rep_master_id);
        $rep_master_id = 5;
        $report_master = ReportMaster::find($rep_master_id);
        if ($report_master == null) {
            return redirect()->route('home');
        }
        //dd($report_master);
        $input = $request->all();
        $reportMasterUser = ReportMasterUser::where('rep_master_id', $rep_master_id)
            ->where('user_id', Auth::id())
            ->first();
        //dd($reportMasterUser);
        $rep_orientation = rep_orientation($reportMasterUser)[1];
        $dir = rep_orientation($reportMasterUser)[0];
        // dd($page_width ,$rep_orientation);
        $reportDetailUser = DB::table('global_report_detail_users')
            ->select('global_report_details.column_name',
                'global_report_details.column_data_type',
                'global_report_detail_users.rep_detail_id',
                'global_report_detail_users.rep_master_id',
                'global_report_detail_users.user_id',
                'global_report_detail_users.column_label',
                'global_report_detail_users.column_order',
                'global_report_detail_users.column_width',
                'global_report_detail_users.column_aggregation',
                'global_report_detail_users.column_alignment')
            ->join('global_report_details', 'global_report_details.rep_detail_id', '=', 'global_report_detail_users.rep_detail_id')
            ->where(['global_report_detail_users.rep_master_id' => $rep_master_id, 'global_report_detail_users.user_id' => Auth::id()])
            ->where('global_report_detail_users.column_width', '!=', '0')
            ->orderBy('global_report_detail_users.column_order', 'asc')
            ->get();

        if ($reportDetailUser->count() <= 0) {
            $message = getMessage('2.81');
            return $message['text'];
        }

        $reportDetailColumnsAlign = column_alignment($reportDetailUser);
        $reportDetailColumnsWidth = $reportDetailUser->pluck('column_width', 'column_name')->toArray();

        $reportDetailColumnsNames = $reportDetailUser->pluck('column_name')->toArray();
        $reportDetailColumnsLabels = $reportDetailUser->pluck('column_label')->toArray();
        //dd($reportDetailColumnsNames);
        $reportDetailColumnsAggregationSum = $reportDetailUser->where('column_aggregation', '0')
            ->pluck('column_name')
            ->toArray();
        $reportDetailColumnsAggregationCount = $reportDetailUser->where('column_aggregation', '1')
            ->pluck('column_name')
            ->toArray();
        // dd($reportDetailColumnsAggregation);

//        dd($request->get('project_id'));
        $query = ReportBeneficiary::query();
        $query->select($reportDetailColumnsNames);

        if ($request->has('ben_type_id') && $request->get('ben_type_id') != null) {
            $query->where('ben_type_id', $input['ben_type_id']);
        }
        if ($request->has('is_hidden') && $request->get('is_hidden') != null) {
            $query->where('is_hidden', '=', $input['is_hidden']);
        }
        if ($request->has('ben_name_na') && $request->get('ben_name_na') != null) {
            $query->where('ben_name_na', 'like', '%' . $input['ben_name_na'] . '%');
        }
        if ($request->has('ben_name_fo') && $request->get('ben_name_fo') != null) {
            $query->where('ben_name_fo', 'like', '%' . $input['ben_name_fo'] . '%');
        }
        if ($request->has('ben_idno') && $request->get('ben_idno') != null) {
            $query->where('ben_idno', $input['ben_idno']);
        }
        if ($request->has('gender') && $request->get('gender') != null) {
            $query->where('gender', $input['gender']);
        }
        if ($request->has('donor_id') && $request->get('donor_id') != null) {
            $query->where('donor_id', $input['donor_id']);
        }
        if ($request->has('marital_status') && $request->get('marital_status') != null) {
            $query->where('marital_status', $input['marital_status']);
        }
        if ($request->has('ben_city') && $request->get('ben_city') != null) {
            $query->where('ben_city', $input['ben_city']);
        }
        if ($request->has('no_of_family') && $request->get('no_of_family') != null) {
            $query->where('no_of_family', $input['no_of_family']);
        }
        $report_data = $query->get();
        //dd($report_data);

        $pdf = Pdf::loadView('report.pdfDataExport',
            [
                'reportDetailColumnsAlign' => $reportDetailColumnsAlign,
                'reportDetailColumnsWidth' => $reportDetailColumnsWidth,
                'reportDetailColumnsLabels' => $reportDetailColumnsLabels,
                'reportDetailColumnsNames' => $reportDetailColumnsNames,
                'report_data' => $report_data,
                'reportMasterUser' => $reportMasterUser,
                'reportDetailColumnsAggregationSum' => $reportDetailColumnsAggregationSum,
                'reportDetailColumnsAggregationCount' => $reportDetailColumnsAggregationCount,
                'dir' => $dir,
            ], [],
            [
                'format' => $rep_orientation,
                'mode' => 'utf-8',
                'margin_top' => $reportMasterUser->margin_top,
                'margin_left' => $reportMasterUser->margin_left,
                'margin_button' => $reportMasterUser->margin_top,
                'margin_right' => $reportMasterUser->margin_left,
            ]
        );
        //return $pdf->download('document.pdf');

        return $pdf->stream($reportMasterUser->rep_label . '.pdf');
    }


    public function settings()
    {
        $customFields = CustomField::where('table_name', 'beneficiary')->get();

        $customFieldTypes = FieldTypeUser::all();

        $labels = inputButton(Auth::user()->lang_id, 25);
        $userPermissions = getUserPermission();

        return view('beneficiary.families_individuals.settings', compact('customFields', 'customFieldTypes', 'labels', 'userPermissions'));
    }


    public function updateCustomFieldsSettings(Request $request)
    {
        $input = $request->all();

        if (!empty($input['custom_fields_count']) && $input['custom_fields_count'] > 0) {
            $cf = CustomField::where('table_name', 'beneficiary')->get();
            foreach ($cf as $c) {
                $c->customFieldOptions()->delete();
                $c->delete();
            }
            for ($i = 1; $i <= $input['custom_fields_count']; $i++) {
                $customField = new CustomField();
                $customField->table_name = 'beneficiary';
                $customField->field_type = $input['custom_field_type_' . $i];
                $customField->field_name = $input['custom_field_name_' . $i];
                $customField->field_label_name_na = $input['custom_field_label_na_' . $i];
                $customField->field_label_name_fo = $input['custom_field_label_fo_' . $i];
                $customField->save();

                if (!empty($input['custom_field_' . $i . '_options_count']) && $input['custom_field_' . $i . '_options_count'] > 0) {
                    if (is_array($input['custom_field_' . $i . '_option_label_na']) &&
                        is_array($input['custom_field_' . $i . '_option_label_fo']) &&
                        is_array($input['custom_field_' . $i . '_option_value'])) {
                        for ($a = 0; $a < $input['custom_field_' . $i . '_options_count']; $a++) {
                            $customFieldOption = new CustomFieldSelectOption();
                            $customFieldOption->custom_field_id = $customField->id;
                            $customFieldOption->option_name_na = $input['custom_field_' . $i . '_option_label_na'][$a];
                            $customFieldOption->option_name_fo = $input['custom_field_' . $i . '_option_label_fo'][$a];
                            $customFieldOption->option_value = $input['custom_field_' . $i . '_option_value'][$a];
                            $customFieldOption->save();
                        }
                    }
                }
            }

            return response(["success" => true, "message" => getMessage('2.159')]);
        }
    }

    public function getDistanceByCityId($city_id)
    {
        if (Auth::user()->lang_id == 1) {
            $distance = District::where('city_id', $city_id)
                ->where('is_hidden', '0')
                ->where('deleted_at', null)
                ->pluck('district_name_no', 'id');
        } else {
            $distance = District::where('city_id', $city_id)
                ->where('is_hidden', '0')
                ->where('deleted_at', null)
                ->pluck('district_name_fo', 'id');
        }
        return response($distance);
    }

    public function importCreate()
    {
        $userPermissions = getUserPermission();
        $labels = inputButton(Auth::user()->lang_id, 0);
        return view('beneficiary.families_individuals.importForm', compact('userPermissions', 'labels'));

    }

    public function importStore()
    {
        request()->validate([
            'file' => 'required',
        ]);

        if (request()->hasFile('file')) {

            $extension = File::extension(request()->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                Excel::import(new Imports\BeneficiaryImport(), request()->file('file'));

                return redirect()->route("beneficiary.fam_indev.index")->with('success', 'All good!');
            } else {
                return back()->with('success', $validate_files['errors']);
            }
        }


    }
//    public function importStore(Request $request){
//
//        $this->validate($request, array(
//            'file'      => 'required'
//        ));
//
//
//        if($request->hasFile('file')){
//            dd(123);
//            $extension = File::extension($request->file->getClientOriginalName());
//            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
//
//                $path = $request->file->getRealPath();
//                $data = Excel::load($path, function($reader) {
//                })->get();
//                dd($data);
//                if(!empty($data) && $data->count()){
//
//                    foreach ($data as $key => $value) {
//                        $insert[] = [
//                            'name' => $value->name,
//                            'email' => $value->email,
//                            'phone' => $value->phone,
//                        ];
//                    }
//
//                    if(!empty($insert)){
//
//                        $insertData = DB::table('students')->insert($insert);
//                        if ($insertData) {
//                            Session::flash('success', 'Your Data has successfully imported');
//                        }else {
//                            Session::flash('error', 'Error inserting the data..');
//                            return back();
//                        }
//                    }
//                }
//
//                return back();
//
//            }else {
//                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
//                return back();
//            }
//        }
//    }

}