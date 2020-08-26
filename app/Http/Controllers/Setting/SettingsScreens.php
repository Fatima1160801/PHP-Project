<?php


namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Activity\Location;
use App\Models\Beneficiary\BeneficiaryOrganization;
use App\Models\Locality\Locality;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting\C\City;
use App\Models\Setting\C\District;

use App\Helpers\Log;

class SettingsScreens extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function locationsSettings(){
        $userPermissions = getUserPermission();
        return view('setting.settingsScreens.locatinsSettings',compact('userPermissions'));
    }
    public function usersSettings(){
        $userPermissions = getUserPermission();
        return view('setting.settingsScreens.usersAndStaffSettings',compact('userPermissions'));
    }
    public function documentSettings(){
        $userPermissions = getUserPermission();
        return view('setting.settingsScreens.documentsSettings',compact('userPermissions'));
    }
    public function systemSettings(){
        $userPermissions = getUserPermission();
        return view('setting.settingsScreens.systemSettings',compact('userPermissions'));
    }
    public function otherSettings(){
        $userPermissions = getUserPermission();
        return view('setting.settingsScreens.otherSettings',compact('userPermissions'));
    }
    public function general(){
        $userPermissions = getUserPermission();
        $lang=Auth::user()->lang_id;
        return view('setting.settingsScreens.general',compact('userPermissions','lang'));
    }
}