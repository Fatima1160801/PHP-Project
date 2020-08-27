<?php

namespace App\Http\Controllers\Setting\Opportunity;

use App\Http\Controllers\Controller;
use App\Helpers\Log;
use App\Http\Controllers\Permission\PermissionController;

use App\Models\Setting\AttachmentSpecific;
use App\Models\Setting\Document;
use App\Models\Setting\Intface;
use App\Models\Setting\Attachment;
//use App\Models\Setting\SysAttach;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use DB;

class DocumentController extends Controller
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
        is_permitted(114, getClassName(__CLASS__), __FUNCTION__, 238, 7);
        $documents = Document::where('created_by', Auth::id())->with(["attachment","Intface"])->get();
        
        $messageDeleteType = getMessage('2.203');
        $labels = inputButton(Auth::user()->lang_id, 114);
        $userPermissions = getUserPermission();
        $id = 1;
        if ($request->ajax()) {
            $id = 2;
            $html = view('setting.opportunity.doc_setting.table_render', compact('labels', 'documents', 'messageDeleteType', 'userPermissions', 'id'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
        return view('setting.opportunity.doc_setting.index', compact('labels', 'documents', 'messageDeleteType', 'userPermissions','id'));
    }
}
    public function create(Request $request,$type = null, $id = null)
    {
        is_permitted(114, getClassName(__CLASS__), __FUNCTION__, 239, 1);
        //  $option = [
        //     'description' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        //     'city_id' => ['relatedWhere' => 'deleted_at is null  and is_hidden = 0  '],
        //     'date_visits' => ['attr' => 'autocomplete="off"'],
        //     'beneficiary_id' => ['attr' => ' data-live-search="true" '],
        //      'issues_type' => ['relatedWhere' => 'deleted_at is null  and  is_hidden = 0 '],
        // ];
        if (Auth::user()->lang_id == 1)
        {
            $interface_name = 'interface_type_na';
            $attach_name = 'attachment_type_na';
        }
        else
        {
            $interface_name = 'interface_type_fo';
            $attach_name = 'attachment_type_fo';
        }

        $interfaces = Intface::where('is_hidden',0)->whereNull('deleted_at')->pluck($interface_name, 'id');
        $attachments = AttachmentSpecific::where('is_hidden',0)->pluck($attach_name, 'id');
        $selectArray = [0=>'No',1=>'Yes'];

        $option = [ 'interface_type_id' => ['selectArray' => $interfaces],
                    'attachment_type_id'=> ['selectArray' => $attachments], 
                    'fixed_in_interface_flag'=>['selectArray'=>$selectArray,'html_type'=>'5'],
                ];

        $documents = new Document();

        $generator = generator(114, $option, $documents);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=1;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('setting.opportunity.doc_setting.create_render', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        return view('setting.opportunity.doc_setting.create', compact('labels', 'html', 'userPermissions','save','id'));
    }

    public function store(Request $request)
    {

        is_permitted(114, getClassName(__CLASS__), __FUNCTION__, 239, 1);

        $input = $request->all();

        $data = fieldInDatabase(114, $input);
        $field = $data['field'];
        
        $count = Document::where('interface_type_id',$field['interface_type_id'])->where('attachment_type_id',$field['attachment_type_id'])->count();
        if($count > 0)

           return response(['status' => 'true', 'message' => getMessage('2.201'),'check'=>1]);
        // $optionValidator = [
        //     'file' => [
        //         'required' => 'false',
        //         'max' => 'max:10000',
        //         'mimes' => 'mimes:jpg,jpeg,png,PNG,JPG,pdf,PDF,JPG,docx,doc,csv,xls,xlsx,txt,ppt,zip,rar'
        //     ],
        //     'date_visits' => [
        //         'date' => 'false',
        //         'date_format' => 'date_format:"d/m/Y"'
        //     ],
        // ];

       $optionValidator=[];
       inputValidator($data, $optionValidator);
 
        $document = new Document();
        // dd($field);

        
        $document->fill($field);

        // dd($document);
        $document->created_by = Auth::id();


        // $path = public_path('images/visit');
        // if ($request->has('file')) {
        //     $imageName = time() . '.' . $request->file('file')->getClientOriginalExtension();
        //     $request->file('file')->move($path, $imageName);
        //     $visit->file = $imageName;
        // }
        $document->save();
        // dd(10);
        Log::instance()->record('2.210', null, 114, null, null, null, null);
        Log::instance()->save();
$interface=Intface::where('id',$document->interface_type_id)->first();
$attachment=AttachmentSpecific::where('id',$document->attachment_type_id)->first();

        // notifications(getClassName(__CLASS__), __FUNCTION__, route('documents.edit', $document->id));
        return response(['status' => 'true', 'message' => getMessage('2.1'),'city'=>$document,'interface'=>$interface,'attachment'=>$attachment,'check'=>2]);


    }

    public function edit(Request $request,$interface_id,$document_type_id)
    {
        
        is_permitted(114, getClassName(__CLASS__), __FUNCTION__, 240, 2);

        $document = Document::where('interface_type_id',$interface_id)->where('attachment_type_id',$document_type_id)->first();

        // $option = [
        //     'description' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        //     'city_id' => ['relatedWhere' => 'deleted_at is null  and is_hidden = 0  '],
        //     'destrict_id' => ['selectArray' => $districts],
        //     'date_visits' => ['attr' => 'autocomplete="off"'],
        //     'file' => ['html_type' => '14'],
        //     'beneficiary_id' => ['selectArray' => $beneficiaries, 'attr' => ' data-live-search="true" '],
        //     'issues_type' => ['relatedWhere' => 'deleted_at is null  and  is_hidden = 0 '],
        //     ];
        if (Auth::user()->lang_id == 1) 
        {
            $selectArray = [0=>'No',1=>'Yes'];
            $selectArray2=[0=>'active',1=>'inactive'];
        }
        else 
        {
            $selectArray = [0=>'لا',1=>'نعم'];
            $selectArray2=[0=>'فعال',1=>'غير فعال'];
        }
        
        $option = [ 'interface_type_id' => ['html_type'=>'10'],
                    'attachment_type_id'=> ['html_type'=>'10'],
                    'fixed_in_interface_flag'=>['selectArray'=>$selectArray,'html_type'=>'5'],
                    'is_hidden'=>['selectArray'=>$selectArray2,'html_type'=>'5']
                ]; 


           
        $generator = generator(114, $option, $document);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=2;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('setting.opportunity.doc_setting.create_render', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('setting.opportunity.doc_setting.edit', compact('labels', 'html', 'userPermissions', 'document','save','id'));
    }

    public function update(Request $request)
    {
        is_permitted(114, getClassName(__CLASS__), __FUNCTION__, 240, 2);

        $input = $request->all();
        // dd($request['fixed_in_interface_flag']);
        $data = fieldInDatabase(114, $input);
        $field = $data['field'];
        
        $interface_type_id = $field['interface_type_id'];
        $attachment_type_id = $field['attachment_type_id'];
        

        $optionValidator = [];
        inputValidator($data, $optionValidator);
        $document = Document::where('interface_type_id',$interface_type_id)->where('attachment_type_id',$attachment_type_id)->first();
        
        $document->updated_by = Auth::id();
       
        // $document->save();

        Document::where('interface_type_id',$interface_type_id)->where('attachment_type_id',$attachment_type_id)->update(array('fixed_in_interface_flag' => $request['fixed_in_interface_flag'],'is_hidden' => $request['is_hidden'] ));
        

        Log::instance()->save();

        notifications(getClassName(__CLASS__), __FUNCTION__, route('settings.documents.edit', ['interface_type_id'=>$interface_type_id,'attachment_type_id'=>$attachment_type_id]));
        return response(['status' => 'true', 'message' => getMessage('2.2')]);


    }

    public function delete($interface_id,$document_type_id)
    {
         // dd($interface_id,$document_type_id);
        is_permitted(114, getClassName(__CLASS__), __FUNCTION__, 241, 4);
        try {
            $count = Attachment::where('activity_type',$interface_id)->where('attachment_type_id',$document_type_id)->count();
            if($count > 0)//inactive
            {
                $message = getMessage('2.14');
                return response(['status' => 'flase', 'message' => $message]);
            }
            else//force delete
            {
                $doc = Document::where('interface_type_id',$interface_id)->where('attachment_type_id',$document_type_id)->first();

                $doc->deleted_by = Auth::id();

                // $doc->delete();
                Document::where('interface_type_id',$interface_id)->where('attachment_type_id',$document_type_id)->delete();
                 // dd(5);
                $message = getMessage('2.3');
                //Log::instance()->record('2.212', $id, 114, null, null, null, null);
                Log::instance()->save();
                notifications(getClassName(__CLASS__), __FUNCTION__, '');
                return response(['status' => 'true', 'message' => $message]);
            }

            
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.3');
            return response(['status' => 'false', 'message' => $message]);
        }
    }



}