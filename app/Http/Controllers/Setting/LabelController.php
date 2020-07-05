<?php

namespace App\Http\Controllers\Setting;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Permission\PermissionController;
use App\Models\Setting\Label;
use App\Models\Permission\GroupUser;
use App\Models\Permission\Screen;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LabelController extends Controller
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
        $screens = Screen::whereNotIN('id',[1,2])->get();
        $labels = inputButton(Auth::user()->lang_id ,0);
        $userPermissions = getUserPermission();

        return view('setting.label.index',compact('labels','screens','userPermissions'));

    }




    public function create($screen_id ,$lange_id){
//        $is_hidden = ['selectArray' => ['0' => 'Open', '1' => 'Closed']];
//        $project_name_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
//        $project_name_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
//        $project_desc_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10', 'html_type' => '3'];
//        $project_desc_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10', 'html_type' => '3'];
//        $reference_no = ['col_all_Class' => 'col-md-6'];


        $option = [      ];
        $html = generatorFormLabel($screen_id,$lange_id);
        $screenName = screenName($screen_id);
        $labels = inputButton(Auth::user()->lang_id ,0);
        $userPermissions = getUserPermission();

        return view('setting.label.create', compact('labels','html', 'screenName','screen_id','lange_id','userPermissions'))->render();

    }

    public function store(Request $request){
        $input = $request->all();


        $labels= Label::where('screen_id',$input['screen_id'])
            ->where('language_id',$input['lange_id'])
            ->get();

        foreach ($input as $key =>$value){
          if($key != '_token' && $key !='screen_id' && $key !='lange_id'){

              $label = $labels->where('field_name',$key)->first();
              //$editLabel= Label::find($label->id);
             $label->label = $value;
              $label->save();
          }
        }


        $message = getMessage('2.2');

        session(['array' => $message]);
      return redirect()->route('setting.label.index');
    }

    public function create_labels($lange_id){
//        $is_hidden = ['selectArray' => ['0' => 'Open', '1' => 'Closed']];
//        $project_name_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
//        $project_name_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
//        $project_desc_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10', 'html_type' => '3'];
//        $project_desc_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10', 'html_type' => '3'];
//        $reference_no = ['col_all_Class' => 'col-md-6'];


        $option = [      ];
        $html = generatorFormLabel(0,$lange_id);
        $screenName = '';
        $labels = inputButton(Auth::user()->lang_id ,0);
        $screen_id = 0;
        $userPermissions = getUserPermission();

        return view('setting.label.create', compact('labels','html', 'screenName','screen_id','lange_id','userPermissions'))->render();

    }

}
