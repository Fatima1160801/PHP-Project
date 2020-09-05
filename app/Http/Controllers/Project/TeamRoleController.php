<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Procurement\Brand;
use App\Models\Project\ProjectStaffs;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobTitle\TeamRole;

use App\Helpers\Log;


class TeamRoleController extends Controller
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

        is_permitted('151', 'TeamRoleController', 'index', '14', '7');

        $teamroles = TeamRole::get();
        $screenName = screenName(151);
        $labels = inputButton(Auth::user()->lang_id, 151);
        $userPermissions = getUserPermission();
        $id = 1;
        if ($request->ajax()) {
            $id = 2;
            $html = view('project.teamrole.index', compact('labels', 'teamroles', 'screenName', 'userPermissions', 'id'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('project.teamrole.index', compact('labels', 'teamroles', 'screenName', 'userPermissions', 'id'));
        }
    }

    public function create()
    {
        is_permitted('151', 'TeamRoleController', 'store', '15', '1');

        $role = new TeamRole();
        $role_name_na = ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-8'];
        $role_name_fo = ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-8'];
        $is_hidden = ['html_type' => '13'];
        $option = [
            'role_name_na' => $role_name_na,
            'role_name_fo' => $role_name_fo,
            'is_hidden' => $is_hidden,
        ];
        $generator = generator(151, $option, $role);
        $html = $generator[0];
        $labels = $generator[1];

//        $screenName = screenName(151);
        $userPermissions = getUserPermission();
        $save = 1;
        $id1 = 1;

        $val = view('project.teamrole.create', compact('html', 'labels', 'userPermissions', 'save'))->render();
        return response(['status' => true, 'html' => $val]);

    }

    public function store(Request $request)
    {
        is_permitted('151', 'TeamRoleController', 'store', '15', '1');

        $input = $request->all();
        $data = fieldInDatabase(151, $input);
        $optionValidator = [
//            'role_name_na' => [
//                'unique' => 'unique:c_roles'
//            ],
//            'role_name_fo' => [
//                'unique' => 'unique:c_roles'
//            ],
        ];
        inputValidator($data, $optionValidator);
        $field = $data['field'];
        $data['created_by'] = Auth::id();
        $role = new TeamRole();
        $role->fill($field);
        $role->created_by = Auth::id();
        $role->save();
        $message = getMessage('2.1');
//        Log::instance()->record('2.55', null, 151, null, null, null, null);
//        Log::instance()->save();

//        notifications(getClassName(__CLASS__), __FUNCTION__, route('project.teamrole.edit', $role->id));

//        $array = ['text' => 'Data Added successfully'];
//        session(['array' => $array]);
       
            return response(['status' => true, 'city' => $role, 'message' => $message, 'statusObj' => activeLabel($role->is_hidden)]);


    }
    public function edit(Request $request,$id)
    {
        is_permitted('151', 'TeamRoleController', 'update', '16', '2');
        $role = new TeamRole();
        $data = TeamRole::where('id', $id)->first();
        $role_name_na = ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-8'];
        $role_name_fo = ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-8'];
        $is_hidden = ['col_all_Class' => 'col-md-8', 'attr' => ' data-live-search="true" ','col_label_Class' => 'col-md-3', 'selectArray' => ['0' => 'Active', '1' => 'Inactive'], "attr" => "value='$data->is_hidden'"];
        $id = ['html_type' => '10'];
        $option = [
            'role_name_na' => $role_name_na,
            'role_name_fo' => $role_name_fo,
            'is_hidden' => $is_hidden,
            'id' => $id
        ];


        $generator = generator(151, $option, $data);
        $html = $generator[0];
        $labels = $generator[1];


        $screenName = screenName(151);
        /* $role = TeamRole::find($id); */
        $userPermissions = getUserPermission();
        $save = 2;
        $id1 = 1;

        $val = view('project.teamrole.create', compact('labels', 'html', 'screenName', 'data', 'userPermissions', 'save'))->render();
        return response(['status' => true, 'html' => $val]);

    }

    public function update(Request $request)
    {
        is_permitted('151', 'TeamRoleController', 'update', '16', '2');

        $input = $request->all();
        $data = fieldInDatabase(151, $input);
        $field = $data['field'];
        $optionValidator = [
//            'role_name_na' => [
//                'unique' => 'unique:c_project_team_role,' . $field['id']
//            ],
//            'role_name_na_fo' => [
//                'unique' => 'unique:c_project_team_role,' . $field['id']
//            ],
        ];
        inputValidator($data, $optionValidator);

        $data['updated_by'] = Auth::id();
        $role = TeamRole::where('id', $field['id'])->first();
        Log::instance()->record('2.56',$field['id'],151,null,null,$field,$role);
        $role->fill($field);
        $role->save();
        Log::instance()->save();
        notifications(getClassName(__CLASS__),__FUNCTION__,route('project.jobtitle.edit',$role->id));
        $message=getMessage('2.2');
        $array = ['text' => 'Data Updated successfully'];
        session(['array' => $array]);

            return response(['status' => true, 'city' =>$role,'message'=>$message,'statusObj'=>activeLabel($role->is_hidden)]);

    }
   
        public function destroy($id)
        {
            is_permitted(151, getClassName(__CLASS__), __FUNCTION__, 313, 4);
            try {
                $teamRole = TeamRole::find($id);
                if(empty($teamRole)){
                    return response(['status' => false, 'message' => getMessage('2.2')]);
                }
//                $arr=[\App\Models\Procurement\Item::class];
//                $check=checkBeforeDelete($arr,"brand_id",$id);
//                if($check){
                    $teamRole->delete();
                    if($teamRole){
                        $teamRole->update(["deleted_by"=>Auth::user()->id ]);
                    }
//                }else{
//                    return response(['status' => false, 'message' => getMessage('2.354')]);
//                }
                $message = getMessage('2.3');
                return response(['status' => true, 'message' => $message]);
            } catch (\Illuminate\Database\QueryException $e) {
                $message = getMessage('2.3');
                return response(['status' => false, 'message' => $message]);
            }
        }
}