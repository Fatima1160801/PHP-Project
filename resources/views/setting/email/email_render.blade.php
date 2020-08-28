<div class="card ">
    <div class="card-header card-header-rose  card-header-icon">
        {{--        <div class="card-icon">--}}
        {{--            <i class="material-icons">desktop_windows</i>--}}
        {{--        </div>--}}
        <h4 class="card-title">
            {{$labels['EmailSettings'] ?? 'Email Settings'}}
        </h4>
    </div>
    <div class="card-body ">

        <div id="result-msg"></div>
        {!! Form::open(['route'=>'settings.email.store','novalidate'=>'novalidate','method'=>'post' ,'id'=>'formSearch']) !!}

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {!! $html !!}
        <input type="hidden" name="button_clicked" id="button_clicked" value="">
        <div class="col-md-12">
            <div class="card-footer ml-auto mr-auto">
                <div class="ml-auto mr-auto">
                    <button btn="btnToggleDisabled" type="submit" id="btnSearch"
                            class="btn btn-next btn-rose pull-right btn-sm">
                        <div class="loader pull-left" style="display: none;"></div> {{$labels['search'] ?? 'search'}}
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">

                <div class=" col-md-3 bolder">
                    {{$labels['command_name'] ?? 'Command Name'}}
                </div>
                <div class=" col-md-3 bolder">
                    {{$labels['email_flag'] ?? 'Email '}}
                </div>
                <div class=" col-md-3 bolder">
                    {{$labels['notification_flag'] ?? 'Notification'}}
                </div>

            </div>
        </div>
        <hr>
        @if(!empty($results) && sizeof($results) >0)
            @foreach($results as $result)
                <div class="col-md-12">
                    <div class="row">
                        <!-- <label for="interface_type_na" class="col-md-1 col-form-label">label</label> -->
                        <div class=" col-md-3">
                            <div class="form-group has-default bmd-form-group">
                                {{--                        <label>{{$result->commandType ? $result->commandType->{'command_'.lang_character()} :""}}</label>--}}
                                <label>{{$result->command_name ?? ""}}</label>
                                {{--<input type="text" value="{{$result->label}}" class="form-control  " name="label_{{$result->id}}" id="label_{{$result->id}}" required="" minlength="0" maxlength="100" alt="Inerface">--}}
                            </div>
                        </div>
                        {{--                <input type="hidden" value="107" name="screen_id">--}}
                        <input type="hidden" value="{{$result->id ?? ""}}" name="command_id[]">
                        <input type="hidden" value="{{$result->screen_command_type_id ?? ""}}" name="command_type_{{$result->id ?? 0}}">
                        {{--                <div class='col-md-3'>--}}
                        {{--                    <div class="togglebutton switch-sidebar-mini">--}}
                        {{--                        <label class="text-dark">--}}
                        {{--                            <input name="email_flag_{{$result->id ?? ""}}"  value="1" class="permissionCheckBoxUser notificationCommand" id="to_main_sup_{{$result->id ?? 0}}" type="checkbox" >--}}
                        {{--                            <span class="toggle"></span>--}}
                        {{--                        </label>--}}
                        {{--                    </div>--}}
                        {{--                </div >--}}
                        <div class='col-md-3'>
                            <div class='form-check  form-check-inline'>
                                <label class='form-check-label'>
                                    @if(sizeof($apply_email_message_flag) >0)
                                        @if(in_array($result->id, $apply_email_message_flag))
                                            <input class='form-check-input permissionCheckBoxUser' checked type='checkbox' value='1' name='email_flag_{{$result->id ?? 0}}'/>
                                        @else
                                            <input class='form-check-input permissionCheckBoxUser' type='checkbox' value='1' name='email_flag_{{$result->id ?? 0}}'/>
                                        @endif
                                    @else
                                        <input class='form-check-input permissionCheckBoxUser' type='checkbox' value='1' name='email_flag_{{$result->id ?? 0}}'/>
                                    @endif
                                    <span class='form-check-sign'>
                         <span class='check'></span>
                        </span>
                                </label>
                            </div>
                        </div>

                        <div class='col-md-3'>
                            <div class='form-check  form-check-inline'>
                                <label class='form-check-label'>
                                    @if(sizeof($apply_notification_flag) >0)
                                        @if(in_array($result->id, $apply_notification_flag))
                                            <input class='form-check-input permissionCheckBoxUser' checked type='checkbox' value='1' name='notit_flag_{{$result->id ?? 0}}'/>
                                        @else
                                            <input class='form-check-input permissionCheckBoxUser' type='checkbox' value='1' name='notit_flag_{{$result->id ?? 0}}'/>
                                        @endif
                                    @else
                                        <input class='form-check-input permissionCheckBoxUser' type='checkbox' value='1' name='notit_flag_{{$result->id ?? 0}}'/>
                                    @endif
                                    <span class='form-check-sign'>
                         <span class='check'></span>
                        </span>
                                </label>
                            </div>
                        </div>

                        {{--                <div class='col-md-3'>--}}
                        {{--                    <div class="togglebutton switch-sidebar-mini">--}}
                        {{--                        <label class="text-dark">--}}
                        {{--                            <input name="notification_flag_{{$result->id ?? ""}}" value="1" class="permissionCheckBoxUser notificationCommand" id="to_notit_flag_{{$result->id ?? 0}}" type="checkbox" >--}}
                        {{--                            <span class="toggle"></span>--}}
                        {{--                        </label>--}}
                        {{--                    </div>--}}
                        {{--                </div >--}}
                        {{--                <div class=" col-md-3">--}}
                        {{--                    <div class="form-group has-default bmd-form-group">--}}
                        {{--                        <label>{{$result->label_hint ?? ""}}</label>--}}
                        {{--                        --}}{{--<input type="text" value="{{$result->label_hint}}" class="form-control  " name="labelHint_{{$result->id}}" id="labelHint_{{$result->id}}" required="" minlength="0" maxlength="100" alt="Inerface">--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}
                        {{--                <div class=" col-md-3">--}}
                        {{--                    <div class="form-group has-default bmd-form-group">--}}
                        {{--                        <input type="text" value="" class="form-control  " name="labelNew_{{$result->id}}" id="labelNew_{{$result->id}}" required="" minlength="0" maxlength="100" alt="Inerface">--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}
                    </div>
                </div>
            @endforeach

            <div class="col-md-12">

                <div class="card-footer ml-auto mr-auto">
                    <div class="ml-auto mr-auto">
                        <button btn="btnToggleDisabled" type="submit" id="btnSave"
                                class="btn btn-next btn-rose pull-right btn-sm">
                            <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                        </button>
                    </div>
                </div>
            </div>
@endif
{!! Form::close() !!}
{{--        @if($id==2)--}}
{{--            <button btn="btnToggleDisabled" type="submit" onclick="search()" id="btnSearch"--}}
{{--                    class="btn btn-next btn-rose pull-right btn-sm">--}}
{{--                <div class="loader pull-left" style="display: none;"></div> {{$labels['search'] ?? 'search'}}--}}
{{--            </button>--}}
{{--        @endif--}}
        @if($id==1)
            <button type="button"  class="btn  btn-sm btn-default" onclick='location.href="{{ route('settings.system.screen')}}"'>Back</button>
        @endif
    </div>
</div>