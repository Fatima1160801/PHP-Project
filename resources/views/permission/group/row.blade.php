<tr data-id="{{$group->id}}">

    <td>{{$loop->iteration or '{index}'}}</td>
    <td>{{$group->group_name}}</td>
    <td>{{ $group->user->user_full_name }}</td>
    <td class="td-actions " >
        <a  href="{{route('permission.group.edit',$group->id)}}" class=" btnEdit mytooltip btn-setting-nav"
            rel="tooltip"  data-original-title="top" title="">
            <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
        </a>
{{--@if($id==1)--}}
{{--        <a href="{{route('permission.permission.index',['group',$group->id])}}" rel="tooltip"--}}
{{--           class="mytooltip btn-setting-nav" data-original-title="top" title="">--}}
{{--            <i class="material-icons">vpn_key</i><span class="mytooltiptext">ُGrant Permission</span>--}}
{{--        </a>--}}
{{--        @else--}}
            <a href="#" data-id="{{$group->id}}" rel="tooltip"
               class="mytooltip btn-setting-nav grantPermission" data-original-title="top" title="">
                <i class="material-icons">vpn_key</i><span class="mytooltiptext">ُGrant Permission</span>
            </a>
{{--        @endif--}}
    </td>
</tr>