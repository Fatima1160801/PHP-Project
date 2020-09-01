<div class="card-header card-header-rose card-header-text">
    {{--            <div class="card-icon">--}}
    {{--                <i class="material-icons">person_add--}}
    {{--                </i>--}}
    {{--            </div>--}}
{{--    <h4 class="card-title">Add User</h4>--}}

</div>
@if($id==1)
{!! Form::open(['route' => ['permission.user.store',1] ,'action'=>'post' ,'id'=>'formAdd']) !!}
@else
    {!! Form::open(['route' => ['permission.user.store',2] ,'action'=>'post' ,'id'=>'formAdd']) !!}

@endif
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

    <div class="row">
        <label for="staff_id" class="col-md-2 col-form-label">Staff Name</label>
        <div class="col-md-7">
            <div class='form-group has-default bmd-form-group'>
                <select class='form-control  selectpicker' data-live-search="true" name='staff_id'
                        data-style='btn btn-link'
                        id='staff_id'>
                    <option style='height: 37px;' value></option>
                    @if ($staff)
                        @foreach ($staff as $key => $value)
                            <option value='{{$key}}'>{{$value}}</option>
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
                {!! Form::text('user_name', '' ,['class'=>'form-control','placeholder'=>' ','required'=>'true' ,'minlength'=>'6' ,'maxlength'=>'30' ]) !!}
            </div>
        </div>
    </div>


    <div class="row">
        {!! Form::label('user_full_name', '  Full User Name', ['class' => 'col-sm-2 col-form-label'])  !!}
        <div class="col-sm-7">
            <div class="form-group">
                {!! Form::text('user_full_name', '' ,['class'=>'form-control','placeholder'=>'  ','required'=>'true','readonly'=>'readonly']) !!}
            </div>
        </div>
    </div>



    <div class="row">
        {!! Form::label('job_title', 'Job Title', ['class' => 'col-sm-2 col-form-label'])  !!}
        <div class="col-sm-7">
            <div class="form-group">
                {!! Form::text('job_title', '' ,['class'=>'form-control','placeholder'=>'  ','required'=>'true','readonly'=>'readonly']) !!}
            </div>
        </div>
    </div>


    <div class="row">
        {!! Form::label('email', 'Email', ['class' => 'col-sm-2 col-form-label'])  !!}
        <div class="col-sm-7">
            <div class="form-group">
                {!! Form::email('email', '' ,['class'=>'form-control noArabic','placeholder'=>'  ','required'=>'true','email'=>'true','readonly'=>'readonly']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <label for="staff_id" class="col-md-2 col-form-label">User Type</label>
        <div class="col-md-7">
            <div class='form-group has-default bmd-form-group'>
                <select class='form-control  selectpicker' name='user_type' data-style='btn btn-link'
                        id='user_type'>
                    <option style='height: 37px;' value></option>
                    <option style='height: 37px;' value="1">Admin</option>
                    <option style='height: 37px;' value="2">Project Manager or Coordinator</option>
                    <option style='height: 37px;' value="3">Casual User</option>
                </select>
            </div>
        </div>
    </div>


    <div class="row">
        {!! Form::label('password', 'Password', ['class' => 'col-sm-2 col-form-label'])  !!}
        <div class="col-sm-7">
            <div class="form-group">
                {!! Form::password('password',['class'=>'form-control','placeholder'=>'  ','required'=>'true']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        {!! Form::label('password_confirmation', 'Password Confirmation', ['class' => 'col-sm-2 col-form-label'])  !!}
        <div class="col-sm-7">
            <div class="form-group">
                {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'  ','required'=>'true']) !!}
            </div>
        </div>
    </div>


    <div class="row">
        {!! Form::label('notes', 'Notes', ['class' => 'col-sm-2 col-form-label'])  !!}
        <div class="col-sm-7">
            <div class="form-group">
                {!! Form::textarea('notes', '' ,['class'=>'form-control','placeholder'=>'  ']) !!}
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <div class="ml-auto mr-auto">
        @if($id==1)
        <a class="btn btn-default btn-sm  " href="{{route('permission.user.index')}}">Back</a>
        @else
            <button type="button" class="btn btn-default btn-sm" onclick="defaultVal()" data-dismiss="modal">Back</button>
        @endif
        {!! Form::submit('Save',['class'=>'btn btn-next   btn-rose btn-sm' ,'id'=>'formAddSubmit']) !!}
    </div>

</div>


{!! Form::close() !!}
</div>