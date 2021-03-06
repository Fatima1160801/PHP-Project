<?php


namespace App\Http\Controllers\Setting\C;



use App\Http\Controllers\Controller;
use App\Models\Project\Currencies;
use App\Models\Project\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting\C\City;

use App\Helpers\Log;

class CurrencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        is_permitted(107, getClassName(__CLASS__), 'index', 160, 7);

        $currencies = Currencies::all();
        $messageDeleteCity = getMessage('2.181');
        $labels = inputButton(Auth::user()->lang_id, 0);
        $userPermissions = getUserPermission();
        $id = 1;
        if ($request->ajax()) {
            $id = 2;
            $html = view('setting.c.currency.table_render', compact('labels', 'currencies', 'messageDeleteCity', 'userPermissions', 'id'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('setting.c.currency.index', compact('labels', 'currencies', 'messageDeleteCity', 'userPermissions', 'id'));
        }
    }

    public function getCreate(Request $request)
    {
       is_permitted(107, getClassName(__CLASS__),'store', 161, 1);
        $option = [ 'currency_name_na' => ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-5', 'col_input_Class' => 'col-md-7'],
            'currency_name_fo' => ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-5', 'col_input_Class' => 'col-md-7'
            ],'currency_symbol' => ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-5', 'col_input_Class' => 'col-md-7']
        ];
        $currency = new Currencies();
        $generator = generator(107, $option, $currency);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=1;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('setting.c.currency.create_render', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('setting.c.currency.create', compact('labels','html','userPermissions','save','id'));
    }


    public function store(Request $request)
    {
        is_permitted(107, getClassName(__CLASS__),'store', 161, 1);

        $input = $request->all();
        $data = fieldInDatabase(107, $input);

        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $currency = new Currencies();
        $currency->fill($field);
        $currency->created_by = Auth::id();
        $currency->save();

        Log::instance()->record('2.24',null,107,null,null,null,null);
        Log::instance()->save();

        notifications(getClassName(__CLASS__),__FUNCTION__,route('settings.cities.edit',$currency->id));

        return response(['status' => 'true', 'message' => getMessage('2.1'),'city'=>$currency]);
    }


    public function getEdit(Request $request,$id)
    {
      is_permitted(107, getClassName(__CLASS__),'update', 162, 2);

        $option = [ 'currency_name_na' => ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-5', 'col_input_Class' => 'col-md-7'],
            'currency_name_fo' => ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-5', 'col_input_Class' => 'col-md-7'
            ],'currency_symbol' => ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-5', 'col_input_Class' => 'col-md-7']
        ];

        $currency = Currencies::find($id);

        $generator = generator(107, $option, $currency);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=2;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('setting.c.currency.create_render', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('setting.c.currency.update', compact('labels','html','userPermissions'));
    }


    public function update(Request $request)
    {
        is_permitted(107, getClassName(__CLASS__),'update', 162, 2);

        $input = $request->all();
        $data = fieldInDatabase(107, $input);

        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $currency = Currencies::find($field['id']);
        $currency->fill($field);
        $currency->updated_by = Auth::id();
        Log::instance()->record('2.25',$field['id'],107,null,null,$field,$currency);
        Log::instance()->save();
        $currency->save();

        notifications(getClassName(__CLASS__),__FUNCTION__,route('settings.cities.edit',$currency->id));

        return response(['success' => true,'message' => getMessage('2.2'),'city'=>$currency]);
    }


    public function delete($id)
    {
         is_permitted(107, getClassName(__CLASS__),'delete', 163, 4);

        try {
            $projects = Project::where('currency_id', $id)->whereNull('deleted_at')->get()->count();
            if ($projects >0) {
                $message = getMessage('2.196');
                return response(['status' => 'false', 'message' => $message]);
            } else {
            Currencies::where('id', $id)->delete();
            $message = getMessage('2.3');
            Log::instance()->record('2.26',$id,107,null,null,null,null);
            Log::instance()->save();
            notifications(getClassName(__CLASS__),__FUNCTION__,'');
            return response(['status' => 'true', 'message' => $message]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.196');
            return response(['status' => 'false', 'message' => $message]);
        }
    }


}