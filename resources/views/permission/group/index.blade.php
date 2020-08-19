@extends('layouts._layout')

@section('content')

    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons"> group_work--}}
{{--                </i>--}}
{{--            </div>--}}
            <h4 class="card-title">Add Group</h4>

        </div>
        <div class="card-body ">

            {!! Form::open(['route' => 'permission.group.store' ,'action'=>'post' ,'id'=>'formAdd']) !!}
            {!! Form::hidden('id') !!}
            <div class="row">
                <div class="col-md-8 form-group">

                    {!! Form::text('group_name', '' ,['class'=>'form-control','placeholder'=>'Group Name']) !!}
                </div>
                <div class="col-md-2">
                    {!! Form::submit('save',['class'=>' btn btn-primary' ,'id'=>'formAddSubmit']) !!}
                </div>
            </div>
            {!! Form::close() !!}

            <div class="table-responsive">

                <table id="table " class="table  dataTable no-footer table-bordered">
                    <thead>
                    <tr class="text-primary">
                        <th>#</th>
                        <th> Group Name</th>
                        <th>created by</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $group)
                          @include('permission.group.row')
                    @endforeach

                    </tbody>
                </table>
                <button type="button"  class="btn  btn-sm btn-default" onclick='location.href="{{ route('settings.users.screen')}}"'>Back</button>

            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>


        $(document).ready(function () {
            active_nev_link('group');

        });
        $(document).on('click', '#formAddSubmit', function (e) {
            e.preventDefault();
            var dataForm = $('#formAdd').serialize();

            console.log(dataForm);
            var url = $('#formAdd').attr('action');
            $.ajax({
                url: url,
                data: dataForm,
                type: 'post',
                dataTypes: 'json',
                beforeSend: function () {

                },
                success: function (data) {
                    var htmlRow = data.data.html;
                    var $massage='';
                    if (data.status == 'save') {
                        var length = $('#table tbody tr').length;
                        htmlRow = htmlRow.replace('{index}', length + 1);
                        $(htmlRow).appendTo('#table tbody');
                         $massage="Saved Successfully";
                    } else if (data.status == 'edit') {
                        var id = $('[name="id"]').val();
                        var $editedRow = $('tr[data-id="' + id + '"]');
                        var index = $('#table tbody tr').index($editedRow);
                        htmlRow = htmlRow.replace('{index}', index + 1);
                        $editedRow.replaceWith(htmlRow);
                         $massage="edited Successfully";
                    }
                    clearForm();

                    myNotify(icon = 'done', title = 'SUCCESS',type = 'success',delay = '5000',$massage);

                },
                error: function () {

                }
            });


        });

        $(document).on('click', '.btnEdit', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            console.log(url);
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'json',
                beforeSend: function () {
                },
                success: function (data) {
                    console.log(data.data);
                    distributionData(data.data);
                },
                error: function () {
                }
            });

        });

        function distributionData(data) {
            $('[name="id"]').val(data.id);
            $('[name="group_name"]').val(data.group_name);
        }

        function clearForm() {
            distributionData({});
        }


    </script>
@endsection


