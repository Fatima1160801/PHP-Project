<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Permission\PermissionController;
use App\Models\Label;
use App\Models\Permission\GroupUser;
use App\Models\Permission\Screen;
use App\Models\Setting\Message;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
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
        $messages = Message::get();
        $labels = inputButton(Auth::user()->lang_id ,0);
        $userPermissions = getUserPermission();

        return view('setting.message.index',compact('labels','messages','userPermissions'));

    }




    public function create($message_id){
       $messages_type = ['selectArray' => ['1' => 'success', '2' => 'warning', '3' => 'info', '4' => 'confirmation']];
       $messages_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $messages_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        $messages_title_na = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10', 'html_type' => '3'];
       $messages_title_fo = ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10', 'html_type' => '3'];

        $data = Message::where('id_sequent',$message_id)->first();

        $option = [
            'messages_type'=>$messages_type,
            'messages_na'=>$messages_na,
            'messages_fo'=>$messages_fo,
            'messages_title_na'=>$messages_title_na,
            'messages_title_fo'=>$messages_title_fo,
        ];
        $generator = generator(24, $option, $data);
        $html =$generator[0];
        $labels =$generator[1];
        $screenName = screenName(24);
        $userPermissions = getUserPermission();

        return view('setting.message.create', compact('labels','html', 'screenName','screen_id','lange_id','userPermissions'))->render();

    }

    public function store(Request $request){
        $input = $request->all();


        $message = Message::where('id_sequent',$input['id_sequent'])->first();

        $message->fill($input);
        $message->save();
        $message = getMessage('2.2');
        session(['array' => $message]);
      return redirect()->route('setting.message.index');
    }

}
