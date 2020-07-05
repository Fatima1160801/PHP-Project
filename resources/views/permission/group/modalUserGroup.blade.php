
<div class="modal-content group-permission-class">
    <div class="card card-signup card-plain">
        <div class="modal-header">
            <div class="card-header  text-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>

                <h4 class="card-title">Group Permission</h4>
            </div>
        </div>
        <div class="modal-body">
            @foreach($groups as $group)


                    <div class="togglebutton switch-sidebar-mini">
                        <label class="text-dark">
                            <input user_id="{{$user->id}}" group-id="{{$group->id}}" type="checkbox"
                                   {{ \App\Models\Permission\GroupUser::checkUserGroup($user->id,$group->id) }} class="groupId default">

                            <span class="toggle te"></span>
                            {{$group->group_name}}

                    </label>
                    </div>

            @endforeach
        </div>
    </div>
</div>


