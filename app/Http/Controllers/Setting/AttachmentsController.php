<?php

namespace App\Http\Controllers\Setting;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Permission\PermissionController;
use App\Models\Concept\concepts;
use App\Models\Proposal\proposals;
use App\Models\Setting\Attachment;
use App\Models\Setting\AttachmentType;
use App\Models\Setting\C\AttachmentTypes;
use App\Models\Setting\DocSettingsVW;
use App\Models\Setting\Interface_AttachmentVW;
use App\Models\Setting\Label;
use App\Models\Permission\GroupUser;
use App\Models\Project\Project;
use App\Models\Activity\Activity;
use App\Models\Permission\Screen;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;
use App\Helpers\FileUploader;
use App\Helpers\Log;

class AttachmentsController extends Controller
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
    is_permitted(29, getClassName(__CLASS__), __FUNCTION__, 115, 7);

    $attachments = Attachment::orderby('id', 'desc')->paginate(20);
    $act_list = [
        1 => ['1' => 'Projects', '2' => 'مشاريع'],
        2 => ['1' => 'Activities', '2' => 'أنشطة'],
        3 => ['1' => 'Employees', '2' => 'موظفين'],
        4 => ['1' => 'Tasks', '2' => 'المهام'],
        5 => ['1' => 'Activity Indicator Value', '2' => 'مرفقات قيم المؤشرات للنشاط'],
        6 => ['1' => 'Activity Result Value', '2' => 'مرفقات قيم النتائج للنشاط'],
        7 => ['1' => 'Activity Beneficiary Value', '2' => 'مرفقات قيم المستفيدين للنشاط'],
        10 => ['1' => 'Opportunity', '2' => 'الفرص'],
        11 => ['1' => 'Concept', '2' => 'التصورات'],
        12 => ['1' => 'Proposal', '2' => 'العروض'],
    ];

    $attachment_name = 'attachment_type_' . lang_character();
    $attachmentTypes = AttachmentTypes::pluck($attachment_name, 'id');
    $project_name = 'project_name_' . lang_character();
    $projects = Project::getProject()->pluck($project_name, 'id');;
    $labels = inputButton(Auth::user()->lang_id, 29);
    $userPermissions = getUserPermission();
    return view('setting.attachment.index', compact('labels', 'attachments', 'act_list', 'userPermissions', 'attachmentTypes', 'projects'));
  }


  public function getMainActivitiesList($project_id)
  {
    $name = 'activity_name_' . lang_character();
    $main_activities = Activity::getActivity($project_id)
        ->pluck($name, 'id');

    return response(['main_activities' => $main_activities]);
  }

  public function getSubActivitiesList($main_Activity_id)
  {
    $name = 'activity_name_' . lang_character();
    $sub_activities = Activity::getActivitySub(null, $main_Activity_id)
        ->pluck($name, 'id');
    return response(['sub_activities' => $sub_activities]);
  }

  public function search(Request $request)
  {
    $query = Attachment::orderby('id', 'desc');

    if ($request->has('attachmentType_id') && $request->get('attachmentType_id') != null) {
      $query->where('attachment_type_id', $request->get('attachmentType_id'));
    }
    if ($request->has('activity_sub_id') && $request->get('activity_sub_id') != null) {
      $query->where('primary_id', $request->get('activity_sub_id'));
      $query->where('activity_type', 2);
    } elseif ($request->has('activity_main_id') && $request->get('activity_main_id') != null) {
      $query->where('primary_id', $request->get('activity_main_id'));
      $query->where('activity_type', 2);
    } elseif ($request->has('project_id') && $request->get('project_id') != null) {
      $query->where('primary_id', $request->get('project_id'));
      $query->where('activity_type', 1);
    }

    $labels = inputButton(Auth::user()->lang_id, 29);

    $attachments = $query->paginate(20);
    $act_list = [
        1 => ['1' => 'Projects', '2' => 'مشاريع'],
        2 => ['1' => 'Activities', '2' => 'أنشطة'],
        3 => ['1' => 'Employees', '2' => 'موظفين'],
        4 => ['1' => 'Tasks', '2' => 'المهام'],
        5 => ['1' => 'Activity Indicator Value', '2' => 'مرفقات قيم المؤشرات للنشاط'],
        6 => ['1' => 'Activity Result Value', '2' => 'مرفقات قيم النتائج للنشاط'],
        7 => ['1' => 'Activity Beneficiary Value', '2' => 'مرفقات قيم المستفيدين للنشاط']
    ];

    $view = view('setting.attachment.ajax_index', compact('attachments', 'act_list', 'labels'))->render();
    return response(['status' => true, 'html' => $view]);

  }

  public function getByActivity($activity_type, $primary_id)
  {
    //is_permitted(29, getClassName(__CLASS__), __FUNCTION__, 115, 7);

    $attachments = Attachment::where('activity_type', $activity_type)
        ->where('primary_id', $primary_id)
        ->get();
    $labels = inputButton(Auth::user()->lang_id, 0);
    $userPermissions = getUserPermission();

    return view('setting.attachment.index2', compact('labels', 'attachments', 'userPermissions'));
  }


  public function createWithType($id, $type_id = 0)
  {
    $none_fixed_type = \App\Models\Opportunity\interfaceTypeSetting::where("interface_type_id", 10)->where("is_hidden", 0)->where("fixed_in_interface_flag", 0)->pluck("attachment_type_id");
    if (!empty($none_fixed_type)) {
      $arr = $none_fixed_type;
    } else {
      $arr = $none_fixed_type = [];
    }
    $selected_att = $type_id;
    $labels = inputButton(Auth::user()->lang_id, 0);
    $name = 'attachment_type_' . lang_character();
    $attachment_types = AttachmentTypes::whereIn('id', $arr)->pluck($name, 'id');
    $userPermissions = getUserPermission();
    $attachments_allowed_types = AttachmentType::all()->pluck('attachment_type')->toArray();

    $accept = '';
    foreach ($attachments_allowed_types as $type) {
      $accept .= '.' . $type . ',';
    }
    return view('setting.attachment.create_with_type', compact('selected_att', 'labels', 'userPermissions', 'attachment_types', 'attachments_allowed_types', 'accept'));
  }

  public function createWithTypeConcept($id, $type_id, $p_id)
  {
    // dd($id,$type_id,$p_id);
    $none_fixed_type = \App\Models\Opportunity\interfaceTypeSetting::where("interface_type_id", $id)->where("attachment_type_id", $type_id)->where("is_hidden", 0)->pluck("attachment_type_id");
    // dd($none_fixed_type);
    if (!empty($none_fixed_type)) {
      $arr = $none_fixed_type;
    } else {
      $arr = $none_fixed_type = [];
    }
    $selected_att = $type_id;
    $labels = inputButton(Auth::user()->lang_id, 0);
    $name = 'attachment_type_' . lang_character();
    $attachment_types = AttachmentTypes::whereIn('id', $arr)->pluck($name, 'id');
    $userPermissions = getUserPermission();
    $attachments_allowed_types = AttachmentType::all()->pluck('attachment_type')->toArray();

    $accept = '';
    foreach ($attachments_allowed_types as $type) {
      $accept .= '.' . $type . ',';
    }
    return view('setting.attachment.fixed_doc_type', compact('selected_att', 'labels', 'userPermissions', 'attachment_types', 'attachments_allowed_types', 'accept'));
  }

  public function create()
  {
    $labels = inputButton(Auth::user()->lang_id, 0);
    $name = 'attachment_type_' . lang_character();
    $attachment_types = AttachmentTypes::pluck($name, 'id');
    $userPermissions = getUserPermission();
    $attachments_allowed_types = AttachmentType::all()->pluck('attachment_type')->toArray();

    $accept = '';
    foreach ($attachments_allowed_types as $type) {
      $accept .= '.' . $type . ',';
    }
    return view('setting.attachment.create', compact('labels', 'userPermissions', 'attachment_types', 'attachments_allowed_types', 'accept'));
  }

  public function getEdit($id)
  {
    $attachment = Attachment::where('id', $id)->first();
    if ($attachment == null) {
      //return redirect()->route('home');
      return response()->json(['status' => false, 'message' => "file not found try again later"]);

    }
    $name = 'attachment_type_' . lang_character();
    $attachment_types = AttachmentTypes::pluck($name, 'id');
    $labels = inputButton(Auth::user()->lang_id, 0);
    $userPermissions = getUserPermission();
    $attachments_allowed_types = AttachmentType::all()->pluck('attachment_type')->toArray();

    $accept = '';
    foreach ($attachments_allowed_types as $type) {
      $accept .= '.' . $type . ',';
    }
    return view('setting.attachment.edit', compact('labels', 'attachment', 'userPermissions', 'attachment_types', 'attachments_allowed_types', 'accept'));
  }

  public function store(Request $request)
  {
    $input = $request->all();
    if (!empty($input['title'])) {
      $file_title = $input['title'];
    } else {
      $file_title = '';
    }
    if ($request->get('attachment_type_id') == null) {
      return response()->json(['status' => false, 'message' => getMessage('2.184')]);
    }
    if (isset($input['attachment_id']) && is_file($_FILES['files']['tmp_name'][0])) {
      is_permitted(29, getClassName(__CLASS__), __FUNCTION__, 117, 2);
      $FileUploader = new FileUploader('files', array(
          'uploadDir' => 'public/attach/',
          'extensions' => attachments_allowed_types(),
          'title' => 'name'
      ));

      //date('Y-m-d').'_'.substr(str_shuffle("0123456789abcdef"), 0,8)
      $data = $FileUploader->upload();
      if ($data['isSuccess']) {
        foreach ($data['files'] as $file) {
          $attachment = Attachment::find($input['attachment_id']);
          $attachment->file_path = str_replace(' ', '-', $file['old_name']);
          $attachment->file_type = $file['extension'];
          $attachment->attachment_type_id = $input['attachment_type_id'];
          $attachment->file_desc = $input['desc'];
          $attachment->file_title = $file_title;
          $attachment->file_name = str_replace(' ', '-', $file['old_name']);
          $attachment->updated_by = Auth::id();
          $attachment->save();
          rename('public/attach/' . $file['old_name'], 'public/attach/' . str_replace(' ', '-', $file['old_name']));
          Log::instance()->record('2.32', null, 29, null, null, null, null);
          Log::instance()->save();
          notifications(getClassName(__CLASS__), __FUNCTION__, '');
        }
      } else {
        return response()->json(['success' => false, 'error' => $data['warnings'], 'attachment' => null]);
      }
    } else if (isset($input['attachment_id']) && !is_file($_FILES['files']['tmp_name'][0])) {
      is_permitted(29, getClassName(__CLASS__), __FUNCTION__, 117, 2);
      $attachment = Attachment::find($input['attachment_id']);
      $attachment->file_desc = $input['desc'];
      $attachment->file_title = $file_title;
      $attachment->attachment_type_id = $input['attachment_type_id'];

      $attachment->updated_by = Auth::id();
      $attachment->save();
    } else if (!isset($input['attachment_id']) && is_file($_FILES['files']['tmp_name'][0]) && isset($input['activity_type']) && isset($input['primary_id'])) {

      is_permitted(29, getClassName(__CLASS__), __FUNCTION__, 116, 1);

      $FileUploader = new FileUploader('files', array(
          'uploadDir' => 'public/attach/',
          'extensions' => attachments_allowed_types(),
          'title' => 'name'
      ));
      $data = $FileUploader->upload();
      if ($data['isSuccess']) {
        foreach ($data['files'] as $file) {
          $attachment = new Attachment();
          $attachment->activity_type = $input['activity_type'];
          $attachment->file_path = str_replace(' ', '-', $file['old_name']);
          $attachment->file_type = $file['extension'];
          $attachment->file_desc = $input['desc'];
          $attachment->file_title = $file_title;
          $attachment->attachment_type_id = $input['attachment_type_id'];

          $attachment->file_name = str_replace(' ', '-', $file['old_name']);
          $attachment->primary_id = $input['primary_id'];
          $attachment->created_by = Auth::id();
          $attachment->save();
          rename('public/attach/' . $file['old_name'], 'public/attach/' . str_replace(' ', '-', $file['old_name']));
          Log::instance()->record('2.31', null, 29, null, null, null, null);
          Log::instance()->save();
          notifications(getClassName(__CLASS__), __FUNCTION__, '');
        }
      } else {
        return response()->json(['success' => false, 'error' => $data['warnings'], 'attachment' => null]);
      }

    } else if (!is_file($_FILES['files']['tmp_name'][0]) || !isset($input['activity_type']) || !isset($input['primary_id'])) {
      return response()->json(['success' => false, 'error' => 'Some Data is missing, try again.', 'attachment' => null]);
    }
    // dd($attachment->id);
    return response()->json(['success' => true, "save_opp_id" => $attachment->id ?? 0, "file_path" => p_url('/' . $attachment->file_path), 'message' => getMessage('2.63')]);

  }


  public function delete($id)
  {
    is_permitted(29, getClassName(__CLASS__), __FUNCTION__, 118, 4);

    try {
      $a = Attachment::where('id', $id)->first();
      if ($a->created_by == Auth::id()) {
        if (file_exists('public/attach/' . $a->file_path)) {
          unlink('public/attach/' . $a->file_path);
        }
        Attachment::where('id', $id)->delete();
        $message = getMessage('2.64');
        Log::instance()->record('2.33', $id, 29, null, null, null, null);
        Log::instance()->save();
        notifications(getClassName(__CLASS__), __FUNCTION__, '');
        return response(['status' => 'true', 'message' => $message]);
      } else {
        return response(['status' => 'false', 'message' => getMessage('2.66')]);
      }
    } catch (\Illuminate\Database\QueryException $e) {
      $message = getMessage('2.24');
      return response(['status' => 'false', 'message' => $message]);
    }
  }

  public function createFixed($attachment_type_id)
  {
    $labels = inputButton(Auth::user()->lang_id, 0);
    $name = 'attachment_type_' . lang_character();
    $attachment_types = AttachmentTypes::where('id', $attachment_type_id)
        ->pluck($name, 'id');
    $userPermissions = getUserPermission();
    $attachments_allowed_types = AttachmentType::all()->pluck('attachment_type')->toArray();

    $accept = '';
    foreach ($attachments_allowed_types as $type) {
      $accept .= '.' . $type . ',';
    }
    return view('setting.attachment.create_fixed', compact('attachment_type_id', 'labels', 'userPermissions', 'attachment_types', 'attachments_allowed_types', 'accept'));
  }

  public function editFixed($id)
  {
    $labels = inputButton(Auth::user()->lang_id, 0);
    $attachment = Attachment::find($id);
    $name = 'attachment_type_' . lang_character();
    $attachment_types = AttachmentTypes::where('id', $attachment->attachment_type_id)
        ->pluck($name, 'id');

    $userPermissions = getUserPermission();
    $attachments_allowed_types = AttachmentType::all()->pluck('attachment_type')->toArray();

    $accept = '';
    foreach ($attachments_allowed_types as $type) {
      $accept .= '.' . $type . ',';
    }

    return view('setting.attachment.edit_fixed', compact('attachment', 'attachment_type_id', 'labels', 'userPermissions', 'attachment_types', 'attachments_allowed_types', 'accept'));
  }

  public function storeFixed(Request $request)
  {


    $input = $request->all();



    if (!empty($input['title'])) {
      $file_title = $input['title'];
    } else {
      $file_title = '';
    }
     if ($request->get('attachment_type_id') == null) {
      return response()->json(['status' => false, 'message' => getMessage('2.184')]);
    }
      $attachment_fixed = new Attachment();
    if (isset($input['attachment_id']) && is_file($_FILES['files']['tmp_name'])) {
      is_permitted(29, getClassName(__CLASS__), __FUNCTION__, 117, 2);
      $FileUploader = new FileUploader('files', array(
          'uploadDir' => 'public/attach/',
          'extensions' => attachments_allowed_types(),
          'title' => 'name'
      ));

       $data = $FileUploader->upload();

      if ($data['isSuccess']) {
        foreach ($data['files'] as $file) {
          $attachment = Attachment::find($input['attachment_id']);
          $attachment->file_path = str_replace(' ', '-', $file['old_name']);
          $attachment->file_type = $file['extension'];
          $attachment->attachment_type_id = $input['attachment_type_id'];
          $attachment->file_desc = $input['desc'];
          $attachment->file_title = $file_title;
          $attachment->file_name = str_replace(' ', '-', $file['old_name']);
          $attachment->updated_by = Auth::id();
          $attachment->save();
          $attachment_fixed = $attachment;
          rename('public/attach/' . $file['old_name'], 'public/attach/' . str_replace(' ', '-', $file['old_name']));
          Log::instance()->record('2.32', null, 29, null, null, null, null);
          Log::instance()->save();
          notifications(getClassName(__CLASS__), __FUNCTION__, '');
        }
      } else {
        return response()->json(['success' => false, 'error' => $data['warnings'], 'attachment' => null]);
      }
    }
    else if (isset($input['attachment_id']) && !is_file($_FILES['files']['tmp_name'])) {
      is_permitted(29, getClassName(__CLASS__), __FUNCTION__, 117, 2);
      $attachment = Attachment::find($input['attachment_id']);
      $attachment->file_desc = $input['desc'];
      $attachment->file_title = $file_title;
      $attachment->attachment_type_id = $input['attachment_type_id'];
      $attachment->updated_by = Auth::id();
      $attachment->save();
      $attachment_fixed = $attachment;
    }
    else if (!isset($input['attachment_id']) && is_file($_FILES['files']['tmp_name']) && isset($input['activity_type']) && isset($input['primary_id'])) {

      is_permitted(29, getClassName(__CLASS__), __FUNCTION__, 116, 1);

      $FileUploader = new FileUploader('files', array(
          'uploadDir' => 'public/attach/',
          'extensions' => attachments_allowed_types(),
          'title' => 'name'
      ));
      $data = $FileUploader->upload();
      if ($data['isSuccess']) {
        foreach ($data['files'] as $file) {
          $attachment = new Attachment();
          $attachment->activity_type = $input['activity_type'];
          $attachment->file_path = str_replace(' ', '-', $file['old_name']);
          $attachment->file_type = $file['extension'];
          $attachment->file_desc = $input['desc'];
          $attachment->file_title = $file_title;
          $attachment->attachment_type_id = $input['attachment_type_id'];

          $attachment->file_name = str_replace(' ', '-', $file['old_name']);
          $attachment->primary_id = $input['primary_id'];
          $attachment->created_by = Auth::id();
          $attachment->save();
          $attachment_fixed = $attachment;
          rename('public/attach/' . $file['old_name'], 'public/attach/' . str_replace(' ', '-', $file['old_name']));
          Log::instance()->record('2.31', null, 29, null, null, null, null);
          Log::instance()->save();
          notifications(getClassName(__CLASS__), __FUNCTION__, '');
        }
      } else {
        return response()->json(['success' => false, 'error' => $data['warnings'], 'attachment' => null]);
      }

    } else if (!is_file($_FILES['files']['tmp_name']) || !isset($input['activity_type']) || !isset($input['primary_id'])) {
      return response()->json(['success' => false, 'error' => '', 'message' => getMessage('2.313'), 'attachment' => null]);
    }
    return response()->json(['success' => true, 'attachment_fixed' => $attachment_fixed, 'message' => getMessage('2.63')]);

  }

  public function indexFixed(Request $request, $primary_id, $interface_type)
  {
    //dd($interface_type);

    if ($interface_type == 10) {
      teamMemberCheck($primary_id, 10);
      is_permitted(120, getClassName(__CLASS__), __FUNCTION__, 287, 21);
    } elseif ($interface_type == 12) {
      teamMemberCheck($primary_id, 12);
      is_permitted(121, getClassName(__CLASS__), __FUNCTION__, 288, 21);
    } elseif ($interface_type == 11) {
      teamMemberCheck($primary_id, 11);
      is_permitted(122, getClassName(__CLASS__), __FUNCTION__, 289, 21);
    } else {
    }

    $attachment_type_not_show = $request->get('attachment_type_not_show');
    $attachment_type_show = $request->get('attachment_type_show');
    $allow_display = false; //display full description on concept,proposal tab2
    $display_full_desc = $request->get('display_full_desc');
    if ($display_full_desc == 1) {
      $allow_display = true;
    }

    if ($interface_type == 11) {//concept
      $found_full_desc = concepts::where('id', $primary_id)->first(["full_desc"]);
    } elseif ($interface_type == 12) {
      $found_full_desc = proposals::where('id', $primary_id)->first(["full_desc"]);
    } else {
      $found_full_desc = "";
    }
    $pr_id = $primary_id ?? 0;


    if ($attachment_type_not_show != 0) {
      $doc_setting = \App\Models\Setting\DocSettingsVW::where("fixed_in_interface_flag", 1)
          ->where("interface_type_id", $interface_type)
          ->where("attachment_type_id", '<>', $attachment_type_not_show)
          ->get();
      $fixed_doc = Interface_AttachmentVW::where("activity_type", $interface_type)
          ->where("is_hidden", 0)
          ->where("fixed_in_interface_flag", 1)
          ->where("primary_id", $primary_id)
          ->where("attachment_type_id", '<>', $attachment_type_not_show)
          ->get();
    } elseif ($attachment_type_show != 0) {
      $doc_setting = \App\Models\Setting\DocSettingsVW::where("fixed_in_interface_flag", 1)
          ->where("interface_type_id", $interface_type)
          ->where("attachment_type_id", $attachment_type_show)
          ->get();
      $fixed_doc = Interface_AttachmentVW::where("activity_type", $interface_type)
          ->where("is_hidden", 0)
          ->where("fixed_in_interface_flag", 1)
          ->where("primary_id", $primary_id)
          ->where("attachment_type_id", $attachment_type_show)
          ->get();
    } else {
       $doc_setting = \App\Models\Setting\DocSettingsVW::where("fixed_in_interface_flag", 1)
         ->where("interface_type_id", $interface_type)
          ->get();
         $fixed_doc = \App\Models\Setting\Interface_AttachmentVW::where("activity_type", $interface_type)
          ->where("is_hidden", 0)
          ->where("fixed_in_interface_flag", 1)
          ->where("primary_id", $primary_id)
          ->get();
      }

    $labels = inputButton(Auth::user()->lang_id, 0);

    $view = view('setting.attachment.index_fixed', compact('pr_id', 'found_full_desc', 'allow_display', 'interface_type', 'labels', 'doc_setting', 'fixed_doc', 'attachment_type_not_show'))->render();
    return response(['status' => true, 'html' => $view]);
  }

  public function indexNotFixed($primary_id, $interface_type)
  {
    if ($interface_type == 10) {
      teamMemberCheck($primary_id, 10);
      is_permitted(120, getClassName(__CLASS__), __FUNCTION__, 287, 21);
    } elseif ($interface_type == 12) {
      teamMemberCheck($primary_id, 12);
      is_permitted(121, getClassName(__CLASS__), __FUNCTION__, 288, 21);
    } elseif ($interface_type == 11) {
      teamMemberCheck($primary_id, 11);
      is_permitted(122, getClassName(__CLASS__), __FUNCTION__, 289, 21);
    } else {
    }

    $labels = inputButton(Auth::user()->lang_id, 29);
    $none_fixed_doc = \App\Models\Setting\Interface_AttachmentVW::where("activity_type", $interface_type)
        ->where("is_hidden", 0)
        ->where("fixed_in_interface_flag", 0)
        ->where("primary_id", $primary_id)
        ->get();
//        $none_fixed_type=\App\Models\Opportunity\interfaceTypeSetting::where("interface_type_id",$interface_type)
//            ->where("is_hidden",0)
//            ->where("fixed_in_interface_flag",0)
//            ->get();
    $none_fixed_type = DocSettingsVW::where("fixed_in_interface_flag", 0)
        ->where("interface_type_id", $interface_type)
        ->where("is_hidden", 0)
        ->get();

    $userPermissions = getUserPermission();
    $view = view('setting.attachment.index_not_fixed', compact('interface_type', 'none_fixed_type', 'none_fixed_doc', 'labels', 'userPermissions'))->render();
    return response(['status' => true, 'html' => $view]);

  }

  public function createNotFixed($attachment_type_id)
  {
    $labels = inputButton(Auth::user()->lang_id, 0);
    $name = 'attachment_type_' . lang_character();
    $attachment_types = AttachmentTypes::where('id', $attachment_type_id)
        ->pluck($name, 'id');
    $userPermissions = getUserPermission();
    $attachments_allowed_types = AttachmentType::all()->pluck('attachment_type')->toArray();

    $accept = '';
    foreach ($attachments_allowed_types as $type) {
      $accept .= '.' . $type . ',';
    }
    return view('setting.attachment.create_fixed', compact('attachment_type_id', 'labels', 'userPermissions', 'attachment_types', 'attachments_allowed_types', 'accept'));
  }

  public function editNotFixed($id)
  {
    $labels = inputButton(Auth::user()->lang_id, 0);
    $attachment = Attachment::find($id);

    $name = 'attachment_type_' . lang_character();
    $attachment_types = AttachmentTypes::where('id', $attachment->attachment_type_id)
        ->pluck($name, 'id');

    $userPermissions = getUserPermission();
    $attachments_allowed_types = AttachmentType::all()->pluck('attachment_type')->toArray();

    $accept = '';
    foreach ($attachments_allowed_types as $type) {
      $accept .= '.' . $type . ',';
    }
    return view('setting.attachment.edit_fixed', compact('attachment', 'attachment_type_id', 'labels', 'userPermissions', 'attachment_types', 'attachments_allowed_types', 'accept'));
  }

  public function storeNotFixed(Request $request)
  {
    $input = $request->all();
    if (!empty($input['title'])) {
      $file_title = $input['title'];
    } else {
      $file_title = '';
    }
    if ($request->get('attachment_type_id') == null) {
      return response()->json(['status' => false, 'message' => getMessage('2.184')]);
    }

    $attachment_not_fixed = new Attachment();
    if (isset($input['attachment_id']) && is_file($_FILES['files']['tmp_name'])) {
      is_permitted(29, getClassName(__CLASS__), __FUNCTION__, 117, 2);
      $FileUploader = new FileUploader('files', array(
          'uploadDir' => 'public/attach/',
          'extensions' => attachments_allowed_types(),
          'title' => 'name'
      ));

      $data = $FileUploader->upload();
      if ($data['isSuccess']) {
        foreach ($data['files'] as $file) {
          $attachment = Attachment::find($input['attachment_id']);
          $attachment->file_path = str_replace(' ', '-', $file['old_name']);
          $attachment->file_type = $file['extension'];
          $attachment->attachment_type_id = $input['attachment_type_id'];
          $attachment->file_desc = $input['desc'];
          $attachment->file_title = $file_title;
          $attachment->file_name = str_replace(' ', '-', $file['old_name']);
          $attachment->updated_by = Auth::id();
          $attachment->save();
          $attachment_fixed = $attachment;
          rename('public/attach/' . $file['old_name'], 'public/attach/' . str_replace(' ', '-', $file['old_name']));
          Log::instance()->record('2.32', null, 29, null, null, null, null);
          Log::instance()->save();
          notifications(getClassName(__CLASS__), __FUNCTION__, '');
        }
      } else {
        return response()->json(['success' => false, 'error' => $data['warnings'], 'attachment' => null]);
      }
    } else if (isset($input['attachment_id']) && !is_file($_FILES['files']['tmp_name'])) {
      is_permitted(29, getClassName(__CLASS__), __FUNCTION__, 117, 2);
      $attachment = Attachment::find($input['attachment_id']);
      $attachment->file_desc = $input['desc'];
      $attachment->file_title = $file_title;
      $attachment->attachment_type_id = $input['attachment_type_id'];
      $attachment->updated_by = Auth::id();
      $attachment->save();
      $attachment_not_fixed = $attachment;
    } else if (!isset($input['attachment_id']) && is_file($_FILES['files']['tmp_name']) && isset($input['activity_type']) && isset($input['primary_id'])) {

      is_permitted(29, getClassName(__CLASS__), __FUNCTION__, 116, 1);

      $FileUploader = new FileUploader('files', array(
          'uploadDir' => 'public/attach/',
          'extensions' => attachments_allowed_types(),
          'title' => 'name'
      ));
      $data = $FileUploader->upload();
      if ($data['isSuccess']) {
        foreach ($data['files'] as $file) {
          $attachment = new Attachment();
          $attachment->activity_type = $input['activity_type'];
          $attachment->file_path = str_replace(' ', '-', $file['old_name']);
          $attachment->file_type = $file['extension'];
          $attachment->file_desc = $input['desc'];
          $attachment->file_title = $file_title;
          $attachment->attachment_type_id = $input['attachment_type_id'];

          $attachment->file_name = str_replace(' ', '-', $file['old_name']);
          $attachment->primary_id = $input['primary_id'];
          $attachment->created_by = Auth::id();
          $attachment->save();
          $attachment_not_fixed = $attachment;
          rename('public/attach/' . $file['old_name'], 'public/attach/' . str_replace(' ', '-', $file['old_name']));
          Log::instance()->record('2.31', null, 29, null, null, null, null);
          Log::instance()->save();
          notifications(getClassName(__CLASS__), __FUNCTION__, '');
        }
      } else {
        return response()->json(['success' => false, 'error' => $data['warnings'], 'attachment' => null]);
      }

    } else if (!is_file($_FILES['files']['tmp_name']) || !isset($input['activity_type']) || !isset($input['primary_id'])) {
      return response()->json(['success' => false, 'error' => '', 'message' => getMessage('2.313'), 'attachment' => null]);
    }
    return response()->json(['success' => true, 'message' => getMessage('2.63')]);

  }


}
