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
        $lang=Auth::user()->lang_id;
        $userPermissions = getUserPermission();
        return view('setting.settingsScreens.locatinsSettings',compact('userPermissions','lang'));
    }
    public function usersSettings(){
        $lang=Auth::user()->lang_id;
        $userPermissions = getUserPermission();
        return view('setting.settingsScreens.usersAndStaffSettings',compact('userPermissions','lang'));
    }
    public function documentSettings(){
        $lang=Auth::user()->lang_id;
        $userPermissions = getUserPermission();
        return view('setting.settingsScreens.documentsSettings',compact('userPermissions','lang'));
    }
    public function systemSettings(){
        $lang=Auth::user()->lang_id;
        $userPermissions = getUserPermission();
        return view('setting.settingsScreens.systemSettings',compact('userPermissions','lang'));
    }
    public function otherSettings(){
        $lang=Auth::user()->lang_id;
        $userPermissions = getUserPermission();
        return view('setting.settingsScreens.otherSettings',compact('userPermissions','lang'));
    }
    public function general(){
        $userPermissions = getUserPermission();
        $lang=Auth::user()->lang_id;
        return view('setting.settingsScreens.general',compact('userPermissions','lang'));
    }
}