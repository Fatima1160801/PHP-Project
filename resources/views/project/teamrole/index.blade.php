{{--<div class="card ">--}}
{{--    <div class="card-body ">--}}
{{--        <h4 class="card-title"><span>--}}
{{--                            {{$labels['teamrole'] ?? 'Team Role'}}--}}


{{--                        <a href="{{route('project.jobtitle.create')}}"--}}
{{--                           class="mytooltip btn-setting-nav"--}}
{{--                           data-toggle="tooltip" data-placement="top"--}}
{{--                           title=" ">--}}
{{--                            <i class="material-icons">add--}}
{{--                            </i><span class="mytooltiptext">{{$labels['add'] ?? 'add'}}</span>--}}
{{--                        </a></span></h4>--}}
            <table class="table dataTable no-footer table-bordered" id="table" style="margin-top: -5% !important;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>
                        {{$labels['role_name_na'] ?? 'Role Name'}}
                    </th>
                    <th>
                        {{$labels['role_name_fo'] ?? "Role Name in english"}}
                    </th>
                    <th>
                        {{$labels['status'] ?? 'Status'}}
                    </th>
                    <th>
                        {{$labels['actions'] ?? 'actions'}}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($teamroles  as $index=>$jobtitle)
                    <tr data-id="{{$jobtitle->id}}">
                        <td>{{$index+1}}</td>
                        <td>{{$jobtitle->role_name_na}}</td>
                        <td>{{$jobtitle->role_name_fo}}</td>
                        <td>
                            {!! activeLabel($jobtitle->is_hidden ) !!}
                        </td>

                        <td>
                            <a href="#" data-id="{{$jobtitle->id}}"
                               class="mytooltip btn-setting-nav editTeamRole" data-toggle="tooltip"
                               data-placement="top"
                               title="">
                                <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}} </span>
                            </a>

{{--                            <button class="btn btn-danger btn-round btn-fab btn-sm" data-toggle="modal"--}}
{{--                                    data-target="#delete{{$jobtitle->id}}"--}}
{{--                                    data-tooltip="tooltip" data-placement="top"--}}
{{--                                    title="{{$labels['delete'] ?? 'delete'}}"--}}

{{--                            >--}}
{{--                                <i class="material-icons">delete</i>--}}
{{--                            </button>--}}
                            <a href="{{ route("project.teamrole.destroy",$jobtitle->id) }}" class="mytooltip btn-setting-nav deleteTeamRole"
                               data-tooltip="tooltip" data-placement="top"
                               title=""

                            >
                                <i class="material-icons">delete</i><span class="mytooltiptext"> {{$labels['delete'] ?? 'delete'}}</span>
                            </a>
                            {!! Form::close() !!}

                        </td>
                    </tr>
                    <!-- Modal -->

                @endforeach
                </tbody>
            </table>
{{--    </div>--}}
{{--</div>--}}