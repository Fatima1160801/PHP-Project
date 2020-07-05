<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Models\Activity\Activity;
use App\Models\Permission\UserDataPermission;
use App\Models\Permission\UserDataPermissionModule;
use App\Models\Project\Project;
use App\Models\Staff\Staff;
use App\Models\Staff\StaffNotUserVW;
use App\Models\Staff\StaffUserVW;
use Validator;

use App\Models\Permission\Group;
use App\Models\Permission\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
    public function index()
    {
        is_permitted('1', 'UserController', 'index', '5', '7');

        $users = User::with('staff')
            ->where('id','<>','1')->get();
        $messageConfLock = getMessage('2.18');
        $messageConfUnLock = getMessage('2.19');
        $labels = inputButton(Auth::user()->lang_id ,0);
        $userPermissions = getUserPermission();

        return view('permission.users.index', compact('labels','users','messageConfLock','messageConfUnLock','userPermissions'));
    }

    public function create()
    {

        $screen_id = "1";
        $controller_name = 'UserController';
        $action_name = 'store';
        $command_id = '1';
        $command_type_id = '1';

        is_permitted($screen_id, $controller_name, $action_name, $command_id, $command_type_id);
        $staff = StaffNotUserVW::pluck('staff_name_na','id');

        $labels = inputButton(Auth::user()->lang_id ,0);
        $userPermissions = getUserPermission();

        return view('permission.users.create',compact('labels','staff','userPermissions'));
    }


    public function store()
    {


        $screen_id = "1";
        $controller_name = 'UserController';
        $action_name = 'store';
        $command_id = '1';
        $command_type_id = '1';

        is_permitted($screen_id, $controller_name, $action_name, $command_id, $command_type_id);


        $data = $this->validate(request(), [
            'user_name' => 'required|string|between:6,30|unique:users,user_name',
            'user_full_name' => 'required|between:6,100',
            'job_title' => ' ',
            'staff_id' => 'required|unique:users,staff_id',
            'notes' => ' ',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [],[
            'user_name' => 'UserName',
            'user_full_name' => 'User Full Name',
            'job_title' => 'Job Title ',
            'staff_id' => 'Staff Name',
            'notes' => 'Notes',
            'email' => 'Email',
            'password' => 'Password',
        ]);
         $data['password'] = bcrypt($data['password']);

        $user = User::create($data);


        $array=['message' =>'Data Saved successfully'];
        session(['array' => $array]);


        return redirect()->route('permission.user.index');

    }


    public function edit($id)
    {

        is_permitted('1', 'UserController', 'update', '2', '2');

        $user = user::find($id);
        $labels = inputButton(Auth::user()->lang_id ,0);
        $projects = Project::where('is_hidden',0)->get();
        $activities = Activity::where('is_hidden',0)->get();

        $user_data_perms = UserDataPermission::where('user_id',$id)->get();
        $user_data_perms_modules = UserDataPermissionModule::where('user_id',$id)->get();

        $staff_not_user = StaffNotUserVW::get();
        if($staff_not_user){
            $staff_not_user = $staff_not_user->pluck('staff_name_na','id')->toArray();
        }else{
            $staff_not_user =[];
        }



        $staff_this_user = StaffUserVW::where('id',$user->staff_id)
            ->first();

          if($staff_this_user){
            $staff_this_user = StaffUserVW::where('id',$user->staff_id)
                ->pluck('staff_name_na','id')
                ->toArray();
         }else{
            $staff_this_user =[];
        }


         if(count($staff_not_user) > 0 && count($staff_this_user) >0){
              foreach($staff_this_user as $key=>$staff_user){
                   $staff_not_user[$key]= $staff_user;
              }
             $staff =$staff_not_user;
        }else if(count($staff_not_user) > 0 && count($staff_this_user) ==0){
            $staff =$staff_not_user;
        }else if(count($staff_this_user) == 0 && count($staff_this_user) >0){
            $staff =$staff_this_user;
        }
         $userPermissions = getUserPermission();

        return view('permission.users.edit', compact('staff','user','labels','userPermissions','projects','activities','user_data_perms','user_data_perms_modules'));
    }


    public function update(Request $request)
    {

        is_permitted('1', 'UserController', 'update', '2', '2');

        $user_id = $request->get('id');
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'user_name' => 'required|string|between:6,30|unique:users,user_name,' . $user_id,
            'user_full_name' => 'required|between:6,100',
            'job_title' => ' ',
            'notes' => ' ',
            'staff_id' => 'required|unique:users,staff_id,'. $user_id,
            'email' => 'required|email|unique:users,email,' . $user_id,
            'password' => 'confirmed',
        ], [],[
            'user_name' => 'UserName',
            'user_full_name' => 'User Full Name',
            'job_title' => 'Job Title ',
            'staff_id' => 'Staff Name',
            'notes' => 'Notes',
            'email' => 'Email',
            'password' => 'Password',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();
        $user = User::find($input['id']);

        $user->user_name = $input['user_name'];
        $user->user_full_name = $input['user_full_name'];
        $user->job_title = $input['job_title'];
        $user->notes = $input['notes'];
        $user->email = $input['email'];
        $user->staff_id = $input['staff_id'];
        $user->user_type = $input['user_type'];

        if (!$input['password'] == null) {
            $user->password = bcrypt($input['password']);
            $user->pass_change_flag = 0;
        }
        $user->save();



        $array=['message' =>'Data edited successfully'];
        session(['array' => $array]);
        return redirect()->route('permission.user.index');

    }


    public function createChangePassword()
    {
        $labels = inputButton(Auth::user()->lang_id ,0);
        $userPermissions = getUserPermission();

        return view('permission.users.changePassword',compact('labels','userPermissions'));
    }

    public function storeChangePassword(Request $request)
    {
        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
// The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }
        if (strcmp($request->get('old-password'), $request->get('password')) == 0) {
//Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }

        $validator = $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'old_password' => 'required',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->get('password'));
        $user->pass_change_flag = 1;
        $user->save();

        $array=['message' =>'Your password has been successfully modified'];
        session(['array' => $array]);
        return redirect()->route('home');

    }

    public function showMyProfile()
    {
        $user = Auth::user();

        $labels = inputButton(Auth::user()->lang_id ,0);

        $userPermissions = getUserPermission();

        return view('permission.users.showMyProfile', compact('labels','user','userPermissions'));
    }

    public function editMyProfile()
    {
        $user = Auth::user();
        $labels = inputButton(Auth::user()->lang_id ,0);
        $userPermissions = getUserPermission();

        return view('permission.users.editMyProfile', compact('labels','user','userPermissions'));
    }

    public function updateMyProfile(Request $request)
    {

        $user = Auth::user();
        $validator = $request->validate([
            'user_name' => 'required|string|between:6,30|unique:users,user_name,' . $user->id,
            'user_full_name' => 'required|between:6,100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'job_title' => 'required',
            'user_photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        $user->fill($input);

        $path = public_path('images/user/photo/');
        if ($request->has('user_photo')) {
            $imageName = time() . '.' . $request->file('user_photo')->getClientOriginalExtension();
            $request->file('user_photo')->move($path, $imageName);
            $user->user_photo = $imageName;
        }


        $user->save();
        return redirect()->back();

    }



    public function userStatus(){
        $user_id = request()->get('user_id');
        $user = User::find($user_id);
        $icon ="";
        if($user->user_status_id == 1) {
            $user->user_status_id = 3;
            $icon ="lock";
        } elseif($user->user_status_id == 3){
            $user->user_status_id = 1;
            $icon ="lock_open";
        }
        $user->save();

        return $icon;

    }

    public function changeLang(){
        $user = Auth::user();
        if($user->lang_id == 1){
            $user->lang_id = 2;
        } else {
            $user->lang_id = 1;
        }
        $user->save();
         return redirect()->back();
    }


    public function updateDataPerms(Request $request)
    {
        $input = $request->all();

        if(!empty($input['user_id'])){
            if(!empty($input['projects_perms_type'])){
                $user_proj_perm = UserDataPermission::where('user_id',$input['user_id'])
                    ->where('module_id',1)
                    ->first();
                if($user_proj_perm != null){
                    $user_proj_perm->perm_type = $this->getPermID($input['projects_perms_type']);
                    $user_proj_perm->save();
                } else {
                    $user_proj_perm = new UserDataPermission();
                    $user_proj_perm->user_id = $input['user_id'];
                    $user_proj_perm->module_id = 1;
                    $user_proj_perm->perm_type = $this->getPermID($input['projects_perms_type']);
                    $user_proj_perm->save();
                }
                if($input['projects_perms_type'] == 'some'){
                    if(!empty($input['permitted_projects']) && is_array($input['permitted_projects']) && count($input['permitted_projects']) > 0){
                        UserDataPermissionModule::where('user_id',$input['user_id'])->where('module_id',1)->delete();
                        foreach ($input['permitted_projects'] as $permitted_project){
                            $user_proj_perm_module = new UserDataPermissionModule();
                            $user_proj_perm_module->user_id = $input['user_id'];
                            $user_proj_perm_module->module_id = 1;
                            $user_proj_perm_module->primary_id = $permitted_project;
                            $user_proj_perm_module->save();
                        }
                    } else {
                        return response(['success' => true,'message' => getMessage('2.163')]);
                    }
                }
            }
            if(!empty($input['activities_perms_type'])){
                $user_acti_perm = UserDataPermission::where('user_id',$input['user_id'])
                    ->where('module_id',2)
                    ->first();
                if($user_acti_perm != null) {
                    $user_acti_perm->perm_type = $this->getPermID($input['activities_perms_type']);
                    $user_acti_perm->save();
                } else {
                    $user_acti_perm = new UserDataPermission();
                    $user_acti_perm->user_id = $input['user_id'];
                    $user_acti_perm->module_id = 2;
                    $user_acti_perm->perm_type = $this->getPermID($input['activities_perms_type']);
                    $user_acti_perm->save();
                }

                if($input['activities_perms_type'] == 'some'){
                    if(!empty($input['permitted_activities']) && is_array($input['permitted_activities']) && count($input['permitted_activities']) > 0){
                        UserDataPermissionModule::where('user_id',$input['user_id'])->where('module_id',2)->delete();
                        foreach ($input['permitted_activities'] as $permitted_activity){
                            $user_acti_perm_module = new UserDataPermissionModule();
                            $user_acti_perm_module->user_id = $input['user_id'];
                            $user_acti_perm_module->module_id = 2;
                            $user_acti_perm_module->primary_id = $permitted_activity;
                            $user_acti_perm_module->save();
                        }
                    } else {
                        return response(['success' => true,'message' => getMessage('2.162')]);
                    }
                }
            }

            return response(['success' => true,'message' => getMessage('2.161')]);
        }
    }

    public function getPermID($permStr){
        switch ($permStr){
            case 'all':
                return 1;
                break;
            case 'some':
                return 2;
                break;
            case 'inc':
                return 3;
                break;
        }
    }

//    public function logout(){
//         deleteActivity();
//        deleteTask();
//       // $this->guard()->logout();
//
////        $request->session()->invalidate();
//        session()->invalidate();
//
//        return redirect('/');
//    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function staff_ajax($id){
        $staff = StaffNotUserVW::find($id);
        if(!$staff){
            $staff = StaffUserVW::find($id);
        }
        return $staff;
    }
}
