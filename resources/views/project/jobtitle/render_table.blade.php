<table class="table dataTable no-footer table-bordered" id="table">
    <thead>
{{--    <tr>--}}
{{--        <th colspan="6">--}}
{{--            --}}{{--                        <h4 class="card-title"><span>--}}
{{--            --}}{{--                            {{$labels['job_title'] ?? 'job_title'}}--}}


{{--            --}}{{--                        <a href="{{route('project.jobtitle.create')}}"--}}
{{--            --}}{{--                           class="btn btn-sm btn-sm btn-primary btn-round btn-fab"--}}
{{--            --}}{{--                           data-toggle="tooltip" data-placement="top"--}}
{{--            --}}{{--                           title=" {{$labels['add'] ?? 'add'}}">--}}
{{--            --}}{{--                            <i class="material-icons">add--}}
{{--            --}}{{--                            </i>--}}
{{--            --}}{{--                        </a></span></h4>--}}
{{--        </th>--}}
{{--    </tr>--}}
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
        <tr data-id="{{$jobtitle->id}}">
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
                @if($id==1)
                <a href="{{route('project.jobtitle.edit',$jobtitle->id)}}"
                   class="mytooltip btn-setting-nav" data-toggle="tooltip"
                   data-placement="top"
                   title="{{$labels['edit'] ?? 'edit'}}">
                    <i class="material-icons">edit</i>
                </a>
                @else
                    <a href="#"  data-id="{{$jobtitle->id}}"
                       class="btn-sm editRole  mytooltip btn-setting-nav"  data-toggle="tooltip" data-placement="top"

                    >
                        <i class="material-icons">edit</i><span class="mytooltiptext"> {{$labels['edit'] ?? 'edit'}}</span>
                    </a>
                    @endif
                <a href="" class="mytooltip btn-setting-nav" data-toggle="modal"
                        data-target="#delete{{$jobtitle->id}}"
                        data-tooltip="tooltip" data-placement="top"
                        title=""

                >
                    <i class="material-icons">delete</i><span class="mytooltiptext"> {{$labels['delete'] ?? 'delete'}}</span>
                </a>
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
                    @if($id==1)
                    {!! Form::open(['method' => 'DELETE','route' => ['project.jobtitle.destroy', $jobtitle->id,1],'style'=>'display:inline']) !!}
                    @else
                        {!! Form::open(['action' => 'DELETE','route' => ['project.jobtitle.destroy', $jobtitle->id,2],'style'=>'display:inline','id'=>'formDelete']) !!}

                    @endif
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
                        <button type="submit" class="btn btn-warning yes" data-id="{{$jobtitle->id}}">Yes, Delete</button>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div> <!-- End Modal -->

    @endforeach
    </tbody>
</table>