<?php


namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\IncomeRange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\Log;

class IncomeRangeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        is_permitted(66, getClassName(__CLASS__), 'index', 140, 7);

        $incomeRanges = IncomeRange::all();
        $messageDelete = getMessage('2.114');
        $labels = inputButton(Auth::user()->lang_id, 66);
        $userPermissions = getUserPermission();
        $id = 1;
        if ($request->ajax()) {
            $id = 2;
            $html = view('setting.incomeRange.table_render', compact('labels', 'incomeRanges', 'messageDelete', 'userPermissions', 'id'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('setting.incomeRange.index', compact('labels', 'incomeRanges', 'messageDelete', 'userPermissions', 'id'));
        }
    }
    public function create(Request $request)
    {
         is_permitted(66, getClassName(__CLASS__),'store', 141, 1);

        $option = [
            'income_name_na' => ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'],
            'income_name_fo' => ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8']
           , 'is_hidden' =>['html_type'=>'13']
        ];

        $incomeRanges = new IncomeRange();

        $generator = generator(66, $option, $incomeRanges);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=1;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('setting.incomeRange.render_create', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('setting.incomeRange.create', compact('labels','html','userPermissions','save','id'));
    }


    public function store(Request $request)
    {
        is_permitted(66, getClassName(__CLASS__),'store', 141, 1);

        $input = $request->all();
        $data = fieldInDatabase(66, $input);

        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $incomeRanges = new IncomeRange();
        $incomeRanges->fill($field);
        $incomeRanges->created_by = Auth::id();
        $incomeRanges->save();

        Log::instance()->record('2.201',null,66,null,null,null,null);
        Log::instance()->save();

        notifications(getClassName(__CLASS__),__FUNCTION__,route('settings.incomeRange.edit',$incomeRanges->id));

        return response(['success' => true, 'message' => getMessage('2.1'),'city'=>$incomeRanges]);
    }


    public function edit(Request $request,$id)
    {
    is_permitted(66, getClassName(__CLASS__),'update', 142, 2);

        $option = [
            'income_name_na' => ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'],
            'income_name_fo' => ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'],
            'is_hidden' => ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8','selectArray' => ['0' => 'Active', '1' => 'Inactive']]
        ];

        $incomeRange = IncomeRange::find($id);
        $generator = generator(66, $option, $incomeRange);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=2;
        if($request->ajax()){
            $id=2;
            $html =view('setting.incomeRange.render_create', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('setting.incomeRange.edit', compact('labels','html','userPermissions','save','id'));
    }


    public function update(Request $request)
    {
       is_permitted(66, getClassName(__CLASS__),'update', 142, 2);

        $input = $request->all();
        $data = fieldInDatabase(66, $input);

        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);
        $field = $data['field'];
        $incomeRange = IncomeRange::find($field['id']);
        $incomeRange->fill($field);
        $incomeRange->updated_by = Auth::id();
        Log::instance()->record('2.202',$field['id'],66,null,null,$field,$incomeRange);
        Log::instance()->save();
        $incomeRange->save();
        notifications(getClassName(__CLASS__),__FUNCTION__,route('settings.incomeRange.edit',$incomeRange->id));
        return response(['success' => true,'message' => getMessage('2.2'),'city'=>$incomeRange]);
    }


    /*public function delete($id)
    {
       // is_permitted(66, getClassName(__CLASS__),'delete, 143, 4);

        try {
            District::where('id', $id)->delete();
            $message = getMessage('2.94');
            Log::instance()->record('2.29',$id,66,null,null,null,null);
            Log::instance()->save();
            notifications(getClassName(__CLASS__),__FUNCTION__,'');
            return response(['status' => 'true', 'message' => $message]);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.24');
            return response(['status' => 'false', 'message' => $message]);
        }
    }*/

}