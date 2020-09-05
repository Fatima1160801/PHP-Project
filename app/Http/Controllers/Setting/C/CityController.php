<?php


namespace App\Http\Controllers\Setting\C;


use App\Http\Controllers\Controller;
use App\Models\Activity\ActivityLocationView;
use App\Models\Activity\Location;
use App\Models\Beneficiary\BeneficiaryOrganization;
use App\Models\Locality\Locality;
use App\Models\Project\ProjectCities;
use App\Models\Setting\C\District;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting\C\City;

use App\Helpers\Log;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        is_permitted(48, getClassName(__CLASS__), __FUNCTION__, 209, 7);
        $cities = City::all();
        $count=City::all()->count();
        $messageDeleteCity = getMessage('2.86');
        $labels = inputButton(Auth::user()->lang_id, 48);
        $userPermissions = getUserPermission();
        $id=1;
        if($request->ajax()){
            $id=2;
            $html = view('setting.c.city.render_table', compact('labels', 'cities', 'messageDeleteCity', 'userPermissions','id','count'))->render();
            return response(['status' => true, 'html' =>$html]);
        }else{
            return view('setting.c.city.index', compact('labels', 'cities', 'messageDeleteCity', 'userPermissions','id','count'));
        }

     }


    public function getCreate(Request $request)
    {
        is_permitted(48, getClassName(__CLASS__), 'store', 121, 1);

        $option = ['city_name_no' => ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-7'],
            'city_name_fo'=>['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-5', 'col_input_Class' => 'col-md-7']
        ];

        $city = new City();

        $generator = generator(48, $option, $city);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=1;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('setting.c.city.render_create', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('setting.c.city.create', compact('labels', 'html', 'userPermissions','save','id'));
    }


    public function store(Request $request)
    {
        is_permitted(48, getClassName(__CLASS__), __FUNCTION__, 121, 1);

        $input = $request->all();
        $data = fieldInDatabase(48, $input);

        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $city = new City();
        $city->fill($field);
        $city->created_by = Auth::id();
        $city->is_hidden =0;
        $city->save();
        $count=City::all()->count();
        Log::instance()->record('2.24', null, 48, null, null, null, null);
        Log::instance()->save();

        notifications(getClassName(__CLASS__), __FUNCTION__, route('settings.cities.edit', $city->id));

        return response(['status' => 'true', 'message' => getMessage('2.87'),'city'=>$city,'count'=>$count]);
    }


    public function getEdit(Request $request,$id)
    {
        is_permitted(48, getClassName(__CLASS__), 'update', 122, 2);

        $option = ['city_name_no' => ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-7'],
            'city_name_fo'=>['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-5', 'col_input_Class' => 'col-md-7']
        ];

        $city = City::find($id);
$save=2;
$id=1;
        $generator = generator(48, $option, $city);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        if($request->ajax()){
            $id=2;
            $html =view('setting.c.city.render_create', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('setting.c.city.update', compact('labels', 'html', 'userPermissions','save','id'));
    }


    public function update(Request $request)
    {
        is_permitted(48, getClassName(__CLASS__), __FUNCTION__, 122, 2);

        $input = $request->all();
        $data = fieldInDatabase(48, $input);

        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $city = City::find($field['id']);
        $city->fill($field);
        $city->updated_by = Auth::id();
        Log::instance()->record('2.25', $field['id'], 48, null, null, $field, $city);
        Log::instance()->save();
        $city->save();

        notifications(getClassName(__CLASS__), __FUNCTION__, route('settings.cities.edit', $city->id));

        return response(['success' => true, 'message' => getMessage('2.88'),'city'=>$city]);
    }


    public function delete($id)
    {
        is_permitted(48, getClassName(__CLASS__), __FUNCTION__, 123, 4);



        try {
            $ActivityLocationView = Location::where('city_id', $id)->whereNull('deleted_at')->get()->count();
            $District = District::where('city_id', $id)->whereNull('deleted_at')->get()->count();
            $Locality = Locality::where('city_id', $id)->whereNull('deleted_at')->get()->count();
            $Visit = Visit::where('city_id', $id)->whereNull('deleted_at')->get()->count();
            $BeneficiaryOrganization = BeneficiaryOrganization::where('city_id', $id)->whereNull('deleted_at')->get()->count();
            $ProjectCities = ProjectCities::where('city_id', $id)->get()->count();
            if ($ActivityLocationView > 0 || $District > 0 ||
                $Locality > 0 || $Visit > 0 || $BeneficiaryOrganization > 0 || $ProjectCities > 0) {

                $message = getMessage('2.189');

                return response(['status' => 'false', 'message' => $message]);
            } else {
                City::where('id', $id)->delete();
                $message = getMessage('2.3');
                Log::instance()->record('2.26', $id, 48, null, null, null, null);
                Log::instance()->save();
                notifications(getClassName(__CLASS__), __FUNCTION__, '');
                return response(['status' => 'true', 'message' => $message]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.189');
            return response(['status' => 'false', 'message' => $message]);
        }
    }


}