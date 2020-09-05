<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Permission\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff\Staff;
use App\Models\Staff\StaffType;
use App\Models\Project\ProjectStaffs;
use App\Models\JobTitle\JobTitle;

use App\Helpers\Log;

class StaffController extends Controller
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


  public function index(Request $request)
  {
      is_permitted('18', 'StaffController', 'index', '31', '7');

      $staffs = Staff::with('user')->get();
      $labels = inputButton(Auth::user()->lang_id, 43);
      $userPermissions = getUserPermission();
      $id = 1;
      if ($request->ajax()) {
          $id = 2;
          $html = view('project.staff.table_render', compact('labels', 'staffs', 'userPermissions', 'userPermissions', 'id'))->render();
          return response(['status' => true, 'html' => $html]);
      } else {
          return view('project.staff.index', compact('labels', 'staffs', 'userPermissions','id'));
      }
  }
  public function create(Request $request,$type)
  {
    is_permitted('18', 'StaffController', 'store', '32', '1');
    $staff = new Staff();

    $staff_name_na = ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];
    $staff_name_fo = ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];
    $idno = ['inputClass' => 'check-is-number', 'col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];
    $employment_date = ['col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8 '];
    $dob = ['col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8 '];
    $address_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
    $address_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
    $mobile_no = ['inputClass' => 'check-is-number', 'col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8 '];
    $tel_no = ['inputClass' => 'check-is-number', 'col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8 '];
    $email = ['inputClass' => 'noArabic', 'col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];
    $url = ['inputClass' => 'noArabic', 'col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8 '];
    $job_title_id = ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8', 'attr' => ' data-live-search="true" ', 'relatedWhere' => ' deleted_at is null and is_hidden = 0'];
    $staff_type = ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8', 'attr' => ' data-live-search="true" ', 'relatedWhere' => 'is_hidden=0 '];
    $is_hidden = ['html_type' => '13'];
    $notes = ['col_all_Class' => 'col-md-12 ', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10 '];
    $avatar_ = ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];
    $supervisor_id = ['attr' => ' data-live-search="true"   ' ];

    $option = [
        'staff_name_na' => $staff_name_na,
        'staff_name_fo' => $staff_name_fo,
        'idno' => $idno,
        'employment_date' => $employment_date,
        'dob' => $dob,
        'address_na' => $address_na,
        'address_fo' => $address_fo,
        'mobile_no' => $mobile_no,
        'tel_no' => $tel_no,
        'email' => $email,
        'url' => $url,
        'job_title_id' => $job_title_id,
        'staff_type' => $staff_type,
        'is_hidden' => $is_hidden,
        'notes' => $notes,
        'avatar_' => $avatar_,
        'supervisor_id' => $supervisor_id,

    ];


    $generator = generator(18, $option, $staff);
    $html = $generator[0];
    $labels = $generator[1];

    $screenName = screenName(18);
    $userPermissions = getUserPermission();
      $save=1;
      $id1=1;
      if($request->ajax()){
          $id1=2;
          $html =view('project.staff.create_render', compact('labels', 'html', 'screenName', 'userPermissions','save','id1','type'))->render();
          return response(['status' => true, 'html' =>$html]);

      }
      else
    return view('project.staff.create', compact('labels', 'html', 'screenName', 'userPermissions','save','id1','type'));
  }

  public function store(Request $request,$id)
  {


    is_permitted('18', 'StaffController', 'store', '32', '1');

    $input = $request->all();
    $data = fieldInDatabase(18, $input);
    $optionValidator = [
        'staff_name_na' => [
            'unique' => 'unique:staff,staff_name_na'
        ], 'staff_name_fo' => [
            'unique' => 'unique:staff,staff_name_fo'
        ], 'idno' => [
            'unique' => 'unique:staff,idno',
            'Numeric' => 'Numeric',
            'string' => 'false',
            'max' => 'false',
            'digits_between' => 'digits_between:0,15'
        ], 'mobile_no' => [
            'Numeric' => 'Numeric',
            'nullable' => 'nullable',
            'string' => 'false',
            'max' => 'false',
            'digits_between' => 'digits_between:0,15',

        ], 'tel_no' => [
            'Numeric' => 'Numeric',
            'nullable' => 'nullable',
            'string' => 'false',
            'max' => 'false',
            'digits_between' => 'digits_between:0,15'
        ], 'email' => [
            'email' => 'email',
            'nullable' => 'nullable'
        ], 'avatar_' => [
            'image' => 'image',
            'mimes' => 'mimes:jpeg,png,jpg,gif,svg',
            'max ' => 'max:2048'
        ],
        'employment_date' => [
            'date' => 'false',
            'date_format' => 'date_format:"d/m/Y"',
            'nullable' => 'nullable',

        ], 'dob' => [
            'date' => 'false',
            'date_format' => 'date_format:"d/m/Y"',
            'nullable' => 'nullable',
        ],
        'staff_type' => ['nullable' => 'nullable'],


    ];
    inputValidator($data, $optionValidator);
    $field = $data['field'];
    $staff = new Staff();
    $staff->fill($field);
    $staff->created_by = Auth::id();
    $staff->employment_date = dateFormatDataBase($field['employment_date']);
    $staff->dob = dateFormatDataBase($field['dob']);

    $path = public_path('images/user/photo/');
    if ($request->has('avatar_')) {
      $imageName = time() . '.' . $request->file('avatar_')->getClientOriginalExtension();
      $request->file('avatar_')->move($path, $imageName);
      $staff->avatar_ = $imageName;
    }
    $staff->created_by = Auth::id();
    $staff->save();

    $user = User::where('staff_id',$staff->id)->first();
    if($user){
      $user->email =$staff->email;
      $user->save();
    }

//    Log::instance()->record('2.34', null, 18, null, null, $staff, null);
//    Log::instance()->save();

//    notifications(getClassName(__CLASS__), __FUNCTION__, route('project.staff.edit', $staff->id));

    $array = getMessage('2.1');
    //  session(['array' => $array]);
      if($id==1)
          return redirect()->route('project.staff.index')->with('array', $array);
      else
          return response(['status' => true, 'city' =>$staff,'message'=>$array]);

  }

  public function show(Request $request,$id)
  {
    is_permitted('18', 'StaffController', 'show', '35', '3');

    $staff = new Staff();
    $data = Staff::where('id', $id)->first();
    $staff_name_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10', 'attr' => ' disabled="true" '];
    $staff_name_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10', 'attr' => ' disabled="true" '];
    $idno = ['inputClass' => 'check-is-number', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10', 'attr' => ' disabled="true" '];
    $employment_date = ['col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8 ', 'attr' => ' disabled="true" '];
    $dob = ['col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-9 ', 'attr' => ' disabled="true" '];
    $address_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10', 'attr' => ' disabled="true" '];
    $address_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10', 'attr' => ' disabled="true" '];
    $mobile_no = ['inputClass' => 'check-is-number', 'col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8 ', 'attr' => ' disabled="true" '];
    $tel_no = ['inputClass' => 'check-is-number', 'col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8 ', 'attr' => ' disabled="true" '];
    $email = ['inputClass' => 'noArabic', 'col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8', 'attr' => ' disabled="true" '];
    $url = ['inputClass' => 'noArabic', 'col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8 ', 'attr' => ' disabled="true" '];
    $job_title_id = ['col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-6', 'col_input_Class' => 'col-md-6 ', 'attr' => ' data-live-search="true" disabled="true" ', 'relatedWhere' => ' deleted_at is null and is_hidden = 0'];
    $staff_type = ['col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-6', 'col_input_Class' => 'col-md-6', 'attr' => ' data-live-search="true"  disabled="true" ', 'relatedWhere' => 'is_hidden=0 '];
    $is_hidden = ['col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8 ', 'selectArray' => ['0' => 'Active', '1' => 'Inactive'], 'attr' => ' disabled="true" '];
    $notes = ['col_all_Class' => 'col-md-12 ', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10 ', 'attr' => ' disabled="true" '];
    $avatar_ = ['attr' => ' disabled="true" '];

    $option = [
        'staff_name_na' => $staff_name_na,
        'staff_name_fo' => $staff_name_fo,
        'idno' => $idno,
        'employment_date' => $employment_date,
        'dob' => $dob,
        'address_na' => $address_na,
        'address_fo' => $address_fo,
        'mobile_no' => $mobile_no,
        'tel_no' => $tel_no,
        'email' => $email,
        'url' => $url,
        'job_title_id' => $job_title_id,
        'staff_type' => $staff_type,
        'is_hidden' => $is_hidden,
        'notes' => $notes,
        'avatar_' => $avatar_,

    ];

    $generator = generator(18, $option, $data);
    $html = $generator[0];
    $labels = $generator[1];

    $screenName = screenName(18);
    $userPermissions = getUserPermission();
      $id1=1;
      if($request->ajax()){
          $id1=2;
          $html =view('project.staff.show_render', compact('labels', 'html', 'screenName', 'data', 'userPermissions','id1'))->render();
          return response(['status' => true, 'html' =>$html]);

      }
      else
    return view('project.staff.show',compact('labels', 'html', 'screenName', 'data', 'userPermissions','id1'));
  }

  public function edit(Request $request,$id,$type)
  {
    is_permitted('18', 'StaffController', 'update', '33', '2');
    $data = Staff::find($id);
    $staff_name_na = ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];
    $staff_name_fo = ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];
    $idno = ['inputClass' => 'check-is-number', 'col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];
    $employment_date = ['col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8 '];
    $dob = ['col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8 '];
    $address_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
    $address_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
    $mobile_no = ['inputClass' => 'check-is-number', 'col_all_Class' => 'col-md-4 ', 'col_label_Class' => 'col-md-6', 'col_input_Class' => 'col-md-6 '];
    $tel_no = ['inputClass' => 'check-is-number', 'col_all_Class' => 'col-md-4 ', 'col_label_Class' => 'col-md-6', 'col_input_Class' => 'col-md-6 '];
    $email = ['inputClass' => 'noArabic', 'col_all_Class' => 'col-md-4 ', 'col_label_Class' => 'col-md-6', 'col_input_Class' => 'col-md-6'];
    $url = ['inputClass' => 'noArabic', 'col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8 '];
    $job_title_id = ['col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8 ', 'attr' => ' data-live-search="true" ', 'relatedWhere' => ' deleted_at is null and is_hidden = 0'];
    $staff_type = ['col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8 ', 'attr' => ' data-live-search="true" ', 'relatedWhere' => 'is_hidden=0 '];
    $is_hidden = ['col_all_Class' => 'col-md-6 ', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8 ', 'selectArray' => ['0' => 'Active', '1' => 'Inactive']];
    $notes = ['col_all_Class' => 'col-md-12 ', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10 '];
    $supervisor_id = ['attr' => ' data-live-search="true"   ' ,'relatedWhere' => ' id != ' . $id ];
    $avatar_ = ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];

    $option = [
        'staff_name_na' => $staff_name_na,
        'staff_name_fo' => $staff_name_fo,
        'idno' => $idno,
        'employment_date' => $employment_date,
        'dob' => $dob,
        'address_na' => $address_na,
        'address_fo' => $address_fo,
        'mobile_no' => $mobile_no,
        'tel_no' => $tel_no,
        'email' => $email,
        'url' => $url,
        'job_title_id' => $job_title_id,
        'staff_type' => $staff_type,
        'is_hidden' => $is_hidden,
        'notes' => $notes,
        'supervisor_id' => $supervisor_id,
        'avatar_' => $avatar_
    ];

    $generator = generator(18, $option, $data);
    $html = $generator[0];
    $labels = $generator[1];

    $screenName = screenName(18);
    $userPermissions = getUserPermission();
      $save=2;
      $id1=1;
      if($request->ajax()){
          $id1=2;
          $html =view('project.staff.create_render', compact('labels', 'html', 'screenName', 'data', 'userPermissions','save','id1','type'))->render();
          return response(['status' => true, 'html' =>$html]);

      }
      else
    return view('project.staff.edit', compact('labels', 'html', 'screenName', 'data', 'userPermissions','save','id1','type'));
  }

  public function update(Request $request,$id1)
  {
    is_permitted('18', 'StaffController', 'update', '33', '2');

    $input = $request->all();
    $data = fieldInDatabase(18, $input);
    $field = $data['field'];
    $id = $input['staff_id'];

    $optionValidator = [
        'staff_name_na' => [
            'unique' => 'unique:staff,staff_name_na,' . $id
        ],

        'staff_name_fo' => [
            'unique' => 'unique:staff,staff_name_fo,' . $id
        ],

        'idno' => [
            'unique' => 'unique:staff,idno,' . $id,
            'Numeric' => 'Numeric',
            'string' => 'false',
            'max' => 'false',
            'digits_between' => 'digits_between:0,15'
        ],

        'donor_tel_no' => [
            'Numeric' => 'Numeric',
            'nullable' => 'nullable',
            'string' => 'false',
            'max' => 'false',
            'digits_between' => 'digits_between:0,15'

        ],

        'employment_date' => [
            'nullable' => 'nullable',
        ],
        'dob' => [
            'nullable' => 'nullable',
        ],
        'mobile_no' => [
            'Numeric' => 'Numeric',
            'nullable' => 'nullable',
            'string' => 'false',
            'max' => 'false',
            'digits_between' => 'digits_between:0,15',

        ],

        'tel_no' => [
            'Numeric' => 'Numeric',
            'nullable' => 'nullable',
            'string' => 'false',
            'max' => 'false',
            'digits_between' => 'digits_between:0,15'
        ],
        'email' => [
            'email' => 'email',
            'nullable' => 'nullable'
        ],
        'avatar_' => [
            'image' => 'image',
            'mimes' => 'mimes:jpeg,png,jpg,gif,svg',
            'max ' => 'max:2048'
        ], 'employment_date' => [
            'date' => 'false',
            'date_format' => 'date_format:"d/m/Y"',
            'nullable' => 'nullable',

        ], 'dob' => [
            'date' => 'false',
            'date_format' => 'date_format:"d/m/Y"',
            'nullable' => 'nullable',

        ],
        'staff_type' => ['nullable' => 'nullable'],

    ];


    inputValidator($data, $optionValidator);
    $data['updated_by'] = Auth::id();
    $staff = Staff::find($id);
//    dd($staff);
//    Log::instance()->record('2.35', null, 18, null, null, $field, $staff);
    $staff->fill($field);
    $staff->employment_date = dateFormatDataBase($field['employment_date']);
    $staff->dob = dateFormatDataBase($field['dob']);
    $path = public_path('images/user/photo/');
    if ($request->has('avatar_')) {
      $imageName = time() . '.' . $request->file('avatar_')->getClientOriginalExtension();
      $request->file('avatar_')->move($path, $imageName);
      $staff->avatar_ = $imageName;
    }
//    Log::instance()->save();

   // notifications(getClassName(__CLASS__), __FUNCTION__, route('project.staff.edit', $staff->id));
    $staff->save();
    $array = getMessage('2.2');
    if($request->ajax()){
        return response(['status' => true, 'city' =>$staff,'message'=>$array]);
    }else{
        return redirect()->route('project.staff.index')->with('array', $array);

    }


  }

  public function destroy($id,$id1)
  {

    is_permitted('18', 'StaffController', 'destroy', '34', '4');

    $staff = Staff::find($id);
    $project_staff = ProjectStaffs::Where('staff_id', $id)->first();

    if (!empty($project_staff)) {

      $message = getMessage('2.192');
      session(['array' => $message]);
        if($id1==1)
            return redirect()->route('project.staff.index');
        else
            return response(['status' => false, 'message' => $message]);


    } else {
      $staff->deleted_by = Auth::id();
      $staff->delete();
      Log::instance()->record('2.36', null, 18, null, null, null, null);
      Log::instance()->save();
      notifications(getClassName(__CLASS__), __FUNCTION__, '');

      $message = getMessage('2.3');
      session(['array' => $message]);
        if($id1==1)
            return redirect()->route('project.staff.index');
        else
            return response(['status' => true, 'message' => $message]);

    }

  }


}
