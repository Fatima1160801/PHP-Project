
<tr data-id="{{$user->id}}">
    <td>{{$loop->iteration or '{index}'}}</td>
    <td class="width45 sorting_1">
        <img src="{{ !empty($user->user_photo) ? asset('images/user/photo/').'/'.$user->user_photo : asset('assets/img/placeholder.jpg')}}" class="rounded-circle avatar" style="width:40px;height:40px"alt="">
    </td>
    <td>
        <h6 class="mb-0">{{$user->user_full_name}}</h6>
        <span>{{$user->email}}</span>
    </td>
    <td>{{$user->user_name}}</td>
    <td>{{$user->job_title}}</td>
    <td>
        @foreach($user->group_user()->get() as $group)
            <span class="badge badge-secondary">
                                    {{$group->group()->first()->group_name}}
                              </span>
        @endforeach
        <a href="#" user_id="{{$user->id}}" id="addGroupToUser"
           class="btn btn-primary btn-fab btn-sm btn-fab-mini btn-round"
           data-toggle="modal" data-target="#modalUserGroup"
           rel="tooltip" data-original-title="" title="Grant Group">
            <i class="material-icons">settings</i>
        </a>
    </td>
    <td class="td-actions text-center">

        <a href="#" user-id="{{$user->id}}"
           class="btn btn-danger btn-sm  btn-round user-status-id" id="user-status-id"


        @if($user->user_status_id == 1)
           rel="tooltip" data-original-title="" title="lock" status="1"

        @elseif($user->user_status_id == 3)
           rel="tooltip" data-original-title="" title="un lock" status="3"
        @endif
        >
            @if($user->user_status_id == 1)
                <i class="material-icons">lock_open</i>
            @elseif($user->user_status_id == 3)
                <i class="material-icons">lock</i>
            @endif
        </a>



        <a href="{{route('permission.user.edit',$user->id)}}" rel="tooltip"
           class="btn btn-success btn-sm  btn-round" data-original-title="" title="Edit User">
            <i class="material-icons">edit</i>
        </a>

        <a href="{{route('permission.permission.index',['user',$user->id])}}" rel="tooltip"
           class="btn btn-info btn-sm  btn-round" data-original-title="" title="Grant Permission">
            <i class="material-icons">vpn_key</i>
        </a>


        @if($user->staff != null)
            <a href="{{route('project.staff.edit',$user->staff->id)}}"
               rel="tooltip" class="btn btn-rose btn-round"
               data-original-title="" title="Staff">
                <i class="material-icons">person_outline</i>
            </a>
        @endif
    </td>
</tr>