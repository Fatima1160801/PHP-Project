@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/checkbox.css') }}" rel="stylesheet">

@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Permission</div>

                    <div class="panel-body">

                        {!! Form::text('screen_id', $screen->screen_id ,['id'=>'screen_id','class'=>'form-control hidden','placeholder'=>'  ']) !!}

                        <div class="form-group">

                            {!! Form::label('user_id', 'اسم المستخدم', ['class' => 'awesome'])  !!}
                            {!! Form::select('user_id', $users ,'1',['id'=>'user_id','class'=>'form-control','placeholder'=>'  ']) !!}
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <!-- Default panel contents -->
                                    <div class="card-header">Checkbox to Round Switch</div>

                                    <ul class="list-group list-group-flush" id="groupList">


                                    </ul>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

        $(document).ready(function () {
          $('#user_id').change();


        });
        $(document).on('change', '#user_id', function (e) {
            e.preventDefault();
            var user_id = $('#user_id').val();
            var screen_id = $('#screen_id').val();
            var url = '{{route("permission.screen.screencommand")}}' + '/' + screen_id+ '/' + user_id;

            $.ajax({
                url: url,
                dataTypes: 'html',
                beforeSend: function () {
                    $('#groupList').empty();
                },
                success: function (data) {
                  $('#groupList').empty();
                  $('#groupList').html(data);
                },
                error: function () {

                }
            })

        });



        $(document).on('change', '.commandId', function (e) {
            e.preventDefault();
            //  var dataForm = $('#formAdd').serialize();
            var command_id= $(this).attr('command-id');
            var screen_id = $(this).attr('screen-id');
            var command_type_id = $(this).attr('command-type-id');


            var user_id = $('#user_id').val();

            var checkType ="";
            if($(this).is(':checked')){
                checkType ='check';
            }else{
                checkType ='uncheck';
            }
            data ={
                'screen_id':screen_id,
                'command_id':command_id,
                'command_type_id':command_type_id,
                'user_id':user_id,
                'checkType':checkType
            };
            var url = '{{route("permission.screen.grant")}}';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data:data,
                type:'post',
                beforeSend: function () {

                },
                success: function (data) {
                   console.log(data);
                },
                error: function () {

                }
            })
        })


    </script>

@endsection