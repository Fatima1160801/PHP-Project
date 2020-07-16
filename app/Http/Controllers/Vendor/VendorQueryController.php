<?php

namespace App\Http\Controllers\Vendor;

use App\Helpers\Log;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Procurement\Brand;
use App\Models\Vendor\City;
use App\Models\Vendor\ContactPersons;
use App\Models\Vendor\Vendor;
use App\Models\Vendor\Vendor_Sector;
use App\Models\Vendor\JobTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;

class VendorQueryController extends Controller
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

        is_permitted(149, getClassName(__CLASS__), __FUNCTION__, 330, 7);



        $option = [


        ];
        $vendorObj= new Vendor();
        $generator = generator(149, $option, $vendorObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('vendorss.vendor1.vendorquery', compact('labels', 'html', 'userPermissions'));
    }

}