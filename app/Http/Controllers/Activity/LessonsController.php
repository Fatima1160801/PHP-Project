<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Report\ActivitiesLessonsReportExportExcel;
use App\Models\Activity\Activity;
use App\Models\Activity\ActivityLessonsVW;
use App\Models\Activity\Lessons;
use App\Models\Project\Project;
use App\Models\Report\ReportMaster;
use App\Models\Report\ReportMasterUser;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class LessonsController extends Controller
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


    public function index($activity_id)
    {
        is_permitted(98, getClassName(__CLASS__),'index', 171, 7);

        $lessons = Lessons::where('activity_id', $activity_id)->get();
        $labels = inputButton(Auth::user()->lang_id, 98);
        $userPermissions = getUserPermission();
        $view = view('activity.lessons.index', compact('lessons', 'labels', 'userPermissions', 'activity_id'))->render();
        return response(['html' => $view]);
    }


    public function create($activity_id)
    {
        is_permitted(98, getClassName(__CLASS__),'store', 172, 1);

        $activity = Activity::find($activity_id);
        $project_id = $activity->project_id;

        $lessons_type_id = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $related_to_id = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $description = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $recommendation = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];


        $option = [
            'lessons_type_id' => $lessons_type_id,
            'related_to_id' => $related_to_id,
            'description' => $description,
            'recommendation' => $recommendation,
        ];
        $Lessons = new Lessons();
        $Lessons->activity_id = $activity_id;
        $Lessons->project_id = $project_id;
        $generator = generator(98, $option, $Lessons);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $html = view('activity.lessons.create', compact('labels', 'html', 'userPermissions'))->render();
        return response(['status' => 'success', 'html' => compact('html')]);
    }

    public function store(Request $request)
    {
        is_permitted(98, getClassName(__CLASS__),'store', 172, 1);

        $input = $request->all();

        $data = fieldInDatabase(98, $input);
        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);
        $field = $data['field'];
        // dd($field);
        if ($request->get('id') == null) {
            $lessons = new Lessons();
            $lessons->fill($field);
            $lessons->is_hidden = 0;
            $lessons->created_by = Auth::id();
            $lessons->save();
        } else {
            $lessons = Lessons::find($request->get('id'));
            $lessons->fill($field);
            $lessons->updated_by = Auth::id();
            $lessons->save();
        }
        return response('true');
    }


    public function edit($lessons_id)
    {
        is_permitted(98, getClassName(__CLASS__),'store', 173, 2);


        $lessons_type_id = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $related_to_id = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $description = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $recommendation = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];


        $option = [
            'lessons_type_id' => $lessons_type_id,
            'related_to_id' => $related_to_id,
            'description' => $description,
            'recommendation' => $recommendation,
        ];

        $lessons = Lessons::find($lessons_id);
        $generator = generator(98, $option, $lessons);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $html = view('activity.lessons.edit', compact('labels', 'html', 'userPermissions'))->render();

        return response(['status' => 'success', 'html' => compact('html')]);
    }

    public function update(Request $request)
    {
        is_permitted(98, getClassName(__CLASS__),'store', 173, 2);

        $input = $request->all();
        $data = fieldInDatabase(98, $input);
        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);
        $field = $data['field'];
        // dd($field);
        if ($request->get('id') == null) {
            $lessons = new Lessons();
            $lessons->fill($field);
            $lessons->is_hidden = 0;
            $lessons->created_by = Auth::id();
            $lessons->save();
        } else {
            $lessons = Lessons::find($request->get('id'));
            $lessons->fill($field);
            $lessons->updated_by = Auth::id();
            $lessons->save();
        }
        return response('true');
    }

    public function destroy($id)
    {
        is_permitted(98, getClassName(__CLASS__),'delete', 174, 4);

        $lessons = Lessons::find($id);
        $lessons->deleted_by = Auth::id();
        $lessons->save();
        $lessons->delete();
        $array = getMessage('2.3');
        return response(['status' => 'true', 'message' => $array]);

    }


    public function report()
    {
       is_permitted(110,'LessonsController', 'report', 224, 10);
        $activityLessonsVW = new ActivityLessonsVW();
        $project_name = 'project_name_'.lang_character();
        $project = Project::getProject()->pluck($project_name,'id');
        $project_id = ['relatedWhere' => 'deleted_at is null', 'selectArray' => $project,'attr' => ' data-live-search="true" '];
        $lessons_related_id = ['relatedWhere' => 'deleted_at is null'];
        $lessons_type_id = ['relatedWhere' => 'deleted_at is null'];

        $option = [
            'project_id'=>$project_id,
            'lessons_related_id'=>$lessons_related_id,
            'lessons_type_id'=>$lessons_type_id,
        ];
        $generator = generator(101, $option, $activityLessonsVW);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('activity.report.lessons.ReportAcivitiesLessons', compact('id', 'html', 'labels', 'userPermissions'));
    }

    public function search(Request $request)
    {
        $input = $request->all();
        $rep_master_id = 19;
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
            ->orderBy('global_report_detail_users.column_order', 'asc')->pluck('global_report_details.column_name');
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
            $query = ActivityLessonsVW::query();
            $query->select($reportDetailColumnsNames);
            /*
             * activity_lessons_activity_id int(11)
activity_lessons_project_id int(11)
activity_lessons_lessons_type_id int(11)
activity_lessons_related_to_id int(11)
            */
            if ($request->has('project_id') && $request->get('project_id') != null) {
                $query->where('activity_lessons_project_id', $input['project_id']);
            }
            if ($request->has('lessons_type_id') && $request->get('lessons_type_id') != null) {
                $query->where('activity_lessons_lessons_type_id', '=', $input['lessons_type_id']);
            }
            if ($request->has('lessons_related_id') && $request->get('lessons_related_id') != null) {
                $query->where('activity_lessons_related_to_id', '=', $input['lessons_related_id']);
            }

            $report_data = $query->get();
            return view('report.modal.report_table', compact('report_master', 'reportMasterUser', 'reportDetailUser', 'reportDetailColumnsNames', 'report_data'));
        } else {
            $message = getMessage('2.82');
            return response(['status' => 'false', 'message' => $message]);
        }
    }

    public function reportExportExcel(Request $request)
    {
        $reportMasterUser = ReportMasterUser::where('rep_master_id',19)
            ->where('user_id', Auth::id())
            ->first();
        return \Maatwebsite\Excel\Facades\Excel::download(new ActivitiesLessonsReportExportExcel(19, $request), $reportMasterUser->rep_label . '.xlsx');
    }

    public function reportExportPDF(Request $request)
    {
        // return pdfDataExport($rep_master_id);
        $rep_master_id = 19;
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

        $query = ActivityLessonsVW::query();
        $query->select($reportDetailColumnsNames);

        if ($request->has('project_id') && $request->get('project_id') != null) {
            $query->where('activity_lessons_project_id', $input['project_id']);
        }
        if ($request->has('lessons_type_id') && $request->get('lessons_type_id') != null) {
            $query->where('activity_lessons_lessons_type_id', '=', $input['lessons_type_id']);
        }
        if ($request->has('lessons_related_id') && $request->get('lessons_related_id') != null) {
            $query->where('activity_lessons_related_to_id', '=', $input['lessons_related_id']);
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
