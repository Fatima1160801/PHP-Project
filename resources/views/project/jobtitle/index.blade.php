@extends('layouts._layout')

@section('content')


    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">work</i>
            </div>
            <h4 class="card-title">
                {{$labels['job_title'] ?? 'job_title'}}

            </h4>
        </div>
        <div class="card-body ">


            <table class="table" id="table">
                <thead>
                <tr>
                    <th colspan="6">
                        <a href="{{route('project.jobtitle.create')}}"
                           class="btn btn-sm btn-sm btn-primary btn-round btn-fab"
                           data-toggle="tooltip" data-placement="top"
                           title=" {{$labels['add'] ?? 'add'}}">
                            <i class="material-icons">add
                            </i>
                        </a>
                    </th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>
                        {{$labels['job_title_enghlish'] ?? 'job_title_enghlish'}}
                    </th>
                    <th>
                        {{$labels['job_title_rabic'] ?? 'job_title_rabic'}}
                    </th>
                    <th>
                        {{$labels['job_title_status'] ?? 'job_title_status'}}
                    </th>
                    <th>
                        {{$labels['used_status'] ?? 'used_status'}}
                    </th>
                    <th>
                        {{$labels['actions'] ?? 'actions'}}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($jobtitles  as $index=>$jobtitle)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$jobtitle->job_title_name_na}}</td>
                        <td>{{$jobtitle->job_title_name_fo}}</td>
                        <td>
                            {!! activeLabel($jobtitle->is_hidden ) !!}
                        </td>
                        <td>
                            {!! is_inside_outside($jobtitle->is_inside_outside) !!}


                        </td>
                        <td>
                            <a href="{{route('project.jobtitle.edit',$jobtitle->id)}}"
                               class="btn btn-success btn-round btn-fab btn-sm" data-toggle="tooltip"
                               data-placement="top"
                               title="{{$labels['edit'] ?? 'edit'}}">
                                <i class="material-icons">edit</i>
                            </a>

                            <button class="btn btn-danger btn-round btn-fab btn-sm" data-toggle="modal"
                                    data-target="#delete{{$jobtitle->id}}"
                                    data-tooltip="tooltip" data-placement="top"
                                    title="{{$labels['delete'] ?? 'delete'}}"

                            >
                                <i class="material-icons">delete</i>
                            </button>
                            {!! Form::close() !!}

                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal" id="delete{{$jobtitle->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title text-center" id="myModalLabel">Delete Job Title
                                        Confirmation</h4>
                                </div>
                                {!! Form::open(['method' => 'DELETE','route' => ['project.jobtitle.destroy', $jobtitle->id],'style'=>'display:inline']) !!}
                                {{method_field('delete')}}
                                {{csrf_field()}}
                                <div class="modal-body">
                                    <p class="text-center">
                                        Are you sure you want to delete this?
                                    </p>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel
                                    </button>
                                    <button type="submit" class="btn btn-warning">Yes, Delete</button>
                                </div>
                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div> <!-- End Modal -->

                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            active_nev_link('job_title');
            DataTableCall('#table',6);
        })
    </script>
@endsection

@section('js')
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection

