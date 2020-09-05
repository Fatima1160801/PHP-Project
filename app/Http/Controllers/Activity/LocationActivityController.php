<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;

use App\Models\Activity\Activity;
use App\Models\Activity\ActivityBeneficiaries;
use App\Models\Activity\ActivityLocationView;
use App\Models\Activity\ActivityStaff;
use App\Models\Activity\ActivityStaffVW;
use App\Models\Activity\Location;
use App\Models\Project\ProjectCities;
use App\Models\Project\ProjectStaffs;
use App\Models\Setting\C\City;
use App\Models\Setting\C\District;
use App\Models\Staff\Staff;
use PDF;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class LocationActivityController extends Controller
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
    public function index($activity_id)
    {
        $locations = ActivityLocationView::where('activity_id', $activity_id)
            ->get();
        $labels = inputButton(Auth::user()->lang_id, 53);
        $userPermissions = getUserPermission();
        $create_html = $this->create($activity_id);
        $index = view('activity.location.index', compact('labels', 'locations', 'activity_id', 'userPermissions', 'create_html'))->render();
        return response($index);
    }

    public function indexTable($activity_id)
    {

        $locations = ActivityLocationView::where('activity_id', $activity_id)->get();
        $labels = inputButton(Auth::user()->lang_id, 53);
        $userPermissions = getUserPermission();
        $index = view('activity.location.indexTable', compact('labels', 'locations', 'activity_id', 'userPermissions'))->render();
        return response($index);
    }


    public function create($activity_id)
    {

        $activity = Activity::find($activity_id);
        $staffs = [];
        if ($activity) {
            $project_id = $activity->project_id;
            $projectCity = ProjectCities::where('project_id', $project_id)->pluck('city_id');

            $in = array();
            foreach ($projectCity as $city) {
                $in[] = $city;
            }
            $in = '(' . implode(',', $in) . ')';

            if ($in != "()") {
                $city_id = ['relatedWhere' => 'deleted_at is null and id in ' . $in, 'col_all_Class' => 'col-md-4', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-9'];
            } else {
                $selectArray = [];
                $city_id = ['selectArray' => $selectArray, 'is_related' => '0', 'col_all_Class' => 'col-md-4', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-9'];
            }


//            $activityStaffIds = ActivityStaff::where('activity_id', $activity->id)
//                ->where('project_id', $activity->project_id)
//                ->pluck('staff_id');

            $ProjectStaffs = ProjectStaffs::where('project_id', $project_id)->pluck('staff_id');

            $staff_name = 'staff_name_' . lang_character();
            $staffs = Staff::whereIN('id', $ProjectStaffs)
                ->whereNull('deleted_at')
                ->where('is_hidden', 0)
                ->pluck($staff_name, 'id')->toArray();

        } else {
            $city_id = ['relatedWhere' => 'deleted_at is null', 'col_all_Class' => 'col-md-4', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-9'];
        }
        $location_na = ['col_all_Class' => 'col-md-4', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-9'];
        $location_fo = ['col_all_Class' => 'col-md-4', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-9'];

        $is_hidden = ['html_type' => '13'];
        $destrict_ = ['is_related' => '0', 'col_all_Class' => 'col-md-4', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-9'];
        $team_member = ['attr' => ' data-live-search="true"', 'selectArray' => $staffs, 'col_all_Class' => 'col-md-4', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-9'];

        $option = [
            'is_hidden' => $is_hidden,
            'city_id' => $city_id,
            'destrict_' => $destrict_,
            'team_member' => $team_member,
            'location_na' => $location_na,
            'location_fo' => $location_fo,
        ];

        $Location = new Location();
        $Location->activity_id = $activity_id;
        $generator = generator(53, $option, $Location);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $screen_name = $labels['screen_add_location'] ?? 'screen_add_location';
        $html = view('activity.location.create', compact('screen_name', 'labels', 'html', 'userPermissions'))->render();
        return $html;
        // return response(['status' => 'success', 'html' => compact('html')]);
    }


    public function getDistanceByCityId($city_id)
    {
        if (Auth::user()->lang_id == 1) {
            $distance = District::where('city_id', $city_id)
                ->where('is_hidden', '0')
                ->pluck('district_name_no', 'id');
        } else {
            $distance = District::where('city_id', $city_id)
                ->where('is_hidden', '0')
                ->pluck('district_name_fo', 'id');
        }
        return response($distance);
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $data = fieldInDatabase(53, $input);
        $optionValidator = [
            'team_member' => ['nullable' => 'nullable'],
            'location_na' => ['nullable' => 'nullable'],
            'location_fo' => ['nullable' => 'nullable'],
        ];
        inputValidator($data, $optionValidator);
        $field = $data['field'];
        // dd($field);
        if ($request->get('id') == null) {
            $loaction = new Location();
            $loaction->fill($field);
            $loaction->is_hidden = 0;
            $loaction->created_by = Auth::id();
            $loaction->save();
        } else {
            $loaction = Location::find($request->get('id'));
            $loaction->fill($field);
            $loaction->updated_by = Auth::id();
            $loaction->save();
        }
        $message = getMessage('2.1');
        return response(['status' => true, 'message' => $message]);
    }


    public function edit($location_id = null)
    {
        /*$location_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        // $location_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        // $is_hidden = ['html_type' => '13'];

       //  $option = [
             'location_na' => $location_na,
             'location_fo' => $location_fo,
             'is_hidden' => $is_hidden
         ];

         $Location = Location::find($location_id);
         $generator = generator(53, $option, $Location);
         $html = $generator[0];
         $labels = $generator[1];
         $screen_name = $labels['screen_edit_location'] ?? 'screen_edit_location';
         $userPermissions = getUserPermission();
         $html = view('activity.location.create', compact('labels', 'html', 'screen_name', 'userPermissions'))->render();
         return response(['status' => 'success', 'html' => compact('html')]);

         */

        $Location = Location::find($location_id);

        $activity = Activity::find($Location->activity_id);

        $project_id = $activity->project_id;
        $projectCity = ProjectCities::where('project_id', $project_id)->pluck('city_id');

        $city_name = 'city_name_' . lang_character1();
        $cities = City::whereIn('id', $projectCity)->pluck($city_name, 'id');


        $district_name = 'district_name_' . lang_character1();
        $destricts = District::where('city_id', $Location->city_id)->pluck($district_name, 'id');


//        $activityStaffIds = ActivityStaff::where('activity_id', $Location->activity_id)
//            ->where('project_id', $Location->project_id)
//            ->pluck('staff_id');

        $ProjectStaffs = ProjectStaffs::where('project_id', $Location->project_id)->pluck('staff_id');

        $staff_name = 'staff_name_' . lang_character();
        $staffs = Staff::whereIN('id', $ProjectStaffs)
            ->whereNull('deleted_at')
            ->where('is_hidden', 0)
            ->pluck($staff_name, 'id')
            ->toArray();


        return response(['status' => true,
            'location' => $Location,
            'cities' => $cities,
            'destricts' => $destricts,
            'staffs' => $staffs
        ]);
    }


    public function destroy($id)
    {
        $location = Location::find($id);
        $activitybeneficarty = ActivityBeneficiaries::where('governorate_id', $location->city_id)
            ->where('location_id', $location->destrict_)
            ->get();
        if(count($activitybeneficarty)>0){
            $array = getMessage('2.101');
            return response(['status' => 'false', 'message' => $array]);
        }

        if (empty($location)) {
            $array = getMessage('2.101');
            return response(['status' => 'false', 'message' => $array]);
        } else {
            $location->deleted_by = Auth::id();
            $location->save();
            $location->delete();
            $array = getMessage('2.3');
            return response(['status' => 'true', 'message' => $array]);
        }
    }


}
