@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/checkbox.css') }}" rel="stylesheet">

@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Group</div>

                    <div class="panel-body">

                        <div class="form-group">
                            {!! Form::label('user_id', 'اسم المستخدم', ['class' => 'awesome'])  !!}
                            {!! Form::select('user_id', $users ,['id'=>'user_id','class'=>'form-control','placeholder'=>'  ']) !!}
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
            var url = '{{route("permission.group.GroupRow")}}' + '/' + user_id;

            $.ajax({
                url: url,
                dataTypes: 'html',
                beforeSend: function () {
                },
                success: function (data) {
                  $('#groupList').empty();
                  $('#groupList').html(data);
                },
                error: function () {
                }
            })

        });



        $(document).on('change', '.groupId', function (e) {
            e.preventDefault();
            //  var dataForm = $('#formAdd').serialize();
            var id = $(this).attr('group-id');
            var checkType ="";
            if($(this).is(':checked')){
                checkType ='check';
            }else{
                checkType ='uncheck';
            }

            var user_id = $('#user_id').val();
            var url = '{{route("permission.group.grantUserGroup")}}' + '/' + user_id + '/' + id +'/'+checkType;

            $.ajax({
                url: url,
                dataTypes: 'json',
                beforeSend: function () {

                },
                success: function (data) {

                },
                error: function () {

                }
            })
        })


    </script>

@endsection