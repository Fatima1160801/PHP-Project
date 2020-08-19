@extends('layouts._layout')

@section('content')

    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">person_add--}}
{{--                </i>--}}
{{--            </div>--}}
            <h4 class="card-title">Add User</h4>

        </div>

        {!! Form::open(['route' => 'permission.user.store' ,'action'=>'post' ,'id'=>'formAdd']) !!}
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
                <a class="btn btn-default  " href="{{route('permission.user.index')}}">Back</a>
                {!! Form::submit('Save',['class'=>'btn btn-next   btn-rose' ,'id'=>'formAddSubmit']) !!}
            </div>

        </div>


        {!! Form::close() !!}
    </div>




@endsection
@section('script')

    <script>


        $(document).ready(function () {
            active_nev_link('user');

            funValidateForm();
            $('.selectpicker').selectpicker();

        });

        $(document).on('submit', '#formAdd', function (e) {
            if (!is_valid_form($(this))) {
                return false
            }
        })

    </script>
    {{--<script>--}}

    {{--$(document).ready(function () {--}}


    {{--});--}}
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
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
@endsection

