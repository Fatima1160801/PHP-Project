<?php

namespace App\Http\Controllers;

use App\Models\Permission\User;
use App\Models\Setting\UserDashboardBlocksSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
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
        $userDashboardBlocksSetting = UserDashboardBlocksSetting::where('user_id', Auth::id())->pluck('block_id')->toArray();
        $userPermissions = getUserPermission();
        $users = User::all();
        $labels = inputButton(Auth::user()->lang_id, 0);

        return view('home', compact(
            'labels',  'userDashboardBlocksSetting', 'dashboardBlocks','userPermissions'));
    }

}
