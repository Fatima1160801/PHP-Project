
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
           class="add mytooltip btn-setting-nav"
           data-toggle="modal" data-target="#modalUserGroup"
           rel="tooltip" data-original-title="">
            <i class="material-icons">settings</i><span class="mytooltiptext"> Grant Group</span>
        </a>
    </td>
    <td class="td-actions text-center">

        <a href="#" user-id="{{$user->id}}"
           class="mytooltip btn-setting-nav user-status-id" id="user-status-id"


        @if($user->user_status_id == 1)
           rel="tooltip" data-original-title="" status="1"

        @elseif($user->user_status_id == 3)
           rel="tooltip" data-original-title="" status="3"
        @endif
        >
            @if($user->user_status_id == 1)
                <i class="material-icons">lock_open</i>
            @elseif($user->user_status_id == 3)
                <i class="material-icons">lock</i><span class="mytooltiptext">@if($user->user_status_id == 1)lock @elseif($user->user_status_id == 3)un lock @endif</span>
            @endif
        </a>



        <a href="{{route('permission.user.edit',$user->id)}}" rel="tooltip"
           class="mytooltip btn-setting-nav" data-original-title="" >
            <i class="material-icons">edit</i><span class="mytooltiptext">Edit User</span>
        </a>

        <a href="{{route('permission.permission.index',['user',$user->id])}}" rel="tooltip"
           class="mytooltip btn-setting-nav  btn-round" data-original-title="">
            <i class="material-icons">vpn_key</i><span class="mytooltiptext">Grant Permission</span>
        </a>


        @if($user->staff != null)
            <a href="{{route('project.staff.edit',$user->staff->id)}}"
               rel="tooltip" class="mytooltip btn-setting-nav"
               data-original-title="">
                <i class="material-icons">person_outline</i><span class="mytooltiptext">Staff</span>
            </a>
        @endif
    </td>
</tr>