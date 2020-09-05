<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Models\Permission\Group;
use App\Models\Permission\GroupPermission;
use App\Models\Permission\Modules;
use App\Models\Permission\Screen;
use App\Models\Permission\ScreenCommand;
use App\Models\Permission\User;
use App\Models\Permission\UserPermission;
use App\Models\Procurement\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($type  ,$id,$screen_id,Request $request){
        $labels = inputButton(Auth::user()->lang_id ,0);


        $modules = $modules = Modules::get();
        $userPermissions = getUserPermission();
        if($type == 'user'){
            is_permitted(1,  'PermissionController', 'grantUser', 3, '6');
            $user = User::find($id);
            $title = 'grant permissions to  user :' . $user->user_full_name;
            $id1 = 1;
            if ($request->ajax()) {
                $id1 = 2;
                $html = view('permission.permission.render', compact('labels','type','user','modules','title','userPermissions','screen_id','id1','screen_id'))->render();
                return response(['status' => true, 'html' => $html]);
            } else {
            return view('permission.permission.index' ,compact('labels','type','user','modules','title','userPermissions','screen_id'));}
        }elseif ($type =='group'){
            is_permitted(2, 'PermissionController', 'grantGroup', 4, 5);
             $group = Group::find($id);
            $title = 'grant group to  user :' . $group->group_name;
            $id1 = 1;
            if ($request->ajax()) {
                $id1 = 2;
                $html = view('permission.permission.render', compact('labels','type','group','modules','title','userPermissions' ,'id1','screen_id'))->render();
                return response(['status' => true, 'html' => $html]);
            } else {
                return view('permission.permission.index', compact('labels', 'type', 'group', 'modules', 'title', 'userPermissions', 'id1','screen_id'));
            }
        }else{
            return redirect('/');
        }


    }
    public function grantUser(Request $request)
    {
        is_permitted(1,  'PermissionController', 'grantUser', 3, '6');

        $input = $request->all();
        if($input['checkType'] == 'check') {
            $user_permission = new UserPermission();
//            $user_permission->fill($input);

            $user_permission->user_id =$input['user_id'];
            $user_permission->screen_id=$input['screen_id'];
            $user_permission->command_id=$input['command_id'];
            $user_permission->command_type_id=$input['command_type_id'];
            $user_permission->created_by=Auth::id();
            $user_permission->save();
            return 'added';
        } elseif ($input['checkType'] == 'uncheck') {
            $user_permission = UserPermission:: where('user_id', $input['user_id'])
                ->where('screen_id', $input['screen_id'])
                ->where('command_id', $input['command_id'])
                ->where('command_type_id', $input['command_type_id'])
                ->delete();

            return 'deleted';
        }

    }
    public function grantGroup(Request $request)
    {
        is_permitted(2, 'PermissionController', 'grantGroup', 4, 5);

        $input = $request->all();
        if($input['checkType'] == 'check') {
            $group_permission = new GroupPermission();

            $group_permission->group_id =$input['group_id'];
            $group_permission->screen_id=$input['screen_id'];
            $group_permission->command_id=$input['command_id'];
            $group_permission->command_type_id=$input['command_type_id'];
            $group_permission->created_by=Auth::id();
            $group_permission->save();
            return 'added';
        } elseif ($input['checkType'] == 'uncheck') {
            $group_permission = GroupPermission::where('group_id', $input['group_id'])
                ->where('screen_id', $input['screen_id'])
                ->where('command_id', $input['command_id'])
                ->where('command_type_id', $input['command_type_id'])
                ->delete();

            return 'deleted';
        }
    }





}
