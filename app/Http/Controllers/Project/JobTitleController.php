<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project\ProjectStaffs;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobTitle\JobTitle;

use App\Helpers\Log;


class JobTitleController extends Controller
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

    public function index(Request $request)
    {

        is_permitted('4', 'JobTitleController', 'index', '14', '7');

        $jobtitles = JobTitle::get();
        $screenName = screenName(4);
        $labels = inputButton(Auth::user()->lang_id, 41);
        $userPermissions = getUserPermission();
        $id = 1;
        if ($request->ajax()) {
            $id = 2;
            $html = view('project.jobtitle.render_table', compact('labels', 'jobtitles', 'screenName', 'userPermissions', 'id'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('project.jobtitle.index', compact('labels', 'jobtitles', 'screenName', 'userPermissions','id'));
        }
    }

    public function create(Request $request)
    {
        is_permitted('4', 'JobTitleController', 'store', '15', '1');

        $job_title = new JobTitle();
        $job_title_name_na = ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-8'];
        $job_title_name_fo = ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-8'];
        $is_inside_outside = ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-3', 'selectArray' => ['0' => 'All', '1' => 'Inside the institution', '2' => 'Outside the institution']];
        $is_hidden = ['html_type' => '13'];
        $option = [
            'job_title_name_na' => $job_title_name_na,
            'job_title_name_fo' => $job_title_name_fo,
            'is_inside_outside' => $is_inside_outside,
            'is_hidden' => $is_hidden,
        ];
        $generator = generator(4, $option, $job_title);
        $html =$generator[0];
        $labels =$generator[1];

        $screenName = screenName(4);
        $userPermissions = getUserPermission();
        $save=1;
        $id1=1;
        if($request->ajax()){
            $id1=2;
            $html =view('project.jobtitle.create_render', compact('html', 'screenName','labels','userPermissions','save','id1'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('project.jobtitle.create', compact('html', 'screenName','labels','userPermissions','save','id'));
    }

    public function store(Request $request,$id)
    {
        is_permitted('4', 'JobTitleController', 'store', '15', '1');

        $input = $request->all();
        $data = fieldInDatabase(4, $input);
        $optionValidator = [
            'job_title_name_na' => [
                'unique' => 'unique:c_job_titles'
            ],
            'job_title_name_fo' => [
                'unique' => 'unique:c_job_titles'
            ],
        ];
        inputValidator($data, $optionValidator);
        $field = $data['field'];
        $data['created_by'] = Auth::id();
        $job_title = new JobTitle();
        $job_title->fill($field);
        $job_title->created_by = Auth::id();
        $job_title->save();
        $message=getMessage('2.1');
        Log::instance()->record('2.55',null,4,null,null,null,null);
        Log::instance()->save();

        notifications(getClassName(__CLASS__),__FUNCTION__,route('project.jobtitle.edit',$job_title->id));

        $array = ['text' => 'Data Added successfully'];
        session(['array' => $array]);
        if($id==1)
            return redirect()->route('project.jobtitle.index');
        else
            return response(['status' => true, 'city' =>$job_title,'message'=>$message,'statusObj'=>activeLabel($job_title->is_hidden),'usedStatus'=>is_inside_outside($job_title->is_inside_outside)]);


    }

    public function edit(Request $request,$id)
    {
        is_permitted('4', 'JobTitleController', 'update', '16', '2');
        $job_title = new JobTitle();
        $data = JobTitle::where('id', $id)->first();
        $job_title_name_na = ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-8'];
        $job_title_name_fo = ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-8'];
        $is_inside_outside = ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-3', 'selectArray' => ['0' => 'All', '1' => 'Inside the institution', '2' => 'Outside the institution'], "attr" => "value='$data->is_inside_outside'"];
        $is_hidden = ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-3', 'selectArray' => ['0' => 'Active', '1' => 'Inactive'], "attr" => "value='$data->is_hidden'"];
       $id=['html_type'=>'10'];
        $option = [
            'job_title_name_na' => $job_title_name_na,
            'job_title_name_fo' => $job_title_name_fo,
            'is_inside_outside' => $is_inside_outside,
            'is_hidden' => $is_hidden,
            'id'=>$id
        ];


        $generator = generator(4, $option, $data);
        $html =$generator[0];
        $labels =$generator[1];


        $screenName = screenName(4);
        /* $jobtitle = JobTitle::find($id); */
        $userPermissions = getUserPermission();
        $save=2;
        $id1=1;
        if($request->ajax()){
            $id1=2;
            $html =view('project.jobtitle.create_render', compact('labels','html', 'screenName', 'data','userPermissions','save','id1'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('project.jobtitle.edit', compact('labels','html', 'screenName', 'data','userPermissions','save','id1'));
    }

    public function update(Request $request,$id)
    {
        is_permitted('4', 'JobTitleController', 'update', '16', '2');

        $input = $request->all();
        $data = fieldInDatabase(4, $input);
        $field = $data['field'];
        $optionValidator = [
            'job_title_name_na' => [
                'unique' => 'unique:c_job_titles,job_title_name_na,' . $field['id']
            ],
            'job_title_name_fo' => [
                'unique' => 'unique:c_job_titles,job_title_name_fo,' . $field['id']
            ],
        ];
        inputValidator($data, $optionValidator);

        $data['updated_by'] = Auth::id();
        $jobtitle = JobTitle::where('id', $field['id'])->first();
        Log::instance()->record('2.56',$field['id'],4,null,null,$field,$jobtitle);
        $jobtitle->fill($field);
        $jobtitle->save();
        Log::instance()->save();
        notifications(getClassName(__CLASS__),__FUNCTION__,route('project.jobtitle.edit',$jobtitle->id));
        $message=getMessage('2.2');
        $array = ['text' => 'Data Updated successfully'];
        session(['array' => $array]);
        if($id==1)
            return redirect()->route('project.jobtitle.index');

        else
            return response(['status' => true, 'city' =>$jobtitle,'message'=>$message,'statusObj'=>activeLabel($jobtitle->is_hidden),'usedStatus'=>is_inside_outside($jobtitle->is_inside_outside)]);

    }

    public function destroy($id,$id1)
    {
        is_permitted('4', 'JobTitleController', 'destroy', '17', '4');


        try {
            $ProjectStaffs =ProjectStaffs::where('job_title_id', $id)->whereNull('deleted_at')->get()->count();
            $Staff=Staff::where('job_title_id', $id)->whereNull('deleted_at')->get()->count();
            if ($ProjectStaffs > 0 || $Staff > 0 ) {
                $message = getMessage('2.191');
                session(['array' => $message]);
                if($id1==1)
                    return redirect()->route('project.jobtitle.index');
                else
                    return response(['status' => false, 'message' => $message]);

            } else {
            $jobtitle = JobTitle::find($id);
            $jobtitle->deleted_by = Auth::id();
            $jobtitle->save();
            $jobtitle->delete();

            Log::instance()->record('2.57',$id,4,null,null,null,null);
            Log::instance()->save();

            notifications(getClassName(__CLASS__),__FUNCTION__,'');

            $array = ['text' => 'Data Deleted successfully'];
            session(['array' => $array]);
                if($id1==1)
                    return redirect()->route('project.jobtitle.index');
                else
                    return response(['status' => true, 'message' => $array]);

            }
        }catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.191');
            session(['array' => $message]);

        }if($id1==1)
        return redirect()->route('project.jobtitle.index');
    else
        return response(['status' => false, 'message' => $message]);
    }

}
