<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use http\Message;
use Illuminate\Http\Request;
use App\Models\Permission\Modules;
use App\Models\Permission\GroupPermission;
use App\Models\Permission\GroupUser;
use App\Models\Permission\Group;
use App\Models\Permission\User;

use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
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
    public function index(Request $request)
    {
        is_permitted('2', 'GroupController', 'index', '8', '7');

        $groups = Group::get();
        $labels = inputButton(Auth::user()->lang_id, 0);
        $userPermissions = getUserPermission();
        $id = 1;
        if ($request->ajax()) {
            $id = 2;
            $html = view('permission.group.render_table', compact('labels', 'groups', 'userPermissions', 'id'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('permission.group.index', compact('labels', 'groups', 'userPermissions','id'));
        }
    }

    public function store(Request $request)
    {


        if ($request->ajax()) {
            $data = $this->validate(request(), [
                'group_name' => 'required',
                'id' => ''
            ], []);

            if ($request->filled('id')) {
                is_permitted('2', 'GroupController', 'update', '9', '2');

                $group = Group::find($request->id);
                $group->group_name = $request->group_name;
                $group->updated_by = Auth::id();
                $group->save();
                $html = view('permission.group.row', compact('group'))->render();
                return response(['status' => 'edit', 'data' => compact('group', 'html'),'message'=>getMessage('2.2')]);

            } else {
                is_permitted('2', 'GroupController', 'store', '7', '1');

                $data['created_by'] = Auth::id();
                $group = Group::create($data);
                $html = view('permission.group.row', compact('group'))->render();
                return response(['status' => 'save', 'data' => compact('group', 'html'),'message'=>getMessage('2.1')]);
            }

        }
    }


    public function edit($id)
    {
        is_permitted('2', 'GroupController', 'update', '9', '2');

        $group = Group::find($id);
        return response(['data' => $group]);
    }


    public function userGroup($user_id)
    {
      is_permitted(1,'GroupController','grantUserGroup', '6', '8');
      $user = User::find($user_id);
      $groups = Group::get();
      $userPermissions = getUserPermission();
      $html = view('permission.group.modalUserGroup',compact('groups','user','userPermissions'))->render();
      return response(['status' => 'success', 'html' => compact('html')]);

    }

    public function GroupRow($user_id)
    {
        $user = User::find($user_id);
        $groups = Group::get();
        $userPermissions = getUserPermission();

        return view('permission.group.grouprow', compact('user', 'groups','userPermissions'));
    }


    public function grantUserGroup( Request $request)
    {
         is_permitted(1,'GroupController','grantUserGroup', '6', '8');

        $input = $request->all();

        if ($input['checkType'] == 'check') {
            GroupUser::create([
                'user_id' => $input['user_id'] ,
                'group_id' => $input['group_id'],
                'created_by' => Auth::id()
            ]);
            return 'saving';

        } else {
            $group_user = GroupUser::where('user_id', $input['user_id'])
                ->where('group_id', $input['group_id'])
                ->delete();
            return 'deleted';
        }
    }

//    public function groupPermission()
//    {
//          is_permitted(1,'GroupController','grantUserGroup', '6', '8');
//
//        $groupList = Group::pluck('group_name', 'id');
//        return view('permission.group.groupPermission', compact('groupList', 'modules'));
//    }
//
//    public function permission($id)
//    {
//          is_permitted(1,'GroupController','grantUserGroup', '6', '8');
//
//        $modules = Modules::get();
//        return view('permission.group.permission', compact('id', 'modules'));
//    }



    public function groupForUser($user_id)
    {
        $user = User::find($user_id);
        $userPermissions = getUserPermission();
        $html = view('permission.users.row',compact('user','userPermissions'))->render();
        return response(['status' => 'success', 'html' => compact('html')]);

    }

}
