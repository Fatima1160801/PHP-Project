<?php

namespace App\Http\Controllers\Setting;

use App\Helpers\Log;
use App\Http\Controllers\Permission\PermissionController;
use App\Http\Controllers\Controller;

use App\Models\Setting\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;

class LabelSettingController extends Controller
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

    public function index(Request $request)
    {

        is_permitted(123, getClassName(__CLASS__), __FUNCTION__, 261, 7);

        if (Auth::user()->lang_id == 1) {
            $selectArray = [1 => 'Original', 2 => 'Foreign'];
        } else {
            $selectArray = [1 => 'أساسية', 2 => 'أجنبية'];
        }

        $option = [
            'screen_id' => ['attr' => ' data-live-search="true" '],
            'language_type' => ['selectArray' => $selectArray],

        ];
        // dd($_GET);

        if (isset($_POST['button_clicked']) && $_POST['button_clicked'] == 'save') {
            foreach ($_POST as $key => $value) {
                if ($value != '') {
                    // dump(substr($key,0, 13));
                    if (substr($key, 0, 9) == 'labelNew_') {
                        DB::table('labels')->where('id', substr($key, 9))->update(['label' => $value]);
                    }
                    if (substr($key, 0, 13) == 'labelHintNew_') {
                        // dump($value);
                        DB::table('labels')->where('id', substr($key, 13))->update(['label_hint' => $value]);
                    }
                }
            }

        }

        $labels = new Label();


        $userPermissions = getUserPermission();
        $generator = generator(123, $option, [
            'screen_id' => $_POST['screen_id'] ?? -1,
            'language_type' => $_POST['language_type'] ?? -1
        ]);
        // $generator = generator(123, $option, $labels);
        $html = $generator[0];
        $labels = $generator[1];

        $results = [];
        if (isset($_POST['screen_id'])) {
            $results = Label::where('screen_id', $_POST['screen_id'])->where('language_id', $_POST['language_type'])->where('html_type', '<>', 13)->get();
            // dump($results);
        }
        $id = 1;
        if ($request->ajax()) {
            $id = 2;
            $html = view('setting.labelsSettings.index_render', compact('labels', 'html', 'userPermissions', 'results'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('setting.labelsSettings.index', compact('labels', 'html', 'userPermissions', 'results'));
        }
    }
function search(){
    is_permitted(123, getClassName(__CLASS__), __FUNCTION__, 261, 7);

    if (Auth::user()->lang_id == 1)
    {
        $selectArray=[1=>'Original',2=>'Foreign'];
    }
    else
    {
        $selectArray=[1=>'أساسية',2=>'أجنبية'];
    }

    $option = [
        'screen_id' => ['attr' => ' data-live-search="true" '],
        'language_type'=>['selectArray'=>$selectArray],

    ];
    // dd($_GET);

    if(isset($_POST['button_clicked']) && $_POST['button_clicked'] == 'save')
    {
        foreach ($_POST as $key => $value)
        {
            if($value != '')
            {
                // dump(substr($key,0, 13));
                if(substr($key,0, 9) == 'labelNew_')
                {
                    DB::table('labels')->where('id', substr($key, 9))->update(['label' => $value]);
                }
                if(substr($key,0, 13) == 'labelHintNew_')
                {
                    // dump($value);
                    DB::table('labels')->where('id', substr($key, 13))->update(['label_hint' => $value]);
                }
            }
        }

    }

    $labels = new Label();


    $userPermissions = getUserPermission();
    $generator = generator(123, $option, [
        'screen_id'=>$_POST['screen_id']??-1,
        'language_type'=>$_POST['language_type']??-1
    ]);
    // $generator = generator(123, $option, $labels);
    $html = $generator[0];
    $labels = $generator[1];

    $results = [];
    if(isset($_POST['screen_id']))
    {
        $results = Label::where('screen_id',$_POST['screen_id'])->where('language_id',$_POST['language_type'])->where('html_type','<>',13)->get();
        // dump($results);
    }

    $val = view('setting.labelsSettings.index_render', compact('labels','html', 'userPermissions','results'))->render();;
    return response(['status' => true, 'html' => $val]);

}
}