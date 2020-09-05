<?php


namespace App\Http\Controllers\Setting\C;

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

class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        is_permitted(49, getClassName(__CLASS__), __FUNCTION__, 124, 7);
$id=1;
        $districts = District::latest()->take(30)->get();;
       $messageDeleteDistrict = getMessage('2.1');
        $labels = inputButton(Auth::user()->lang_id, 49);
        $userPermissions = getUserPermission();
        $count=District::all()->count();
        if($request->ajax()){
            $id=2;
            $html = view('setting.c.district.render_table', compact('labels', 'districts', 'messageDeleteDistrict', 'userPermissions','id','count'))->render();
            return response(['status' => true, 'html' =>$html]);
        }else{
            return view('setting.c.district.index', compact('labels', 'districts', 'messageDeleteDistrict', 'userPermissions','id','count'));
        }
    }

    public function getCreate(Request $request)
    {
        is_permitted(49, getClassName(__CLASS__), 'store', 125, 1);

        $option = [
            'city_id' => ['relatedWhere' => ' deleted_at is null', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-4']
            , 'longitude' => ['inputClass' => 'check-is-number']
            , 'latitude' => ['inputClass' => 'check-is-number']
        ];

        $district = new District();
$save=1;
$id=1;
        $generator = generator(49, $option, $district);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        if($request->ajax()){
            $id=2;
            $html =view('setting.c.district.render_create', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('setting.c.district.create', compact('labels', 'html', 'userPermissions','save','id'));
    }


    public function store(Request $request)
    {
        is_permitted(49, getClassName(__CLASS__), __FUNCTION__, 125, 1);

        $input = $request->all();
        $data = fieldInDatabase(49, $input);

        $optionValidator = [
            'longitude' => [
                'nullable' => 'nullable'
            ],
            'latitude' => [
                'nullable' => 'nullable'
            ],

        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $district = new District();
        $district->fill($field);
        $district->is_hidden = 0;
        $district->created_by = Auth::id();
        $district->save();
        $city=City::where('id',$district->city_id)->first();
        $count=District::all()->count();
        Log::instance()->record('2.27', null, 49, null, null, null, null);
        Log::instance()->save();

        notifications(getClassName(__CLASS__), __FUNCTION__, route('settings.districts.edit', $district->id));

        return response(['success' => true, 'message' => getMessage('2.1'),'district'=>$district,'cityname'=>$city->city_name_no,'count'=>$count,'citynamefo'=>$city->city_name_fo]);
    }


    public function getEdit(Request $request,$id)
    {
        is_permitted(49, getClassName(__CLASS__), 'update', 126, 2);

        $option = [
            'city_id' => ['relatedWhere' => ' deleted_at is null', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-4']
            , 'longitude' => ['inputClass' => 'check-is-number']
            , 'latitude' => ['inputClass' => 'check-is-number']
        ];

        $district = District::find($id);

        $generator = generator(49, $option, $district);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=2;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('setting.c.district.render_create', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('setting.c.district.update', compact('labels', 'html', 'userPermissions','save','id'));
    }


    public function update(Request $request)
    {
        is_permitted(49, getClassName(__CLASS__), __FUNCTION__, 126, 2);

        $input = $request->all();
        $data = fieldInDatabase(49, $input);

        $optionValidator = [
            'longitude' => [
                'nullable' => 'nullable'
            ],
            'latitude' => [
                'nullable' => 'nullable'
            ],

        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $district = District::find($field['id']);
        $district->fill($field);
        $district->updated_by = Auth::id();
        Log::instance()->record('2.28', $field['id'], 49, null, null, $field, $district);
        Log::instance()->save();
        $district->save();
        $districts=$district->with("city")->first();
        $city=City::where('id',$district->city_id)->first();

        notifications(getClassName(__CLASS__), __FUNCTION__, route('settings.districts.edit', $district->id));

        return response(['success' => true, 'message' => getMessage('2.2'),'district'=>$district,'cityname'=>$city->city_name_no,'citynamefo'=>$city->city_name_fo]);
    }


    public function delete($id)
    {
        is_permitted(49, getClassName(__CLASS__), __FUNCTION__, 127, 4);

        try {

            $ActivityLocationView = Location::where('destrict_', $id)->whereNull('deleted_at')->get()->count();
            $Visit = Visit::where('destrict_id', $id)->whereNull('deleted_at')->get()->count();
            $Locality = Locality::where('district_id', $id)->whereNull('deleted_at')->get()->count();
            $BeneficiaryOrganization = BeneficiaryOrganization::where('district_id', $id)->whereNull('deleted_at')->get()->count();

            if ($ActivityLocationView > 0 ||
                $Locality > 0 || $Visit > 0 || $BeneficiaryOrganization > 0 ) {

                $message = getMessage('2.190');

                return response(['status' => 'false', 'message' => $message]);
            } else {
                District::where('id', $id)->delete();
                $message = getMessage('2.94');
                Log::instance()->record('2.29', $id, 49, null, null, null, null);
                Log::instance()->save();
                notifications(getClassName(__CLASS__), __FUNCTION__, '');
                return response(['status' => 'true', 'message' => $message]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.190');
            return response(['status' => 'false', 'message' => $message]);
        }
    }

}