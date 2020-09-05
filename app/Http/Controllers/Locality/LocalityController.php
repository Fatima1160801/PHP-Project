<?php

namespace App\Http\Controllers\Locality;


use App\Http\Controllers\Controller;
use App\Models\Activity\ActivityBeneficiaries;
use App\Models\Project\ActuallyTargetedBeneficiaries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Locality\Locality;

use App\Helpers\Log;

class LocalityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        is_permitted(68, getClassName(__CLASS__), __FUNCTION__, 202, 7);

        $locality = Locality::all();
        $messageDeleteLocality = getMessage('2.150');
        $labels = inputButton(Auth::user()->lang_id, 68);
        $userPermissions = getUserPermission();
        if ($request->ajax()) {
            $html = view('locality.create_render', compact('labels', 'locality', 'messageDeleteLocality', 'userPermissions'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('locality.index', compact('labels', 'locality', 'messageDeleteLocality', 'userPermissions'));
        }

    }

    public function create(Request $request)
    {
        is_permitted(68, getClassName(__CLASS__), 'store', 203, 1);

        $option = [
            'city_id' => ['relatedWhere' => ' deleted_at is null', 'col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'],
            'district_id' => ['relatedWhere' => ' deleted_at is null', 'is_related' => '0', 'col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'],
            'contact_email' => ['inputClass' => 'noArabic'],
            'contact_mobile' => ['inputClass' => 'check-is-number'],
            'note' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
            'registration_number' => ['inputClass' => 'check-is-number'],
        ];

        $locality = new Locality();

        $generator = generator(68, $option, $locality);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();

        if ($request->ajax()) {
            $html = view('locality.create_form_render', compact('labels', 'html', 'userPermissions'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('locality.create', compact('labels', 'html', 'userPermissions'));
        }

    }

    public function store(Request $request)
    {
        is_permitted(68, getClassName(__CLASS__), 'store', 203, 1);

        $input = $request->all();
        $data = fieldInDatabase(68, $input);

        $optionValidator = [
            'registration_number' => [
                '1' => 'unique:org_beneficiary,registration_number',
                '2' => 'unique:locality,registration_number',
            ],
        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $locality = new Locality();
        $locality->fill($field);
        $locality->created_by = Auth::id();
        $locality->save();

        return response(['success' => true, 'message' => getMessage('2.151')]);
    }

    public function edit($id,Request $request)
    {
        is_permitted(68, getClassName(__CLASS__), 'update', 204, 2);

        $locality = Locality::find($id);

        if ($locality == null) {
            return back();
        }

        $option = [
            'city_id' => ['relatedWhere' => ' deleted_at is null', 'col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'],
            'district_id' => ['relatedWhere' => ' deleted_at is null and city_id=' . $locality->city_id, 'col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'],
            'contact_email' => ['inputClass' => 'noArabic'],
            'contact_mobile' => ['inputClass' => 'check-is-number'],
            'registration_number' => ['inputClass' => 'check-is-number'],
            'note' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        ];

        $generator = generator(68, $option, $locality);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();

        if ($request->ajax()) {
            $html = view('locality.update_render', compact('labels', 'html', 'userPermissions'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('locality.update', compact('labels', 'html', 'userPermissions'));
        }

    }

    public function update(Request $request)
    {
        is_permitted(68, getClassName(__CLASS__), 'update', 204, 2);

        $input = $request->all();
        $data = fieldInDatabase(68, $input);

        $optionValidator = [
            'registration_number' => [
                '1' => 'unique:org_beneficiary,registration_number',
                '2' => 'unique:locality,registration_number,'.$request->id,
            ],
        ];

        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $locality = Locality::find($field['id']);
        $locality->fill($field);
        $locality->updated_by = Auth::id();
        $locality->save();

        return response(['success' => true, 'message' => getMessage('2.152')]);
    }


    public function delete($id)
    {
        is_permitted(68, getClassName(__CLASS__), 'delete', 205, 4);

        try {
//            $ActuallyTargetedBeneficiaries = ActuallyTargetedBeneficiaries::where('beneficiaries_all_vw_id', $id)
//                ->where('beneficiaries_all_vw_type', 4)
//                ->get()->count();
//            if ($ActuallyTargetedBeneficiaries > 0) {
//                $message = getMessage('2.198');
//                return response(['status' => 'false', 'message' => $message]);
//            }

            $activity_beneficiaries = ActivityBeneficiaries::where('ben_id',$id)
                ->where('ben_type_id',4)
                ->get()
                ->count();
            if ($activity_beneficiaries> 0) {
                $message = getMessage('2.198');
                return response(['status' => 'false', 'message' => $message]);
            }
            else {
                Locality::where('id', $id)->delete();
                $message = getMessage('2.153');
                return response(['status' => 'true', 'message' => $message]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.24');
            return response(['status' => 'false', 'message' => $message]);
        }
    }

}