@extends('layouts._layout')


@section('css')
    <style>


    </style>
@endSection
@section('content')


    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">Goals</h4>
        </div>
        <div class="card-body ">


            <a href="{{route('goals.main.create')}}" rel="tooltip"
               class="btn btn-sm btn-primary btn-round btn-fab"
               rel="tooltip" data-original-title="" title="Add Main Activity"
               data-placement="top" id="AddMainActivity">
                <i class="material-icons">add</i>
            </a>

            <table class="table" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Main Goals Name</th>
                    {{--<th>Project Name</th>--}}
                    {{--<th>Activity Type</th>--}}
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @if($goals != null)

                    @foreach($goals  as $index=>$goal)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{ $goal->goal_name_na }}</td>
                            {{--<td>{{ $goal->project()->first()->project_name_na }}</td>--}}
                            {{--<td> @if($activity->typeActivity()->first() ){{ $activity->typeActivity()->first()->act_type_name_no }} @endif</td>--}}
                            <td>
                                {{--<a href="{{route('activity.mainActivity.edit',$activity->id)}}" rel="tooltip"--}}
                                   {{--class="btn btn-sm   btn-round btn-success btn-fab"--}}
                                   {{--rel="tooltip" data-original-title="" title="Edit Activity"--}}
                                   {{--data-placement="top" id="EditActivity">--}}
                                    {{--<i class="material-icons">edit</i>--}}
                                {{--</a>--}}

                                {{--<a href="{{route('activity.subActivity.create',$activity->id)}}" rel="tooltip"--}}
                                   {{--class="btn btn-sm   btn-round btn-rose btn-fab"--}}
                                   {{--rel="tooltip" data-original-title="" title="add sub activity"--}}
                                   {{--data-placement="top" id="EditActivity">--}}
                                    {{--<i class="material-icons">add</i>--}}
                                {{--</a>--}}

                                {{--<a href="{{route('activity.subActivity.index',$activity->id)}}" rel="tooltip"--}}
                                   {{--class="showSubActivity btn btn-sm   btn-round btn-info btn-fab"--}}
                                   {{--rel="tooltip" data-original-title="" title="show sub activity"--}}
                                   {{--data-placement="top" id="{{$activity->id}}">--}}
                                    {{--<i class="material-icons">list_alt</i>--}}
                                {{--</a>--}}

                            </td>

                        </tr>

                    @endforeach

                @endif

                </tbody>

            </table>
        </div>
    </div>

@stop

@section('script')
    <script>
        $(function () {

            DataTableCall('#table');

            $('[data-toggle="tooltip"]').tooltip();

        })


        // $(document).on('click', '.showSubActivity', function (e) {
        //     e.preventDefault();
        //
        //     $row = $(this).closest('tr');
        //
        //     $id = 'row' + $(this).attr('id');
        //
        //     if ($("#" + $id).length >= 1) {
        //         $("#" + $id).slideUp('slow').remove();
        //
        //     } else {
        //
        //         var url = $(this).attr('href');
        //         $.ajax({
        //             url: url,
        //             dataTypes: 'html',
        //             type: 'get',
        //             beforeSend: function () {
        //             },
        //             success: function (data) {
        //                 console.log(data);
        //
        //                 $rowdata = $row.after(rowData(data, $id));
        //                 $('[rel="tooltip"]').tooltip();
        //             },
        //             error: function () {
        //             }
        //         });
        //
        //     }
        //
        // })
        //
        // function rowData(data, $id) {
        //     $x = "<tr id='" + $id + "' style='background-color: #fdfdfd'><td style=' background-color: #fff;'></td><td colspan='4'>"
        //         + data +
        //         "</td></tr>";
        //     return $x;
        // }
    </script>

@stop




@section('js')
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    {{--<script src="{{ asset('assets/js/plugins/jquery.datatables.min.js')}}"></script>--}}
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>

@endsection
