
@foreach($groups as $group)
    <li class="list-group-item">
        {{$group->group_name}}
        <label class="switch ">
            <input group-id="{{$group->id}}" type="checkbox"
                   {{ \App\Models\Permission\GroupUser::checkUserGroup($user->id,$group->id) }} class="groupId default">
            <span class="slider round"></span>
        </label>
    </li>
@endforeach