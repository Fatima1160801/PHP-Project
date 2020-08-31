<div class="card-header card-header-rose card-header-text">
</div>
<div class="card-body">

    <div class="collapse-group">
        <button class="btn btn-primary open-button" type="button">
            Open all
        </button>
        <button class="btn btn-primary close-button" type="button">
            Close all
        </button>

        @foreach($modules as $module)

            <div class="card">
                <header class="card-header bg-primary ">
                    <a href="#" data-toggle="collapse" data-target="#collapseModule{{$module->id}}"
                       aria-expanded="true" class="">
                        <i class="icon-action fa fa-chevron-down text-white"></i>
                        <span class="title "> {{$module->module_name_na}} </span>
                    </a>
                </header>
                <div class="collapse show" id="collapseModule{{$module->id}}" style="">
                    <article class="card-body">

                        <!------------------------------------------------------ screen.// -->
                        @foreach($module->screens()->orderBy('order_', 'asc')->get() as $screen )
                            @if($screen->has_premission == 1)
                                <div class="card">
                                    <header class="card-header bg-info">

                                            <span class=" togglebutton switch-sidebar-mini text-left">
                                                <label>
                                                    <input screenNo="screen{{$screen->id}}" class="screenChecked" type="checkbox">
                                                    <span class="toggle"></span>
                                                </label>
                                            </span>

                                        <a href="#" data-toggle="collapse" data-target="#collapseScreen{{$screen->id}}" aria-expanded="true" class="">
                                            <i class="icon-action fa fa-chevron-down text-white"></i>
                                            <span class="title ">{{$screen->screen_name_na}}</span>
                                        </a>

                                    </header>
                                    <div class="collapse show" id="collapseScreen{{$screen->id}}" style="">
                                        <article class="card-body">
                                            <!------------------------------------------------------ command.// -->
                                            <div class="row">
                                                @if($type =='user')
                                                    @foreach($screen->screen_commands()->get() as $command)
                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                            <div class="togglebutton switch-sidebar-mini">
                                                                <label class="text-dark">
                                                                    <input class="permissionCheckBoxUser screen{{$screen->id}}"
                                                                           command-id="{{$command->id}}"
                                                                           screen-id="{{$screen->id}}"
                                                                           command-type-id="{{$command->screen_command_type_id}}"
                                                                           user_id="{{$user->id}}"
                                                                           type="checkbox"
                                                                            {{checkPermUserGroup($screen->id,$command->id,$command->screen_command_type_id,$user->id)}}
                                                                            {{checkPermUser($screen->id,$command->id,$command->screen_command_type_id,$user->id)}}>
                                                                    <span class="toggle"></span>
                                                                    {{$command->command_name}}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                @if($type =='group')
                                                    @foreach($screen->screen_commands()->get() as $command)
                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                            <div class="togglebutton switch-sidebar-mini">
                                                                <label class="text-dark">
                                                                    <input class="permissionCheckboxGroup screen{{$screen->id}}"
                                                                           command-id="{{$command->id}}"
                                                                           screen-id="{{$command->screen_id}}"
                                                                           command-type-id="{{$command->screen_command_type_id}}"
                                                                           group_id="{{$group->id}}"
                                                                           type="checkbox"
                                                                            {{checkPermInGroup($group->id  ,$screen->id,$command->id,$command->screen_command_type_id)}}>
                                                                    <span class="toggle"></span>
                                                                    {{$command->command_name}}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <!------------------------------------------------------ command.// -->


                                        </article> <!-- card-body.// -->
                                    </div> <!-- collapse .// -->
                                </div> <!-- card.// -->
                        @endif
                    @endforeach
                    <!------------------------------------------------------ endScreen.// -->

                    </article> <!-- card-body.// -->
                </div> <!-- collapse .// -->
            </div> <!-- card.// -->

        @endforeach
    </div>


</div>