@extends('layouts.app')
@section('css')

    <link href="{{ asset('css/checkbox.css') }}" rel="stylesheet">

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Group Permission</div>
                    <div class="panel-body">


                            <form>
                                <div class="form-group">
                                    {!! Form::label('id', 'اسم المستخدم', ['class' => '','for'=>'id'])  !!}
                                    {!! Form::select('id', $groupList ,'1',['id'=>'id','class'=>'form-control','placeholder'=>'  ']) !!}



                                </div>
                            </form>

                    </div>
                    <div class="panel-body" id="groupPermission">


                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>


        $(document).ready(function () {
         $('#id').change();
        });
        $(document).on('change', '#id', function (e) {
            e.preventDefault();
            var id = $('#id').val();
            var url = '{{route("permission.group.permission")}}' + '/' + id;

            $.ajax({
                url: url,
                dataTypes: 'html',
                type:'get',
                beforeSend: function () {
                },
                success: function (data) {
                    $('#groupPermission').empty();
                    $('#groupPermission').html(data);
                },
                error: function () {

                }
            })

        });



        $(document).on('change', '.permissioncheckbox', function (e) {
            e.preventDefault();
            //  var dataForm = $('#formAdd').serialize();
            var command_id      = $(this).attr('command-id');
            var screen_id       = $(this).attr('screen-id');
            var command_type_id = $(this).attr('command-type-id');
            var id        =$('#id').val();

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
                'id':id,
                'checkType':checkType
            };
            var url = '{{route("permission.group.grant")}}';

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


