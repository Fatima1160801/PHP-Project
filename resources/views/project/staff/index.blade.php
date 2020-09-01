@extends('layouts._layout')

@section('content')


    <div class="card ">
{{--        <div class="card-header card-header-rose card-header-text">--}}
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">storage</i>--}}
{{--            </div>--}}
{{--            <h4 class="card-title">--}}
{{--                {{$labels['staff'] ?? 'staff'}}--}}
{{--            </h4>--}}
{{--        </div>--}}
        <div class="card-body">
            <h4 class="card-title"><span>
                {{$labels['staff'] ?? 'staff'}}

            <a href="{{route('project.staff.create',1)}}" class="btn btn-sm btn-primary btn-round btn-fab"
               data-toggle="tooltip" data-placement="top"
               title="{{$labels['add'] ?? 'add'}}">
                <i class="material-icons">add
                </i>
            </a>
            </span></h4>
            @include('project.staff.table_render')
{{--            <table id="table" class="table dataTable no-footer table-bordered">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>#</th>--}}

{{--                    <th>--}}
{{--                        {{$labels['staff_name_arabic'] ?? 'staff_name_arabic'}}--}}
{{--                    </th>--}}

{{--                <th>--}}
{{--                        {{$labels['job_title_id'] ?? 'job_title_id'}}--}}
{{--                    </th>--}}

{{--                    <th>--}}
{{--                        {{$labels['supervisor_id'] ?? 'supervisor_id'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['user_name'] ?? 'user_name'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['action'] ?? 'action'}}--}}
{{--                    </th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($staffs as $index=>$staff)--}}

{{--                    <tr>--}}
{{--                        <td>{{$index+1}}</td>--}}
{{--                        <td>{{$staff->staff_name_fo}}</td>--}}
{{--                        <td>{{$staff->jobTitle ? $staff->jobTitle->{'job_title_name_'.lang_character()} : ''}}</td>--}}
{{--                        <td>{{$staff->supervisor ? $staff->supervisor->{'staff_name_'.lang_character()} : ''}}</td>--}}
{{--                        <td>{{ $staff->user ? $staff->user->user_name : '' }}</td>--}}

{{--                        <td>--}}
{{--                            @if($staff->user != null)--}}
{{--                                <a href="{{route('permission.user.edit',$staff->user->id)}}"--}}
{{--                                   class="btn btn-rose btn-round btn-fab btn-sm" data-toggle="tooltip"--}}
{{--                                   data-placement="left"--}}
{{--                                   title="{{$labels['user_staff'] ?? 'user_staff'}}">--}}
{{--                                    <i class="material-icons">person</i>--}}
{{--                                </a>--}}
{{--                            @endif--}}

{{--                            <a href="{{route('project.staff.show',$staff->id)}}"--}}
{{--                               class="btn btn-info btn-round btn-fab btn-sm" data-toggle="tooltip"--}}
{{--                               data-placement="left"--}}
{{--                               title="{{$labels['view'] ?? 'view'}}">--}}
{{--                                <i class="material-icons">pageview</i>--}}
{{--                            </a>--}}

{{--                            <a href="{{route('project.staff.edit',$staff->id)}} "--}}
{{--                               class="btn btn-success btn-round btn-fab btn-sm" data-toggle="tooltip"--}}
{{--                               data-placement="left"--}}
{{--                               title="{{$labels['edit'] ?? 'edit'}}">--}}
{{--                                <i class="material-icons">edit</i>--}}
{{--                            </a>--}}

{{--                            <button class="btn btn-danger btn-round btn-fab btn-sm" data-toggle="modal"--}}
{{--                                    data-target="#delete{{$staff->id}}"--}}
{{--                                    data-tooltip="tooltip" data-placement="top"--}}
{{--                                    title="{{$labels['delete'] ?? 'delete'}}">--}}
{{--                                <i class="material-icons">delete</i>--}}
{{--                            </button>--}}

{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <!--Modal -->--}}
{{--                    <div class="modal" id="delete{{$staff->id}}" tabindex="-1" role="dialog"--}}
{{--                         aria-labelledby="myModalLabel">--}}
{{--                        <div class="modal-dialog" role="document">--}}
{{--                            <div class="modal-content">--}}
{{--                                <div class="modal-header">--}}
{{--                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span--}}
{{--                                                aria-hidden="true">&times;</span></button>--}}
{{--                                    <h4 class="modal-title text-center" id="myModalLabel">Delete Project Staff--}}
{{--                                        Confirmation</h4>--}}
{{--                                </div>--}}
{{--                                {!! Form::open(['method' => 'DELETE','route' => ['project.staff.destroy', $staff->id],'style'=>'display:inline']) !!}--}}
{{--                                {{method_field('delete')}}--}}
{{--                                {{csrf_field()}}--}}
{{--                                <div class="modal-body">--}}
{{--                                    <p class="text-center">--}}
{{--                                        Are you sure you want to delete this?--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                                <div class="modal-footer">--}}
{{--                                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel--}}
{{--                                    </button>--}}
{{--                                    <button type="submit" class="btn btn-warning">Yes, Delete</button>--}}
{{--                                </div>--}}
{{--                                {!! Form::close() !!}--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div> <!-- End Modal -->--}}

{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
            <button type="button"  class="btn  btn-sm btn-default" onclick='location.href="{{ route('settings.users.screen')}}"'>Back</button>

        </div>


        @endsection
        @section('script')
            <script>
                $(document).ready(function () {
                    active_nev_link('staff-link');
                    DataTableCall('#table',6);
                })

            </script>
    @endsection



    @section('js')

        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
            <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection
