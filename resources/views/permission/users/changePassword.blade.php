@extends('layouts._layout')

@section('content')





    <div class="col-md-12">


        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {!! Form::open(['route' => 'permission.user.storeChangePassword' ,'action'=>'post' ,'id'=>'formAdd']) !!}
        <div class="card ">
            <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                    <h4 class="card-title">
                        <i class="material-icons">lock</i>

                    </h4>
                </div>
            </div>
            <div class="card-body ">

                <div class="row">
                    {!! Form::label('old_password', 'Current Password ', ['class' => 'col-sm-2 col-form-label'])  !!}
                    <div class="col-sm-7">
                        <div class="form-group">
                            {!! Form::password('old_password',['class'=>'form-control','placeholder'=>'  ','required'=>'true']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">

                    {!! Form::label('password', 'Password', ['class' => 'col-sm-2 col-form-label'])  !!}
                    <div class="col-sm-7">
                        <div class="form-group">
                            {!! Form::password('password',['class'=>'form-control','placeholder'=>'  ' ,'required'=>'true']) !!}
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

            </div>
            <div class="card-footer ml-auto mr-auto">
                {!! Form::submit('Save',['class'=>'btn btn-rose' ,'id'=>'formAddSubmit']) !!}
            </div>

            {!! Form::close() !!}

        </div>
    </div>


@endsection