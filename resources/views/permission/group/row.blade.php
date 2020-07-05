<tr data-id="{{$group->id}}">

    <td>{{$loop->iteration or '{index}'}}</td>
    <td>{{$group->group_name}}</td>
    <td>{{ $group->user->user_full_name }}</td>
    <td class="td-actions " >
        <a  href="{{route('permission.group.edit',$group->id)}}" class=" btnEdit btn btn-primary btn-round"
            rel="tooltip"  data-original-title="top" title="ُEdit Group">
            <i class="material-icons">edit</i>
        </a>

        <a href="{{route('permission.permission.index',['group',$group->id])}}" rel="tooltip"
           class="btn btn-info btn-round" data-original-title="top" title="ُGrant Permission">
            <i class="material-icons">vpn_key</i>
        </a>

    </td>
</tr>