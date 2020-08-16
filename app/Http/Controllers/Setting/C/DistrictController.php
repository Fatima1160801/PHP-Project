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

    public function index()
    {
        is_permitted(49, getClassName(__CLASS__), __FUNCTION__, 124, 7);

        $districts = District::all();
        $messageDeleteDistrict = getMessage('2.91');
        $labels = inputButton(Auth::user()->lang_id, 49);
        $userPermissions = getUserPermission();

        return view('setting.c.district.index', compact('labels', 'districts', 'messageDeleteDistrict', 'userPermissions'));
    }

    public function getCreate()
    {
        is_permitted(49, getClassName(__CLASS__), 'store', 125, 1);

        $option = [
            'city_id' => ['relatedWhere' => ' deleted_at is null', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-4']
            , 'longitude' => ['inputClass' => 'check-is-number']
            , 'latitude' => ['inputClass' => 'check-is-number']
        ];

        $district = new District();

        $generator = generator(49, $option, $district);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();

        return view('setting.c.district.create', compact('labels', 'html', 'userPermissions'));
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

        Log::instance()->record('2.27', null, 49, null, null, null, null);
        Log::instance()->save();

        notifications(getClassName(__CLASS__), __FUNCTION__, route('settings.districts.edit', $district->id));

        return response(['success' => true, 'message' => getMessage('2.1')]);
    }


    public function getEdit($id)
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

        return view('setting.c.district.update', compact('labels', 'html', 'userPermissions'));
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

        notifications(getClassName(__CLASS__), __FUNCTION__, route('settings.districts.edit', $district->id));

        return response(['success' => true, 'message' => getMessage('2.2')]);
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