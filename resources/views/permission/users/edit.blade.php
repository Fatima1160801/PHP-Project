@extends('layouts._layout')

@section('content')

    <div class="card card-wizard" data-color="rose" id="wizardNotification">
        <div class="card-header card-header-rose card-header-text">
{{--           --}}
            <h4 class="card-title">{{Auth::user()->lang_id == 1 ? 'Edit User' : 'تعديل مستخدم'}}</h4>
        </div>
        <br><br>
        <div class="wizard-navigation">
            <ul class="nav nav-pills">
                <li class="nav-item" id="task_link" data-task-id="">
                    <a class="nav-link active" href="#user_info" data-toggle="tab" role="tab">
                        {{Auth::user()->lang_id == 1 ? 'User Info' : 'بيانات المستخدم'}}
                    </a>
                </li>
                <li class="nav-item" id="task_link" data-task-id="">
                    <a class="nav-link" href="#configure_perms" data-toggle="tab" role="tab">
                        <div class="card-icon">--}}
                            {{--                <i class="material-icons">person_add</i>--}}
                            {{--            </div>                        {{Auth::user()->lang_id == 1 ? 'Data Permission' : 'صلاحيات البيانات للمستخدم'}}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="user_info">
                                                {!! Form::open(['route' => 'permission.user.update' ,'method' => 'put' ,'id'=>'formAdd']) !!}
                                                <div class="card-body ">
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif

                                                    {!! Form::hidden('id',$user->id ,['class'=>'hidden','id'=>'id']) !!}

                                                        <div class="row">
                                                            <label for="staff_id" class="col-md-2 col-form-label">Staff Name</label>
                                                            <div class="col-md-7">
                                                                <div class='form-group has-default bmd-form-group'>
                                                                    <select class='form-control  selectpicker' data-live-search="true" name='staff_id'
                                                                            data-style='btn btn-link' id='staff_id'>
                                                                        <option style='height: 37px;' value></option>
                                                                        @if (!empty($staff))
                                                                            @foreach ($staff as $key => $value)
                                                                                <option @if($user->staff_id == $key) selected @endif value='{{$key}}'>{{$value}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                        {!! Form::label('user_name', 'User Name ', ['class' => 'col-sm-2 col-form-label'])  !!}
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                {!! Form::text('user_name', $user->user_name ,['class'=>'form-control','placeholder'=>' ','required'=>'true']) !!}
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        {!! Form::label('user_full_name', '  Full User Name', ['class' => 'col-sm-2 col-form-label'])  !!}
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                {!! Form::text('user_full_name',$user->user_full_name ,['class'=>'form-control','placeholder'=>'  ','required'=>'true' ,'readonly'=>'readonly']) !!}
                                                            </div>
                                                        </div>
                                                    </div>




                                                        <div class="row">
                                                            {!! Form::label('job_title', '  Job Title', ['class' => 'col-sm-2 col-form-label'])  !!}
                                                            <div class="col-sm-7">
                                                                <div class="form-group">
                                                                    {!! Form::text('job_title',$user->job_title ,['class'=>'form-control','placeholder'=>'  ','required'=>'true' ,'readonly'=>'readonly']) !!}
                                                                </div>
                                                            </div>
                                                        </div>


                                                    <div class="row">
                                                        {!! Form::label('email', 'Email', ['class' => 'col-sm-2 col-form-label'])  !!}
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                {!! Form::email('email', $user->email ,['class'=>'form-control','placeholder'=>'  ','required'=>'true','email'=>'true','readonly'=>'readonly']) !!}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <label for="user_id" class="col-md-2 col-form-label">User Type</label>
                                                        <div class="col-md-7">
                                                            <div class='form-group has-default bmd-form-group'>
                                                                <select class='form-control selectpicker' name='user_type' data-style='btn btn-link' id='user_type'>
                                                                    <option style='height: 37px;' value></option>
                                                                    <option style='height: 37px;' value="1">Admin</option>
                                                                    <option style='height: 37px;' value="2">Project Manager or Coordinator</option>
                                                                    <option style='height: 37px;' value="3">Casual User</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        document.getElementById('user_type').value = '{{$user->user_type}}';
                                                    </script>

                                                    <div class="row">
                                                        {!! Form::label('password', 'Password', ['class' => 'col-sm-2 col-form-label'])  !!}
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                {!! Form::password('password',['class'=>'form-control','placeholder'=>'  ']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        {!! Form::label('password_confirmation', 'Password Confirmation', ['class' => 'col-sm-2 col-form-label'])  !!}
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'  ']) !!}
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        {!! Form::label('notes', 'Notes', ['class' => 'col-sm-2 col-form-label'])  !!}
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                {!! Form::textarea('notes',$user->notes  ,['class'=>'form-control','placeholder'=>'  ']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="card-footer ml-auto mr-auto">
                                                    <div class="ml-auto mr-auto">
                                                        <a class="btn btn-default" href="{{route('permission.user.index')}}">Back</a>
                                                        {!! Form::submit('Save',['class'=>'btn btn-rose', 'id' =>'formAddSubmit']) !!}
                                                    </div>
                                                </div>


                                                {!! Form::close() !!}
                                            </div>
                                            <div class="tab-pane" id="configure_perms">
                                                <p>Select the projects & activities permitted for this user. </p>

                                                {!! Form::open(['route' => 'permission.user.updateDataPerms' ,'method' => 'POST' ,'id'=>'formUserDataPermission']) !!}

                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th width="20%">Permission</th>
                                                                <th width="70%">Permission Type</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr class="background-color-indicator-activity">
                                                                <td  style="padding: 8px !important;"><b>{{Auth::user()->lang_id == 1 ? 'Projects' : 'المشاريع'}}</b></td>
                                                                <td collapse="8" style="padding: 8px !important;">
                                                                      <div class="form-group has-default bmd-form-group">
                                                                          <div class="form-check form-check-radio form-check-inline"><!-- #9c27b0 -->
                                                                              <label class="form-check-label" style="color: #3e3b3b;"><input class="form-check-input" id="32" name="projects_perms_type" type="radio" value="all" {{$user_data_perms->where('module_id',1)->where('perm_type',1)->count() > 0 ? 'checked' : ''}}>{{Auth::user()->lang_id == 1 ? 'All Projects' : 'كل المشاريع'}} <span class="circle"><span class="check"></span></span></label>
                                                                          </div>
                                                                          <div class="form-check form-check-radio form-check-inline">
                                                                              <label class="form-check-label" style="color: #3e3b3b;"><input class="form-check-input" id="3ff" name="projects_perms_type" type="radio" value="inc" {{$user_data_perms->where('module_id',1)->where('perm_type',3)->count() > 0 ? 'checked' : ''}}>{{Auth::user()->lang_id == 1 ? 'Projects Assigned to him/her' : 'المشاريع الموجود فيها'}} <span class="circle"><span class="check"></span></span></label>
                                                                          </div>
                                                                          <div class="form-check form-check-radio form-check-inline">
                                                                              <label class="form-check-label" style="color: #3e3b3b;"><input class="form-check-input" id="3ffs" name="projects_perms_type" type="radio" value="some" {{$user_data_perms->where('module_id',1)->where('perm_type',2)->count() > 0 ? 'checked' : ''}}>{{Auth::user()->lang_id == 1 ? 'Some Projects' : 'بعض المشاريع'}} <span class="circle"><span class="check"></span></span></label>
                                                                          </div>
                                                                      </div>
                                                                </td>
                                                                <td></td>
                                                            </tr>

                                                            @if($projects != null)
                                                                @foreach($projects as $project)
                                                                    <tr class="background-color-result-activity project" style="display: {{$user_data_perms->where('module_id',1)->where('perm_type',2)->count() > 0 ? '' : 'none'}}">
                                                                        <td width="10%"></td>
                                                                        <td width="10%">
                                                                            <div class="form-check">
                                                                                <label class="form-check-label">
                                                                                    <input class="form-check-input resultCheckBox" name="permitted_projects[]" type="checkbox" value="{{$project->id}}" {{in_array($project->id,$user_data_perms_modules->where('module_id',1)->pluck('primary_id')->toArray()) ? 'checked' : ''}}>
                                                                                       {{Auth::user()->lang_id == 1 ? $project->project_name_na : $project->project_name_fo}}
                                                                                    <span class="form-check-sign">  <span class="check"></span>    </span>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td width="50%"></td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif

                                                            <tr class="background-color-indicator-activity">
                                                                <td  style="padding: 8px !important;"><b>{{Auth::user()->lang_id == 1 ? 'Activities' : 'الأنشطة'}}</b></td>
                                                                <td collapse="8" style="padding: 8px !important;">
                                                                    <div class="form-group has-default bmd-form-group">
                                                                        <div class="form-check form-check-radio form-check-inline">
                                                                            <label class="form-check-label" style="color: #3e3b3b;"><input class="form-check-input" id="" name="activities_perms_type" type="radio" value="all" {{$user_data_perms->where('module_id',2)->where('perm_type',1)->count() > 0 ? 'checked' : ''}}>{{Auth::user()->lang_id == 1 ? 'All Activities' : 'كل الأنشطة'}} <span class="circle"><span class="check"></span></span></label>
                                                                        </div>
                                                                        <div class="form-check form-check-radio form-check-inline">
                                                                            <label class="form-check-label" style="color: #3e3b3b;"><input class="form-check-input" id="" name="activities_perms_type" type="radio" value="inc" {{$user_data_perms->where('module_id',2)->where('perm_type',3)->count() > 0 ? 'checked' : ''}}>{{Auth::user()->lang_id == 1 ? 'Activities Assigned to him/her' : 'أنشطة موجود فيها'}} <span class="circle"><span class="check"></span></span></label>
                                                                        </div>
                                                                        <div class="form-check form-check-radio form-check-inline">
                                                                            <label class="form-check-label" style="color: #3e3b3b;"><input class="form-check-input" id="" name="activities_perms_type" type="radio" value="some" {{$user_data_perms->where('module_id',2)->where('perm_type',2)->count() > 0 ? 'checked' : ''}}>{{Auth::user()->lang_id == 1 ? 'Some Activities' : 'بعض الأنشطة'}} <span class="circle"><span class="check"></span></span></label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td></td>
                                                            </tr>

                                                            @if($activities != null)
                                                                @foreach($activities as $activity)
                                                                    <tr class="background-color-result-activity activity" style="display: {{$user_data_perms->where('module_id',2)->where('perm_type',2)->count() > 0 ? '' : 'none'}}">
                                                                        <td width="10%"></td>
                                                                        <td width="10%">
                                                                            <div class="form-check">
                                                                                <label class="form-check-label">
                                                                                    <input class="form-check-input resultCheckBox" name="permitted_activities[]" type="checkbox" value="{{$activity->id}}" {{in_array($activity->id,$user_data_perms_modules->where('module_id',2)->pluck('primary_id')->toArray()) ? 'checked' : ''}}>
                                                                                    {{Auth::user()->lang_id == 1 ? $activity->activity_name_na : $activity->activity_name_fo}}
                                                                                    <span class="form-check-sign">  <span class="check"></span> </span>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td width="50%"></td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif

                                                        </tbody>
                                                    </table>

                                                    <div class="card-footer ml-auto mr-auto">
                                                        <div class="ml-auto mr-auto">
                                                            <a class="btn btn-default btn-previous" href="#">Back</a>
                                                            <button type="submit" id="formAddSubmit_" class="btn btn-rose">
                                                                <div class="loader pull-left" style="display: none;"></div>
                                                                {{$labels['save'] ?? 'save'}}
                                                            </button>
                                                        </div>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @endsection
                            @section('script')
                                <script>

                                $(document).ready(function () {
                                    active_nev_link('user');

                                    $('.selectpicker').selectpicker();

                                });

                                $(function () {

                                    $('input[name="projects_perms_type"]').change(function(){
                                        var value = $(this).val();

                                        if(value == 'all' || value == 'inc')
                                        {
                                            $('.project').hide();
                                        }
                                        else if(value == 'some')
                                        {
                                            $('.project').show();
                                        }
                                    });

                                    $('input[name="activities_perms_type"]').change(function(){
                                        var value = $(this).val();
                                        if(value == 'all' || value == 'inc')
                                        {
                                            $('.activity').hide();
                                        }
                                        else if(value == 'some')
                                        {
                                            $('.activity').show();
                                        }
                                    });

                                    $('#formUserDataPermission').submit(function(e){
                                        e.preventDefault();
                                        var form = $(this).serialize();
                                        var url = $(this).attr('action');
                                        $.ajax({
                                            url: url,
                                            data: form,
                                            type: 'post',
                                            beforeSend: function () {
                                                $('#formAddSubmit_').attr("disabled", true);
                                                $('.loader').show();
                                            },
                                            success: function (data) {
                                                $('.loader').hide();
                                                $('#formAddSubmit_').attr("disabled", false);
                                                if (data.success == true) {
                                                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                                } else if (data.success == false) {
                                                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                                }
                                            },
                                            error: function (data) {
                                            }
                                        });
                                    });

                                });


                                </script>
                                {{--$(document).on('click', '#formAddSubmit', function (e) {--}}
    {{--e.preventDefault();--}}
    {{--var dataForm = $('#formAdd').serialize();--}}
    {{--var url = $('#formAdd').attr('action');--}}
    {{--$.ajax({--}}
    {{--url: url,--}}
    {{--data: dataForm,--}}
    {{--type: 'post',--}}
    {{--dataTypes: 'json',--}}
    {{--beforeSend: function () {--}}

    {{--},--}}
    {{--success: function (data) {--}}

    {{--if (data.status == 'save') {--}}
    {{--var row = data.data.replace('{index}', $('#table tbody tr').length + 1);--}}
    {{--$(row).appendTo('#table tbody');--}}

    {{--} else if (data.status == 'edit') {--}}


    {{--}--}}

    {{--},--}}
    {{--error: function () {--}}

    {{--}--}}
    {{--});--}}


    {{--})--}}

    {{--$(document).on('click', '#btnEdit', function (e) {--}}
    {{--e.preventDefault();--}}
    {{--var url = $('#btnEdit').attr('href');--}}
    {{--$.ajax({--}}
    {{--url: url,--}}
    {{--type: 'get',--}}
    {{--dataTypes: 'json',--}}
    {{--beforeSend: function () {--}}
    {{--},--}}
    {{--success: function (data) {--}}
    {{--console.log(data.data);--}}
    {{--distributionData(data.data);--}}
    {{--},--}}
    {{--error: function () {--}}
    {{--}--}}
    {{--});--}}

    {{--});--}}

    {{--function distributionData(data) {--}}
    {{--$('#group_name').val(data.group_name);--}}
    {{--$('#id').val(data.id);--}}
    {{--}--}}


    {{--</script>--}}


    <script>
        $(document).on('change','#staff_id',function (e) {
            console.log(123);
            e.preventDefault();
            var staff_id = $(this).val();
            $url = '{{route('permission.user.staff_ajax')}}' + '/' + staff_id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                    $('#user_full_name').val('')
                    $('#email').val('')
                    $('[name="job_title"]').val('')
                },
                success: function (data) {
                    console.log(data.job_title_name_na);
                    if(data){
                        $('#user_full_name').val(data.staff_name_na)
                        $('#email').val(data.email)
                        $('[name="job_title"]').val(data.job_title_name_na)
                    }

                },
                error: function () {

                }
            });

        })


    </script>
@endsection

@section('js')
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>

    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/notifi_settings_wizard.js')}}"></script>
    <script>

        wizard();

        function wizard() {
            notifiWizard.initMaterialWizard();
            setTimeout(function () {
                $('#wizardNotification').addClass('active');
            }, 100);
        }

    </script>
@endsection


