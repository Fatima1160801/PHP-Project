<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 9/24/2018
 * Time: 8:19 AM
 */

namespace App\Http\Controllers\Beneficiary;

use App\Http\Controllers\Controller;

use App\Helpers\Log;

use App\Http\Controllers\Report\BeneficiaryOrganizationReportExportExcel;
use App\Models\Activity\ActivityBeneficiaries;
use App\Models\Project\ActuallyTargetedBeneficiaries;
use App\Models\Report\Beneficiary\ReportBeneficiaryOrgnaization;
use App\Models\Report\ReportMaster;
use App\Models\Report\ReportMasterUser;
use App\Models\Setting\C\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Beneficiary\Beneficiary;
use App\Models\Beneficiary\BeneficiaryFamily;
use App\Models\Beneficiary\BeneficiaryOrganization;
use DB;
use Validator;
use niklasravnsborg\LaravelPdf\Facades\Pdf;


class BeneficiaryOrganizationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        is_permitted(27, getClassName(__CLASS__), __FUNCTION__, 75, 7);

        $beneficiaryOrganizations = BeneficiaryOrganization::orderby('id', 'desc')->get();
        $messageDeleteBeneficiary = getMessage('2.46');
        $org_types = [
            1 => ['1' => 'Governmental', '2' => 'Non-Governmental', '3' => 'CPOs', '4' => 'Grass Root'],
            2 => ['1' => ' حكومي', '2' => 'غير حكومي', '3' => 'CPOs', '4' => 'Grass Root'],
        ];
        $labels = inputButton(Auth::user()->lang_id, 27);
        $userPermissions = getUserPermission();

        return view('beneficiary.organizations.index', compact('labels', 'beneficiaryOrganizations', 'org_types', 'messageDeleteBeneficiary', 'userPermissions'));
    }


    public function getCreate()
    {
        is_permitted(27, getClassName(__CLASS__), 'store', 76, 1);

        $org_types = [
            1 => ['1' => 'Governmental', '2' => 'Non-Governmental', '3' => 'CPOs', '4' => 'Grass Root'],
            2 => ['1' => ' حكومي', '2' => 'غير حكومي', '3' => 'CPOs', '4' => 'Grass Root'],
        ];
        $ben_type_id = ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8', 'html_type' => '5', 'selectArray' => $org_types[Auth::user()->lang_id]];
        $is_hidden = ['html_type' => '13'];
        $note = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $ben_mobile_no = ['inputClass' => 'check-is-number'];
        $ben_tel_no = ['inputClass' => 'check-is-number'];
        $ben_fax_no = ['inputClass' => 'check-is-number'];
        //  $members_number =['inputClass'=>'check-is-number'];
        $contact_mobile = ['inputClass' => 'check-is-number'];
        $option = [
            'registration_number' => ['inputClass' => 'check-is-number'],
            'org_type' => $ben_type_id,
            'is_hidden' => $is_hidden,
            'ben_fax_no' => $ben_fax_no,
            'ben_tel_no' => $ben_tel_no,
            'ben_mobile_no' => $ben_mobile_no,
            'contact_mobile' => $contact_mobile,
            'note' => $note,
            'city_id' => ['relatedWhere' => ' deleted_at is null', 'col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'],
            'district_id' => ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'],
        ];

        $beneficiaryOrganization = new BeneficiaryOrganization();
        $generator = generator(27, $option, $beneficiaryOrganization);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        //$screenName = screenName(25);
        // $screenName = "Add Beneficiary Organization";
        return view('beneficiary.organizations.create', compact('labels', 'html', 'userPermissions'));
    }

    public function getDistanceByCityId($city_id)
    {
        if (Auth::user()->lang_id == 1) {
            $name = 'district_name_no';
        } else {
            $name = 'district_name_fo';
        }
        $distance = District::where('city_id', $city_id)
            ->where('is_hidden', '0')
            ->where('deleted_at', null)
            ->pluck($name, 'id');
        return response($distance);
    }

    public function store(Request $request)
    {
        is_permitted(27, getClassName(__CLASS__), __FUNCTION__, 76, 1);

        $input = $request->all();
        $data = fieldInDatabase(27, $input);
        $optionValidator = [
            'ben_mobile_no' => ['nullable' => 'nullable'],
            'ben_fax_no' => ['nullable' => 'nullable'],
            'ben_tel_no' => ['nullable' => 'nullable'],
            'ben_address_na' => ['nullable' => 'nullable'],
            'ben_address_fo' => ['nullable' => 'nullable'],
            'ben_email' => ['nullable' => 'nullable'],
            'note' => ['nullable' => 'nullable'],
            'registration_number' => [
                '1' => 'unique:org_beneficiary,registration_number',
                '2' => 'unique:locality,registration_number',
            ],
        ];


        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $beneficiaryOrganization = new BeneficiaryOrganization();
        $beneficiaryOrganization->fill($field);
        $beneficiaryOrganization->created_by = Auth::id();
        $beneficiaryOrganization->save();

        Log::instance()->record('2.17', null, 27, null, null, null, null);
        Log::instance()->save();

        notifications(getClassName(__CLASS__), __FUNCTION__, route('beneficiary.oraganizations.getedit', $beneficiaryOrganization->id));

        return response(['success' => true, 'message' => getMessage('2.37')]);
    }


    public function getEdit($id)
    {
        is_permitted(27, getClassName(__CLASS__), 'update', 77, 2);
        $beneficiaryOrganization = BeneficiaryOrganization::where('id', $id)->first();


        if ($beneficiaryOrganization == null) {
            return redirect()->route('beneficiary.oraganizations.index');
        }

        if (Auth::user()->lang_id = 1) {
            $name = 'district_name_no';
        } else {
            $name = 'district_name_fo';
        }
        $city_id = $beneficiaryOrganization->city_id;
        $districts = District::where('city_id', $city_id)->pluck($name, 'id');
        $org_types = [
            1 => ['1' => 'Governmental', '2' => 'Non-Governmental', '3' => 'CPOs', '4' => 'Grass Root'],
            2 => ['1' => ' حكومي', '2' => 'غير حكومي', '3' => 'CPOs', '4' => 'Grass Root'],
        ];
        $pst = [
            1 => ['0' => 'Active', '1' => 'Inactive'],
            2 => ['0' => 'مفعل', '1' => 'غير مفعل']
        ];
        $note = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $ben_type_id = ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8', 'html_type' => '5', 'selectArray' => $org_types[Auth::user()->lang_id]];
        $is_hidden = ['html_type' => '13', 'selectArray' => $pst[Auth::user()->lang_id]];
        $ben_mobile_no = ['inputClass' => 'check-is-number'];
        $ben_tel_no = ['inputClass' => 'check-is-number'];
        $ben_fax_no = ['inputClass' => 'check-is-number'];
        $contact_mobile = ['inputClass' => 'check-is-number'];
        $option = [
            'registration_number' => ['inputClass' => 'check-is-number'],
            'org_type' => $ben_type_id,
            'is_hidden' => $is_hidden,
            //    'members_number'=>$members_number,
            'ben_fax_no' => $ben_fax_no,
            'ben_tel_no' => $ben_tel_no,
            'ben_mobile_no' => $ben_mobile_no,
            'contact_mobile' => $contact_mobile,
            'note' => $note,
            'city_id' => ['relatedWhere' => ' deleted_at is null', 'col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'],
            'district_id' => ['selectArray' => $districts, 'col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'],
        ];

        $generator = generator(27, $option, $beneficiaryOrganization);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();

        //$screenName = screenName(25);
        return view('beneficiary.organizations.update', compact('labels', 'html', 'userPermissions'));
    }


    public function postUpdate(Request $request)
    {
        is_permitted(27, getClassName(__CLASS__), __FUNCTION__, 77, 2);

        $input = $request->all();
        $data = fieldInDatabase(27, $input);

        $optionValidator = [
            'ben_mobile_no' => ['nullable' => 'nullable'],
            'ben_fax_no' => ['nullable' => 'nullable'],
            'ben_tel_no' => ['nullable' => 'nullable'],
            'ben_address_na' => ['nullable' => 'nullable'],
            'ben_address_fo' => ['nullable' => 'nullable'],
            'ben_email' => ['nullable' => 'nullable'],
            'note' => ['nullable' => 'nullable'],
            'registration_number' => [
                '1' => 'unique:org_beneficiary,registration_number,'. $request->id,
                '2' => 'unique:locality,registration_number',
            ],
        ];

        inputValidator($data, $optionValidator);

        $field = $data['field'];

        if ($request->get('id') != null) {
            $beneficiaryOrganization = BeneficiaryOrganization::find($request->get('id'));
            Log::instance()->record('2.18', $field['id'], 27, null, null, $field, $beneficiaryOrganization);
            Log::instance()->save();
            $beneficiaryOrganization->fill($field);
            $beneficiaryOrganization->updated_by = Auth::id();
            $beneficiaryOrganization->save();
            $message = getMessage('2.39');

            notifications(getClassName(__CLASS__), __FUNCTION__, route('beneficiary.oraganizations.getedit', $beneficiaryOrganization->id));

        }

        return response(['success' => true, 'message' => $message]);
    }


    public function delete($id)
    {
        is_permitted(27, getClassName(__CLASS__), __FUNCTION__, 78, 4);

        try {
//            $ActuallyTargetedBeneficiaries = ActuallyTargetedBeneficiaries::where('beneficiaries_all_vw_id', $id)
//                ->where('beneficiaries_all_vw_type', 3)
//                ->get()->count();
//             if ($ActuallyTargetedBeneficiaries > 0) {
//                $message = getMessage('2.198');
//                return response(['status' => 'false', 'message' => $message]);
//            }
          $activity_beneficiaries = ActivityBeneficiaries::where('ben_id',$id)
              ->where('ben_type_id',3)
              ->get()
              ->count();
          if ($activity_beneficiaries> 0) {
            $message = getMessage('2.198');
            return response(['status' => 'false', 'message' => $message]);
          }
             else {
               $beneficiaryOrganization = BeneficiaryOrganization::where('id', $id)->first();

               $beneficiaryOrganization->deleted_by = Auth::id();
                $beneficiaryOrganization->save();
                $beneficiaryOrganization->delete();
                Log::instance()->record('2.19', $id, 27, null, null, null, null);
                Log::instance()->save();
                notifications(getClassName(__CLASS__), __FUNCTION__, '');
                $message = getMessage('2.45');
                return response(['status' => 'true', 'message' => $message]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.24');
            return response(['status' => 'false', 'message' => $message]);
        }
    }

    public function reportBeneficiaryOrganization()
    {
        is_permitted(110, 'BeneficiaryOrganizationsController', 'report', 226, 10);

        $beneficiaryOrganization = new BeneficiaryOrganization();
        $org_type = ['attr' => ' data-live-search="true" ', 'selectArray' => ['1' => 'Ministry', '2' => 'Municipality']];
        $ben_name_na = [];
        $ben_name_fo = [];
        $option = [
            'org_type' => $org_type,
            'ben_name_na' => $ben_name_na,
            'ben_name_fo' => $ben_name_fo,
        ];
        $generator = generator(55, $option, $beneficiaryOrganization);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();

        return view('beneficiary.report.reportBeneficiaryOrganization', compact('html', 'labels', 'userPermissions'));
    }

    public function search(Request $request)
    {

        $input = $request->all();
        $rep_master_id = 6;
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
            $query = ReportBeneficiaryOrgnaization::query();
            $query->select($reportDetailColumnsNames);

            if ($request->has('org_type') && $request->get('org_type') != null) {
                $query->where('org_type', $request->get('org_type'));
            }
            if ($request->has('ben_name_na') && $request->get('ben_name_na') != null) {
                $query->where('ben_name_na', 'like', '%' . $request->get('ben_name_na') . '%');
            }
            if ($request->has('ben_name_fo') && $request->get('ben_name_fo') != null) {
                $query->where('ben_name_fo', 'like', '%' . $request->get('ben_name_fo') . '%');
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

        $reportMasterUser = ReportMasterUser::where('rep_master_id', 6)
            ->where('user_id', Auth::id())
            ->first();
        return \Maatwebsite\Excel\Facades\Excel::download(new BeneficiaryOrganizationReportExportExcel(6, $request), $reportMasterUser->rep_label . '.xlsx');
    }

    public function reportExportPDF(Request $request)
    {
        // return pdfDataExport($rep_master_id);
        $rep_master_id = 6;
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
        $query = ReportBeneficiaryOrgnaization::query();
        $query->select($reportDetailColumnsNames);

        if ($request->has('org_type') && $request->get('org_type') != null) {
            $query->where('org_type', $request->get('org_type'));
        }
        if ($request->has('ben_name_na') && $request->get('ben_name_na') != null) {
            $query->where('ben_name_na', 'like', '%' . $request->get('ben_name_na') . '%');
        }
        if ($request->has('ben_name_fo') && $request->get('ben_name_fo') != null) {
            $query->where('ben_name_fo', 'like', '%' . $request->get('ben_name_fo') . '%');
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