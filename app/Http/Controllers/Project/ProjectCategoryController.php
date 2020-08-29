<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectCategory\ProjectCategory;
use App\Models\Project\Project;

use App\Helpers\Log;

class ProjectCategoryController extends Controller
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
        is_permitted('5', 'ProjectCategoryController', 'index', '18', '7');

        $projectcategories = ProjectCategory::get();
        $screenName = screenName(5);
        $labels = inputButton(Auth::user()->lang_id, 42);
        $userPermissions = getUserPermission();
        $id = 1;
        if ($request->ajax()) {
            $id = 2;
            $html = view('project.projectcategories.table_rander', compact('labels', 'projectcategories',  'userPermissions', 'id'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('project.projectcategories.index', compact('labels', 'projectcategories', 'screenName', 'userPermissions','id'));
        }
    }
     public function create(Request $request){
         is_permitted('5', 'ProjectCategoryController', 'store', '19', '1');

         $project_category = new ProjectCategory();
         $category_name_na = ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-5', 'col_input_Class' => 'col-md-6'];
         $category_name_fo = ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-5', 'col_input_Class' => 'col-md-6'];
         $is_hidden = ['html_type' => '13'];
         $option = [
             'category_name_na' => $category_name_na,
             'category_name_fo' => $category_name_fo,
             'is_hidden'  =>  $is_hidden,
         ];


         $generator = generator(5, $option, $project_category);
         $html =$generator[0];
         $labels =$generator[1];
         $userPermissions = getUserPermission();
         $save=1;
         $id=1;
         if($request->ajax()){
             $id=2;
             $html =view('project.projectcategories.create_render', compact('labels', 'html', 'userPermissions','save','id'))->render();
             return response(['status' => true, 'html' =>$html]);

         }
         else
         return view('project.projectcategories.create',compact('html','labels','userPermissions','save','id'));
    }

    public function store(Request $request,$id){
        is_permitted('5', 'ProjectCategoryController', 'store', '19', '1');


        $input = $request->all();
        $data = fieldInDatabase(5, $input);
         $optionValidator=[
            'category_name_na'=>[
                'unique'=>'unique:c_project_categories,category_name_na'
            ],
            'category_name_fo'=>[
                'unique'=>'unique:c_project_categories,category_name_fo'
            ],

        ];
        inputValidator($data,$optionValidator);
        $field =$data['field'];

        $data['created_by'] = Auth::id();
        $project_category = new ProjectCategory();
        $project_category->fill($field);
        $project_category->created_by = Auth::id();

        $project_category->save();

        Log::instance()->record('2.48',null,5,null,null,null,null);
        Log::instance()->save();

        notifications(getClassName(__CLASS__),__FUNCTION__,route('project.projectcategories.edit',$project_category->id));

        $array=['text' =>'Data Added successfully'];
        session(['array' => $array]);
$message=getMessage('2.1');
if($id==1)
        return redirect()->route('project.projectcategories.index');
else
    return response(['status' => true, 'city' =>$project_category,'message'=>$message,'statusObj'=>activeLabel($project_category->is_hidden)]);
    }

    public function edit(Request $request,$id)
    {
        is_permitted('5', 'ProjectCategoryController', 'update', '20', '2');
        $category = new ProjectCategory();
        $data = ProjectCategory::where('id',$id)->first();
        $category_name_na = ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-5', 'col_input_Class' => 'col-md-6'];
        $category_name_fo = ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-5', 'col_input_Class' => 'col-md-6'];
        $is_hidden         = ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-5','selectArray' => ['0' => 'Active', '1' => 'Inactive']];
        $id_col=['html_type'=>'10'];
        $option = [
            'category_name_na' => $category_name_na,
            'category_name_fo' => $category_name_fo,
            'is_hidden'  =>  $is_hidden,
            'id'=>$id_col
        ];


        $generator = generator(5, $option, $data);
        $html =$generator[0];
        $labels =$generator[1];
        $userPermissions = getUserPermission();
        $save=2;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('project.projectcategories.create_render', compact('labels', 'html', 'data','userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('project.projectcategories.edit',  compact('labels','html','data','userPermissions','save','id'));
    }

    public function update($id,Request $request)
    {
        is_permitted('5', 'ProjectCategoryController', 'update', '20', '2');

        $input = $request->all();
        $data = fieldInDatabase(5, $input);
        $field =$data['field'];
         $optionValidator=[
            'category_name_na'=>[
                'unique'=>'unique:c_project_categories,category_name_na,'. $field['id']
            ],
            'category_name_fo'=>[
                'unique'=>'unique:c_project_categories,category_name_fo,'.$field['id']
            ],
        ];
        inputValidator($data,$optionValidator);

        $data['updated_by'] = Auth::id();
        //$category = ProjectCategory::where('id',$field['id'])->update($field);

        $category = ProjectCategory::where('id',$field['id'])->first();
        Log::instance()->record('2.49',$field['id'],5,null,null,$field,$category);
        $category->fill($field);
        $category->save();
        Log::instance()->save();
        notifications(getClassName(__CLASS__),__FUNCTION__,route('project.projectcategories.edit',$category->id));
        $message=getMessage('2.2');
        $array=['text' =>'Data Updated successfully'];
        session(['array' => $array]);
        if($id==1)
        return redirect()->route('project.projectcategories.index' );

        else
            return response(['status' => true, 'city' =>$category,'message'=>$message,'statusObj'=>activeLabel($category->is_hidden)]);


}

    public function destroy($id,$id1){

        is_permitted('5', 'ProjectCategoryController', 'destroy', '21', '4');

        $category = ProjectCategory::find($id);
        $project = Project::Where('category_id',$id)->first();

        if(!empty($project)){
            $message = getMessage('2.192');
            session(['array' => $message]);

            return redirect()->route('project.projectcategories.index' );
        }else{
            $category->delete();
            Log::instance()->record('2.51',$id,5,null,null,null,null);
            Log::instance()->save();
            notifications(getClassName(__CLASS__),__FUNCTION__,'');

            $message = getMessage('2.3');
            session(['array' => $message]);
            if($id1==1)
            return redirect()->route('project.projectcategories.index' );
            else
                return response(['status' => true, 'message' => $message]);


        }

    }

}
