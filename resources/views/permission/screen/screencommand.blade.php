
<table class="table-hover table table-bordered">
    <thead>
    <tr>
        <th >Screen Name
        </th>
        <th colspan="4">
{{$screen->screen_name_na}}
        </th>
    </tr>
    <tr>
        <th>Command Name</th>
        <th>Command Type</th>
        <th>Controller</th>
        <th>Action</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    @foreach($commands as $command)
        <tr>
            <td>
                {{$command->command_name}}
            </td>
            <td>
               {{$command->type->command_na}}
            </td>
            <td>
                {{$command->controller}}
            </td>
            <td>
                {{$command->action}}
            </td>
            <td>
                    <label class="switch ">
                        <input command-id="{{$command->command_id}}"
                               screen-id="{{$command->screen_id}}"
                               command-type-id="{{$command->command_type_id}}"
                               type="checkbox"
                               @if(\App\Models\Permission\UserPermission::checkUserPermission($screen->screen_id,$command->command_id,$command->command_type_id,$user->id) == true)
                               checked
                               @endif

                               class="commandId default">
                        <span class="slider round"></span>
                    </label>
            </td>

        </tr>
    @endforeach
    </tbody>

</table>
