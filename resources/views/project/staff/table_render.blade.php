<table id="table" class="table dataTable no-footer table-bordered">
    <thead>
    <tr>
        <th>#</th>

        <th>
            {{$labels['staff_name_arabic'] ?? 'staff_name_arabic'}}
        </th>

        <th>
            {{$labels['job_title_id'] ?? 'job_title_id'}}
        </th>

        <th>
            {{$labels['supervisor_id'] ?? 'supervisor_id'}}
        </th>
        <th>
            {{$labels['user_name'] ?? 'user_name'}}
        </th>
        <th>
            {{$labels['action'] ?? 'action'}}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($staffs as $index=>$staff)

        <tr data-id="{{$staff->id}}">
            <td>{{$index+1}}</td>
            <td>{{$staff->staff_name_fo}}</td>
            <td>{{$staff->jobTitle ? $staff->jobTitle->{'job_title_name_'.lang_character()} : ''}}</td>
            <td>{{$staff->supervisor ? $staff->supervisor->{'staff_name_'.lang_character()} : ''}}</td>
            <td>{{ $staff->user ? $staff->user->user_name : '' }}</td>

            <td>
                @if($id==1)
                @if($staff->user != null)
                    <a href="{{route('permission.user.edit',$staff->user->id)}}"
                       class="mytooltip btn-setting-nav" data-toggle="tooltip"
                       data-placement="left"
                       title="">
                        <i class="material-icons">person</i><span class="mytooltiptext">{{$labels['user_staff'] ?? 'user_staff'}}</span>
                    </a>
                @endif

                <a href="{{route('project.staff.show',$staff->id)}}"
                   class="mytooltip btn-setting-nav" data-toggle="tooltip"
                   data-placement="left"
                   title="">
                    <i class="material-icons">pageview</i><span class="mytooltiptext">{{$labels['view'] ?? 'view'}} </span>
                </a>

                <a href="{{route('project.staff.edit',$staff->id)}} "
                   class="mytooltip btn-setting-nav" data-toggle="tooltip"
                   data-placement="left"
                   title="">
                    <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                </a>
                @else
                    @if($staff->user != null)
                        <a href="#"
                           class="mytooltip btn-setting-nav" data-id="{{$staff->user->id}}"data-toggle="tooltip"
                           data-placement="left"
                           title="">
                            <i class="material-icons">person</i><span class="mytooltiptext">{{$labels['user_staff'] ?? 'user_staff'}}</span>
                        </a>
                    @endif

                    <a href="#"
                       class="mytooltip btn-setting-nav" data-id="{{$staff->id}}"data-toggle="tooltip"
                       data-placement="left"
                       title="">
                        <i class="material-icons">pageview</i><span class="mytooltiptext">{{$labels['view'] ?? 'view'}} </span>
                    </a>

                    <a href="#"
                       class="mytooltip btn-setting-nav" data-d="{{$staff->id}}" data-toggle="tooltip"
                       data-placement="left"
                       title="">
                        <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                    </a>
                @endif
                <a href="#" class="mytooltip btn-setting-nav" data-toggle="modal"
                        data-target="#delete{{$staff->id}}"
                        data-tooltip="tooltip" data-placement="top"
                        title="">
                    <i class="material-icons">delete</i><span class="mytooltiptext"> {{$labels['delete'] ?? 'delete'}}</span>
                </a>

            </td>
        </tr>
        <!--Modal -->
        <div class="modal" id="delete{{$staff->id}}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Delete Project Staff
                            Confirmation</h4>
                    </div>
                    @if($id==1)
                    {!! Form::open(['method' => 'DELETE','route' => ['project.staff.destroy', $staff->id,1],'style'=>'display:inline']) !!}
                    @else
                        {!! Form::open(['action' => 'DELETE','route' => ['project.staff.destroy', $staff->id,2],'style'=>'display:inline','id'=>'formDelete']) !!}

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
                        <button type="submit" class="btn btn-warning yes"data-id="{{$staff->id}}">Yes, Delete</button>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div> <!-- End Modal -->

    @endforeach
    </tbody>
</table>