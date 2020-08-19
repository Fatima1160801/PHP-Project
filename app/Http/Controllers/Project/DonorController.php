<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Report\ProjectDonorReportExportExcel;
use App\Models\Donor\DonorContact;
use App\Models\Donor\FocalPoint;
use App\Models\Project\Project;
use App\Models\Report\Project\ReportProjectDonor;
use App\Models\Report\ReportMaster;
use App\Models\Report\ReportMasterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Donor\Donor;
use App\Models\Donor\DonorType;
use App\Models\Project\ProjectDonors;
use DB;
use App\Helpers\Log;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\File;

class DonorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        is_permitted('6', 'DonorController', 'index', '22', '7');

        $donors = Donor::get();
        $types = DonorType::where('is_hidden', '0')->get();
        $messageDeleteDonor = getMessage('2.51');
        $labels = inputButton(Auth::user()->lang_id, 44);
        $userPermissions = getUserPermission();
        $screenName = screenName(6);
        return view('project.donors.index', compact('labels', 'donors', 'types', 'screenName', 'messageDeleteDonor','userPermissions'));
    }

    public function donorWizard($id = null)
    {
        $donor = $this->create($id);
        $contacts = null;
        $contacts = $this->indexContacts($id);
        $focalPoint = FocalPoint::where('donor_id', $id)->get();
        $focalPoint_html = $this->focalPoint($id);
        $messageDeleteDonorContact = getMessage('2.53');
        $messageDeleteContact = getMessage('2.51');
        $labels = inputButton(Auth::user()->lang_id, 6);
        $userPermissions = getUserPermission();

        return view('project.donors.donorWizard', compact('labels', 'donor', 'contacts', 'messageDeleteContact', 'messageDeleteDonorContact', 'focalPoint', 'focalPoint_html','userPermissions'));
    }

    public function focalPoint($id)
    {
        $focalPoint = FocalPoint::where('donor_id', $id)->get();
        $labels = inputButton(Auth::user()->lang_id, 6);
        $userPermissions = getUserPermission();

        return view('project.donors.focalPoint', compact('labels', 'focalPoint','userPermissions'));
    }

    public function create($id)
    {

        is_permitted('6', 'DonorController', 'update', '24', '2');
        if ($id) {
            $donor = Donor::find($id);
            $is_hidden = ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8', 'selectArray' => ['0' => 'Active', '1' => 'Inactive']];

        } else {
            $donor = new Donor();
            $is_hidden = ['html_type' => '13'];

        }
        $donor_name_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $donor_name_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $donor_address_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $donor_address_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $donor_mobile_no = ['inputClass' => 'check-is-number', 'col_all_Class' => 'col-md-4', 'col_label_Class' => 'col-md-6', 'col_input_Class' => 'col-md-6'];
        $donor_tel_no = ['inputClass' => 'check-is-number', 'col_all_Class' => 'col-md-4', 'col_label_Class' => 'col-md-5', 'col_input_Class' => 'col-md-7'];
        $donor_fax_no = ['inputClass' => 'check-is-number', 'col_all_Class' => 'col-md-4', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];
        $donor_email = ['inputClass' => 'noArabic', 'col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];
        $donor_url = ['inputClass' => 'noArabic', 'col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];
        $contact_person_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $contact_person_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $contact_mobile = ['inputClass' => 'check-is-number', 'col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];
        $contact_email = ['inputClass' => 'noArabic', 'col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];
        $contact_job_title = ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];
        $donor_type_id = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10',
            'attr' => ' data-live-search="true" '
            , 'relatedWhere' => 'is_hidden != 1'];
        $id_html = ['html_type' => '10'];
        $focal_staff_id = ['attr' => ' data-live-search="true" '];
        $option = [
            'donor_name_na' => $donor_name_na,
            'donor_name_fo' => $donor_name_fo,
            'donor_type_id' => $donor_type_id,
            'donor_address_na' => $donor_address_na,
            'donor_address_fo' => $donor_address_fo,
            'donor_mobile_no' => $donor_mobile_no,
            'donor_tel_no' => $donor_tel_no,
            'donor_fax_no' => $donor_fax_no,
            'donor_email' => $donor_email,
            'donor_url' => $donor_url,
            'contact_person_na' => $contact_person_na,
            'contact_person_fo' => $contact_person_fo,
            'contact_mobile' => $contact_mobile,
            'contact_email' => $contact_email,
            'contact_job_title' => $contact_job_title,
            'is_hidden' => $is_hidden,
            'id' => $id_html,
            'focal_staff_id' => $focal_staff_id,
            'type' => ['selectArray' => ['0'=>'Funder','1'=>'Partner']] ,
        ];

        $generator = generator(6, $option, $donor);
        $html = $generator[0];
        $labels = $generator[1];

        $screenName = screenName(6);
        $userPermissions = getUserPermission();

        return view('project.donors.edit', compact('html', 'screenName', 'data', 'labels','userPermissions'));
    }

    public function store(Request $request)
    {

         if ($request->has('id') && $request->get('id') != null) {
            is_permitted('6', 'DonorController', 'update', '24', '2');
            $input = $request->all();
            $data = fieldInDatabase(6, $input);
            $field = $data['field'];
            $id = $input['id'];
            $optionValidator = [
                'donor_name_na' => [
                    'unique' => 'unique:donors,donor_name_na,' . $id
                ],

                'donor_name_fo' => [
                    'unique' => 'unique:donors,donor_name_fo,' . $id
                ],

                'donor_mobile_no' => [
                    'Numeric' => 'Numeric',
                    'nullable' => 'nullable',
                    'integer' => 'false',
                    'max' => 'false',
                    'digits_between' => 'digits_between:0,15'
                ],

                'donor_tel_no' => [
                    'Numeric' => 'Numeric',
                    'nullable' => 'nullable',
                    'integer' => 'false',
                    'max' => 'false',
                    'digits_between' => 'digits_between:0,15'

                ],

                'donor_fax_no' => [
                    'Numeric' => 'Numeric',
                    'nullable' => 'nullable',
                    'integer' => 'false',
                    'max' => 'false',
                    'digits_between' => 'digits_between:0,15'
                ],

                'donor_email' => [
                    'email' => 'email',
                    'nullable' => 'nullable'
                ],

                'contact_mobile' => [
                    'Numeric' => 'Numeric',
                    'nullable' => 'nullable',
                    'string' => 'false',
                    'max' => 'false',
                    'digits_between' => 'digits_between:0,15'
                ],

                'contact_email' => [
                    'email' => 'email',
                    'nullable' => 'nullable'
                ],
                'focal_staff_id' => [
                    'integer' => 'false',
                   // 'required' => 'required',
                    'digits_between' => 'false',
                    'nullable' => 'nullable'
                ],
                'donor_logo' => [
                    'image' => 'image',
                    'max' => 'max:1500',
                    'mimes' => 'mimes:jpeg,png,jpg,gif,svg'
                ]
            ];
            inputValidator($data, $optionValidator);

            $donor = Donor::find($id);


            if (isset($donor->focal_staff_id) and isset($field['focal_staff_id'])) {
                if ($donor->focal_staff_id != $field['focal_staff_id']) {
                    $FocalPoint_old = FocalPoint::where('staff_id', $donor->focal_staff_id)
                        ->whereNull('end_date')
                        ->first();
                    if ($FocalPoint_old) {
                        $FocalPoint_old->end_date = date('Y-m-d H:i:s');
                        $FocalPoint_old->save();
                    }
                    $FocalPoint = new FocalPoint();
                    $FocalPoint->donor_id = $donor->id;
                    $FocalPoint->staff_id = $field['focal_staff_id'];
                    $FocalPoint->start_date = date('Y-m-d H:i:s');
                    $FocalPoint->end_date = null;
                    $FocalPoint->updated_by = Auth::id();
                    $FocalPoint->save();
                }
            } else {
                $FocalPoint = new FocalPoint();
                $FocalPoint->donor_id = $donor->id;
                $FocalPoint->staff_id = $field['focal_staff_id'];
                $FocalPoint->start_date = date('Y-m-d H:i:s');
                $FocalPoint->end_date = null;
                $FocalPoint->created_by = Auth::id();
                $FocalPoint->save();
            }
            Log::instance()->record('2.63', $donor->id, 6, null, null, $field, $donor);
            Log::instance()->save();

            $donor->fill($field);
            $path = public_path('images/user/photo/');
            if ($request->has('donor_logo')) {
                 $imageName = time() . '.' . $request->file('donor_logo')->getClientOriginalExtension();
                $request->file('donor_logo')->move($path, $imageName);
                $donor->donor_logo  = $imageName;
            }

//
//            $path = public_path('images/user/photo/');
//            if ($request->has('donor_logo')) {
//                $imageName = time() . '.' . $request->file('donor_logo')->getClientOriginalExtension();
//                $request->file('donor_logo')->move($path, $imageName);
//                $fieldName = $imageName;
//            }

            $donor->updated_by = Auth::id();
            $donor->save();
            notifications(getClassName(__CLASS__), __FUNCTION__, route('project.donors.edit', $donor->id));
            $array = getMessage('2.2');
//            dd(['status' => 'true', 'donor' => $donor,'message' => $array]);
            return response(['status' => 'true', 'donor' => $donor, 'message' => $array]);

        } else {

            is_permitted('6', 'DonorController', 'store', '23', '1');

            $input = $request->all();
            $data = fieldInDatabase(6, $input);

            $optionValidator = [
                'donor_name_na' => [
                    'unique' => 'unique:donors,donor_name_na'
                ],
                'donor_name_fo' => [
                    'unique' => 'unique:donors,donor_name_fo'
                ],
                'donor_mobile_no' => [
                    'Numeric' => 'Numeric',
                    'nullable' => 'nullable',
                    'string' => 'false',
                    'max' => 'false',
                    'digits_between' => 'digits_between:0,15'
                ],

                'donor_tel_no' => [
                    'Numeric' => 'Numeric',
                    'nullable' => 'nullable',
                    'string' => 'false',
                    'max' => 'false',
                    'digits_between' => 'digits_between:0,15'

                ],

                'donor_fax_no' => [
                    'Numeric' => 'Numeric',
                    'nullable' => 'nullable',
                    'string' => 'false',
                    'max' => 'false',
                    'digits_between' => 'digits_between:0,15'
                ],
                'donor_email' => [
                    'email' => 'email',
                    'nullable' => 'nullable'
                ],

                'contact_mobile' => [
                    'Numeric' => 'Numeric',
                    'nullable' => 'nullable',
                    'string' => 'false',
                    'max' => 'false',
                    'digits_between' => 'digits_between:0,15'
                ],

                'contact_email' => [
                    'email' => 'email',
                    'nullable' => 'nullable'
                ],
                'focal_staff_id' => [
                    'integer' => 'false',
                    'digits_between' => 'false',
                    'nullable' => 'nullable'
                ],
            ];
            inputValidator($data, $optionValidator);
            $field = $data['field'];
            $donor = new Donor();
            $donor->fill($field);
            $path = public_path('images/user/photo/');
            if ($request->has('donor_logo')) {
                $imageName = time() . '.' . $request->file('donor_logo')->getClientOriginalExtension();
                $request->file('donor_logo')->move($path, $imageName);
                $donor->donor_logo = $imageName;
            }
            $donor->created_by = Auth::id();

            $donor->save();
            $FocalPoint = new FocalPoint();
            $FocalPoint->donor_id = $donor->id;
            $FocalPoint->staff_id = $field['focal_staff_id'];
            $FocalPoint->start_date = date('Y-m-d H:i:s');
            $FocalPoint->end_date = null;
            $FocalPoint->created_by = Auth::id();
            $FocalPoint->save();

            Log::instance()->record('2.62', null, 6, null, null, null, null);
            Log::instance()->save();

            notifications(getClassName(__CLASS__), __FUNCTION__, route('project.donors.edit', $donor->id));

            $array = getMessage('2.1');
            //   session(['array' => $array]);
//        return redirect()->route('project.donors.index');

            return response(['status' => 'true', 'donor' => $donor, 'message' => $array]);
        }
    }


    public function destroy($id)
    {
        is_permitted('6', 'DonorController', 'destroy', '25', '4');

        $donor = Donor::find($id);

        $project_donor = ProjectDonors::Where('donor_id', $id)->first();
        if (!empty($project_donor)) {
            $array = getMessage('2.52');
            return response(['status' => 'false', 'message' => $array]);
        } else {
            $donor->deleted_by = Auth::id();
            $donor->save();
            $donor->delete();
            Log::instance()->record('2.64', $id, 6, null, null, null, null);
            Log::instance()->save();
            notifications(getClassName(__CLASS__), __FUNCTION__, '');
            $array = getMessage('2.3');
            return response(['status' => 'true', 'message' => $array]);
        }
    }

    public function indexContacts($donor_id = null)
    {
        $donors = null;
        if ($donor_id != null) {
            $donors = DonorContact::where('donor_id', $donor_id)
                ->get();
        }
        $labels = inputButton(Auth::user()->lang_id, 6);
        $userPermissions = getUserPermission();

        return view('project.donors.contact.index', compact('labels', 'donors','userPermissions'));
    }

    public function reportProject()
    {

        $donors = Donor::pluck('donor_name_'.lang_character(), 'id')->toArray();
         $project = new Project();
        $project->act_budget_min = null;
        //$program_id = ['attr' => ' data-live-search="true" ', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        // $is_hidden = ['selectArray' => ['0' => 'Active', '1' => 'UnActive']];
        $donor_id = ['selectArray' => $donors, 'attr' => ' data-live-search="true" ', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];

        //  $manager_id = ['attr' => ' data-live-search="true" '];
        //  $coordinator_id = ['attr' => ' data-live-search="true" ', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        //  $category_id = ['attr' => ' data-live-search="true" ', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        //   $act_budget_min = ['col_all_Class' => 'col-md-3', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-5'];
        //   $act_budget_max = ['col_all_Class' => 'col-md-3', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-5'];

        $act_budget_min = ['html_type' => '13'];
        $act_budget_max = ['html_type' => '13'];
        $plan_start_date = ['html_type' => '13'];
        $plan_end_date = ['html_type' => '13'];
        $program_id = ['html_type' => '13'];
        $manager_id = ['html_type' => '13'];
        $coordinator_id = ['html_type' => '13'];
        $project_name_na = ['html_type' => '13'];
        $project_name_fo = ['html_type' => '13'];
        $is_hidden = ['html_type' => '13'];
        $category_id = ['html_type' => '13'];

        $option = [
            'program_id' => $program_id,
            'is_hidden' => $is_hidden,
            'manager_id' => $manager_id,
            'coordinator_id' => $coordinator_id,
            'donor_id' => $donor_id,
            'act_budget_min' => $act_budget_min,
            'act_budget_max' => $act_budget_max,
            'project_name_na' => $project_name_na,
            'project_name_fo' => $project_name_fo,
            'plan_start_date' => $plan_start_date,
            'plan_end_date' => $plan_end_date,
            'category_id' => $category_id,
        ];
        $generator = generator(61, $option, $project);
        $html = $generator[0];
        // dd($html);
        $labels = $generator[1];
        $id = 'reports_project_by_Donate';
        $userPermissions = getUserPermission();

        return view('project.donors.report.reportDonorProject', compact('id', 'html', 'labels','userPermissions'));
    }

    public function search(Request $request)
    {

        $input = $request->all();
        $rep_master_id = 10;
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
            $query = ReportProjectDonor::query();
            $query->select($reportDetailColumnsNames);
            if ($request->has('program_id') && $request->get('program_id') != null) {
                $query->whereIn('program_id', $input['program_id']);
            }
            if ($request->has('is_hidden') && $request->get('is_hidden') != null) {
                $query->where('is_hidden', '=', $input['is_hidden']);
            }
            if ($request->has('project_name_na') && $request->get('project_name_na') != null) {
                $query->where('project_name_na', 'like', '%' . $input['project_name_na'] . '%');
            }
            if ($request->has('project_name_fo') && $request->get('project_name_fo') != null) {
                $query->where('project_name_fo', 'like', '%' . $input['project_name_fo'] . '%');
            }
            if ($request->has('plan_start_date') && $request->get('plan_start_date') != null) {
                $query->whereDate('plan_start_date', '>=', dateFormatDataBase($input['plan_start_date']));
            }
            if ($request->has('plan_end_date') && $request->get('plan_end_date') != null) {
                $query->whereDate('plan_end_date', '>=', dateFormatDataBase($input['plan_end_date']));
            }
            if ($request->has('manager_id') && $request->get('manager_id') != null) {
                $query->where('manager_id', $input['manager_id']);
            }
            if ($request->has('coordinator_id') && $request->get('coordinator_id') != null) {
                $query->where('coordinator_id', $input['coordinator_id']);
            }
            if ($request->has('donor_id') && $request->get('donor_id') != null) {
                $query->where('donor_id', $input['donor_id']);
            }
            if ($request->has('category_id') && $request->get('category_id') != null) {
                $query->where('category_id', $input['category_id']);
            }
            if ($request->has('act_budget_min') && $request->get('act_budget_min') != null
                && $request->has('act_budget_max') && $request->get('act_budget_max') != null) {
                $query->whereBetween('act_budget', [$input['act_budget_min'], $input['act_budget_max']]);
            } elseif ($request->has('act_budget_min') && $request->get('act_budget_min') != null) {
                $query->where('act_budget', '>=', $input['act_budget_min']);
            } elseif ($request->has('act_budget_max') && $request->get('act_budget_max') != null) {
                $query->where('act_budget', '<=', $input['act_budget_max']);
            }
            $report_data = $query->get();
            $userPermissions = getUserPermission();
            return view('report.modal.report_table', compact('report_master', 'reportMasterUser', 'reportDetailUser', 'reportDetailColumnsNames', 'report_data','userPermissions'));
        } else {
            $message = getMessage('2.82');
            return response(['status' => 'false', 'message' => $message]);
        }


    }

    public function reportExportExcel(Request $request)
    {
        $rep_master_id = 10;
        $reportMasterUser = ReportMasterUser::where('rep_master_id', $rep_master_id)
            ->where('user_id', Auth::id())
            ->first();
        return \Maatwebsite\Excel\Facades\Excel::download(new ProjectDonorReportExportExcel($rep_master_id, $request), $reportMasterUser->rep_label . '.xlsx');
    }

    public function reportExportPDF(Request $request)
    {
        // return pdfDataExport($rep_master_id);
        $rep_master_id = 10;
        $report_master = ReportMaster::find($rep_master_id);
        if ($report_master == null) {
            return redirect()->route('home');
        }
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

        $query = ReportProjectDonor::query();
        $query->select($reportDetailColumnsNames);
//        dd($request->get('is_hidden'));
        if ($request->has('program_id') && $request->get('program_id') != null) {
            $query->whereIn('program_id', $request->get('program_id'));
        }
        if ($request->has('is_hidden') && $request->get('is_hidden') != null) {
            $query->where('is_hidden', '=', $request->get('is_hidden'));
        }
        if ($request->has('project_name_na') && $request->get('project_name_na') != null) {
            $query->where('project_name_na', 'like', '%' . $request->get('project_name_na') . '%');
        }
        if ($request->has('project_name_fo') && $request->get('project_name_fo') != null) {
            $query->where('project_name_fo', 'like', '%' . $request->get('project_name_fo') . '%');
        }
        if ($request->has('plan_start_date') && $request->get('plan_start_date') != null) {
            $query->whereDate('plan_start_date', '>=', dateFormatDataBase($request->get('plan_start_date')));
        }
        if ($request->has('plan_end_date') && $request->get('plan_end_date') != null) {
            $query->whereDate('plan_end_date', '>=', dateFormatDataBase($request->get('plan_end_date')));
        }
        if ($request->has('manager_id') && $request->get('manager_id') != null) {
            $query->where('manager_id', $request->get('manager_id'));
        }
        if ($request->has('category_id') && $request->get('category_id') != null) {
            $query->where('category_id', $request->get('category_id'));
        }
        if ($request->has('coordinator_id') && $request->get('coordinator_id') != null) {
            $query->where('coordinator_id', $request->get('coordinator_id'));
        }
        if ($request->has('donor_id') && $request->get('donor_id') != null) {
            $query->where('donor_id', $request->get('donor_id'));
        }

        if ($request->has('act_budget_min') && $request->get('act_budget_min') != null
            && $request->has('act_budget_max') && $request->get('act_budget_max') != null) {
            $query->whereBetween('act_budget', [$request->get('act_budget_min'), $request->get('act_budget_max')]);
        } elseif ($request->has('act_budget_min') && $request->get('act_budget_min') != null) {
            $query->where('act_budget', '>=', $request->get('act_budget_min'));
        } elseif ($request->has('act_budget_max') && $request->get('act_budget_max') != null) {
            $query->where('act_budget', '<=', $request->get('act_budget_max'));
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


}
