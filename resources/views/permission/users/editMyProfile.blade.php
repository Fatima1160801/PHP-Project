@extends('layouts._layout')

@section('content')
    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">person</i>
            </div>
            <h4 class="card-title">My Profile</h4>
        </div>
        {!! Form::open(['route' => 'permission.user.updateMyProfile' ,'method' => 'post','enctype'=>'multipart/form-data' ,'id'=>'formAdd']) !!}

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
            {!! Form::hidden('id',$user->id ,['id'=>'id']) !!}
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        {!! Form::label('user_name', 'User Name ', ['class' => 'col-sm-2 col-form-label'])  !!}
                        <div class="col-sm-7">
                            <div class="form-group">
                                {!! Form::text('user_name', $user->user_name ,['class'=>'form-control','placeholder'=>'  ']) !!}
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        {!! Form::label('user_full_name', ' Full Name', ['class' => 'col-sm-2 col-form-label'])  !!}
                        <div class="col-sm-7">
                            <div class="form-group">
                                {!! Form::text('user_full_name', $user->user_full_name ,['class'=>'form-control','placeholder'=>'  ']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {!! Form::label('email', 'email', ['class' => 'col-sm-2 col-form-label'])  !!}
                        <div class="col-sm-7">
                            <div class="form-group">
                                {!! Form::text('email', $user->email ,['class'=>'form-control','placeholder'=>'  ']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {!! Form::label('job_title', 'Job Title', ['class' => 'col-sm-2 col-form-label'])  !!}
                        <div class="col-sm-7">
                            <div class="form-group">
                                {!! Form::text('job_title', $user->job_title ,['class'=>'form-control','placeholder'=>'  ']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {!! Form::label('notes', 'Notes', ['class' => 'col-sm-2 col-form-label'])  !!}
                        <div class="col-sm-7">
                            <div class="form-group">
                                {!! Form::textarea('notes', $user->notes ,['class'=>'form-control','placeholder'=>'  ']) !!}
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="col-md-12">
                        <h4 class="title"></h4>
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new thumbnail img-circle">
                                @if($user->user_photo)
                                    <img src="{{asset('images/user/photo/').'/'.$user->user_photo}}" alt="...">
                                @else
                                    <img src="{{asset('assets/img/placeholder.png')}}"/>
                                @endif
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                            <div>
                  <span class="btn btn-round btn-rose btn-file">
                    <span class="fileinput-new">Add Photo</span>
                    <span class="fileinput-exists">Change</span>
                      {!! Form::file('user_photo') !!}
                  </span>
                                <br>
                                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                   data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-footer text-right">
            {!! Form::submit('Save',['class'=>'btn btn-fill btn-rose' ,'id'=>'formAddSubmit']) !!}
        </div>


        {!! Form::close() !!}
    </div>

@endsection
@section('script')

@endsection
@section('js')
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>
@endsection


