<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Donor\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Donor\DonorType;

use App\Helpers\Log;

class DonorTypeController extends Controller
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

    public function index()
    {
        is_permitted('7', 'DonorTypeController', 'index', '27', '7');

        $donorstypes = DonorType::get();
        $messageDeleteDonorTypet  =getMessage('2.49');
        $labels = inputButton(Auth::user()->lang_id ,7);
        $userPermissions = getUserPermission();

        return view('project.donors.types.index', compact('labels','donorstypes','messageDeleteDonorTypet','userPermissions'));
    }

    public function create()
    {
        is_permitted('7', 'DonorTypeController', 'store', '28', '1');
        $donorType = new DonorType();
        $type_name_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $type_name_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $type_desc_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10', 'html_type' => '3'];
        $type_desc_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10', 'html_type' => '3'];
        $option = [
            'type_name_na' => $type_name_na,
            'type_name_fo' => $type_name_fo,
            'type_desc_na' => $type_desc_na,
            'type_desc_fo' => $type_desc_fo,
        ];
        $generator = generator(7, $option, $donorType);
        $html =$generator[0];
        $labels =$generator[1];
        $userPermissions = getUserPermission();

        return view('project.donors.types.create', compact('html','labels','userPermissions'));
    }

    public function store(Request $request)
    {
        is_permitted('7', 'DonorTypeController', 'store', '28', '1');

        $input = $request->all();
        $data = fieldInDatabase(7, $input);
        $optionValidator = [];
        inputValidator($data, $optionValidator);

        $field = $data['field'];
        $donorstype = new DonorType();
        $donorstype->fill($field);
        $donorstype->save();

        Log::instance()->record('2.58',null,7,null,null,null,null);
        Log::instance()->save();

        notifications(getClassName(__CLASS__),__FUNCTION__,route('project.donors.types.edit',$donorstype->id));

        $array = ['text' => 'Data saved successfully'];
        session(['array' => $array]);
        return redirect()->route('project.donors.types.index');
    }

    public function edit($id)
    {
        is_permitted('7', 'DonorTypeController', 'update', '29', '2');

        $donorType = DonorType::find($id);
        $type_name_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $type_name_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $type_desc_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10', 'html_type' => '3'];
        $type_desc_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10', 'html_type' => '3'];
        $is_hidden = ['selectArray' => ['0' => 'Active', '1' => 'unActive'], 'html_type' => '5'];
        $id = ['html_type' => '10'];
        $option = [
            'type_name_na' => $type_name_na,
            'type_name_fo' => $type_name_fo,
            'type_desc_na' => $type_desc_na,
            'type_desc_fo' => $type_desc_fo,
            'is_hidden' => $is_hidden,
            'id' => $id,
        ];
        $generator = generator(7, $option, $donorType);
        $html =$generator[0];
        $labels =$generator[1];
        $userPermissions = getUserPermission();

        return view('project.donors.types.edit', compact('html','labels','userPermissions'));
    }

    public function update(Request $request)
    {
        is_permitted('7', 'DonorTypeController', 'update', '29', '2');

        $input = $request->all();

        $data = fieldInDatabase(7, $input);
        $optionValidator = [];
        inputValidator($data, $optionValidator);

        $field = $data['field'];
        $donorstype = DonorType::find($field['id']);
        Log::instance()->record('2.59',$field['id'],7,null,null,$field,$donorstype);
        $donorstype->fill($field);
        Log::instance()->save();
        $donorstype->save();

        notifications(getClassName(__CLASS__),__FUNCTION__,route('project.donors.types.edit',$donorstype->id));

        $array = ['text' => 'Data Updated successfully'];
        session(['array' => $array]);
        return redirect()->route('project.donors.types.index');
    }

    public function destroy($id)
    {
        is_permitted('7', 'DonorTypeController', 'destroy', '30', '4');
        $donorsCount = Donor::where('donor_type_id',$id)->get()->count();
        if($donorsCount >0){
            $message=getMessage('2.48');
            return response(['status'=>'false','message'=>$message]);
        } else {
            $donorstype = DonorType::find($id);
            $donorstype->delete();
            Log::instance()->record('2.61',null,7,null,null,null,null);
            Log::instance()->save();
            notifications(getClassName(__CLASS__),__FUNCTION__,'');
            $message = getMessage('2.3');
            return response(['status'=>'true','message'=>$message]);
        }
//        return redirect()->route('project.donors.types.index')->with('array',$array);
    }

    public function getDesc($id){
        $donorType = DonorType::find($id);
        return response($donorType);
    }
}
