<?php

namespace App\Http\Controllers\Setting\Opportunity;

use App\Helpers\Log;
use App\Http\Controllers\Permission\PermissionController;
use App\Http\Controllers\Controller;

use App\Models\Setting\Intface;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;

class InterfaceController extends Controller
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

        is_permitted(115, getClassName(__CLASS__), __FUNCTION__, 242, 7);
        $interfaces = Intface::where('created_by', Auth::id())->orderby('id', 'desc')->get();
        $messageDeleteType = getMessage('2.204');
        $labels = inputButton(Auth::user()->lang_id, 115);
        $userPermissions = getUserPermission();
        return view('setting.opportunity.interface.index', compact('labels', 'interfaces', 'messageDeleteType', 'userPermissions'));
    }

    public function create($type = null, $id = null)
    {
        is_permitted(115, getClassName(__CLASS__), __FUNCTION__, 243, 1);


        $option = [
             'interface_type_na' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
              'interface_type_fo' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        ];
        $interfaces = new Intface();
        // $selectArray = [0=>'No',1=>'Yes'];

        // $option = [ 
        //             'is_hidden'=>['selectArray'=>$selectArray,'html_type'=>'5'],
        //         ];
        $generator = generator(115, $option, $interfaces);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('setting.opportunity.interface.create', compact('labels', 'html', 'userPermissions'));
    }

    public function store(Request $request)
    {
        is_permitted(115, getClassName(__CLASS__), __FUNCTION__, 243, 1);

        $input = $request->all();

       $data = fieldInDatabase(115, $input);
       $field = $data['field'];

        // $optionValidator = [
        //     'file' => [
        //         'required' => 'false',
        //         'max' => 'max:10000',
        //         'mimes' => 'mimes:jpg,jpeg,png,PNG,JPG,pdf,PDF,JPG,docx,doc,csv,xls,xlsx,txt,ppt,zip,rar'
        //     ],
        //     'date_visits' => [
        //         'date' => 'false',
        //         'date_format' => 'date_format:"d/m/Y"'
        //     ],
        // ];

       $optionValidator=[];
       inputValidator($data, $optionValidator);

        $interface = new Intface();
        $interface->fill($field);
        $interface->created_by = Auth::id();


        // $path = public_path('images/visit');
        // if ($request->has('file')) {
        //     $imageName = time() . '.' . $request->file('file')->getClientOriginalExtension();
        //     $request->file('file')->move($path, $imageName);
        //     $visit->file = $imageName;
        // }
        $interface->save();

        Log::instance()->record('2.210', null, 115, null, null, null, null);
        Log::instance()->save();

        // notifications(getClassName(__CLASS__), __FUNCTION__, route('interfaces.edit', $interface->id));
       
        return response(['status' => 'true', 'message' => getMessage('2.1')]);


    }

    public function edit($interface_id)
    {
        is_permitted(115, getClassName(__CLASS__), __FUNCTION__, 244, 2);


        
         if (Auth::user()->lang_id == 1) 
            $selectArray=[0=>'active',1=>'inactive'];
        else 
            $selectArray=[0=>'فعال',1=>'غير فعال'];

        $option = [
            'is_hidden'=>['selectArray'=>$selectArray,'html_type'=>'5'],
             'interface_type_na' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
              'interface_type_fo' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        ];
        
        $interface = Intface::find($interface_id);
        $generator = generator(115, $option, $interface);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
         return view('setting.opportunity.interface.edit', compact('labels', 'html', 'userPermissions', 'interface'));
    }

    public function update(Request $request)
    {
        is_permitted(115, getClassName(__CLASS__), __FUNCTION__, 244, 2);

        $input = $request->all();
        $data  = fieldInDatabase(115, $input);
        $field = $data['field'];

        $id    = $field['id'];
        // $optionValidator = [
        //     'file' => [
        //         'required' => 'false',
        //         'max' => 'max:10000',
        //         'mimes' => 'mimes:jpg,jpeg,png,PNG,JPG,pdf,PDF,JPG,docx,doc,csv,xls,xlsx,txt,ppt,zip,rar'
        //     ], 'date_visits' => [
        //         'date' => 'false',
        //         'date_format' => 'date_format:"d/m/Y"'
        //     ],
        // ];

        $optionValidator = [
        ];
        inputValidator($data, $optionValidator);
        $interface = Intface::find($id);
        $old_interface = $interface;
        $interface->fill($field);

        $interface->updated_by = Auth::id();
        // dd($field['is_hidden']);
        $interface->save();

        Log::instance()->save();

        notifications(getClassName(__CLASS__), __FUNCTION__, route('interfaces.edit', $interface->id));
        return response(['status' => 'true', 'message' => getMessage('2.2')]);


    }

    public function delete($id)
    {
        // dd(20);
        is_permitted(115, getClassName(__CLASS__), __FUNCTION__, 245, 4);
        try {
            $interface = Intface::find($id);
            $interface->deleted_by = Auth::id();
            $interface->delete();
            $message = getMessage('2.3');
            Log::instance()->record('2.212', $id, 115, null, null, null, null);
            Log::instance()->save();
            notifications(getClassName(__CLASS__), __FUNCTION__, '');
            return response(['status' => 'true', 'message' => $message]);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.3');
            return response(['status' => 'false', 'message' => $message]);
        }
    }



}