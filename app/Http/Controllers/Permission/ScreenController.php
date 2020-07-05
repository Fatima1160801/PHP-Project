<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Models\Permission\Modules;
use App\Models\Permission\GroupPermission;
use App\Models\Permission\ScreenCommand;
use App\Models\Permission\UserPermission;
use App\Models\Permission\Screen;
use App\Models\Permission\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScreenController extends Controller
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

    public function index($module_id)
    {

        $screen = Screen::where('module_id', $module_id)->get();
        $labels = inputButton(Auth::user()->lang_id ,0);
        $userPermissions = getUserPermission();

        return view('permission.screen.index', compact('labels','screen','userPermissions'));
    }


    public function screenUser($screen_id)
    {
        $users = User::pluck('user_full_name', 'id');
        $screen = Screen::find($screen_id);
        $userPermissions = getUserPermission();
        return view('permission.screen.user', compact('users', 'screen','userPermissions'));
    }

    public function screenCommand($screen_id, $user_id)
    {
        $user = User::find($user_id);
        $screen = Screen::find($screen_id);
        $commands = ScreenCommand::where('screen_id', $screen_id)->get();
        $userPermissions = getUserPermission();
        return view('permission.screen.screencommand', compact('user', 'commands', 'screen','userPermissions'));
    }


}


