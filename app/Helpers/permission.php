<?php
if (!function_exists('checkPermission')) {
    function checkPermission($screen_id, $controller_name, $action_name, $command_id, $command_type_id)
    {

        $havePermission = false;
        $user = Auth::user();
        $groups_user = $user->group_user()->get();

        foreach ($groups_user as $group_user) {
            $permissionInGroup = \App\Models\Permission\GroupPermission::checkPermissionInGroup($group_user->group_id, $screen_id, $command_id, $command_type_id);
            if ($permissionInGroup === true) {
                $screenCommand = \App\Models\Permission\ScreenCommand::checkScreenCommand($screen_id, $command_id, $command_type_id, $action_name, $controller_name);
                if ($screenCommand === true) {
                    $havePermission = true;
                }
            }
        }
        $user_permission = \App\Models\Permission\UserPermission::checkUserPermission($screen_id, $command_id, $command_type_id);
        if ($user_permission === true) {
            $screenCommand = \App\Models\Permission\ScreenCommand::checkScreenCommand($screen_id, $command_id, $command_type_id, $action_name, $controller_name);
            if ($screenCommand === true) {
                $havePermission = true;
            }
        }

        return $havePermission;
    }
}

if (!function_exists('is_permitted')) {
    function is_permitted($screen_id, $controller_name, $action_name, $command_id, $command_type_id)
    {
        if (Auth::id() != 1) {
            if (!checkPermission($screen_id, $controller_name, $action_name, $command_id, $command_type_id)) {
//                abort(403, 'Unauthorized action.');
                if (request()->ajax()) {
                    abort(403, 'You don’t have permissions to view this page Please contact your administration!');
                } else {
                    abort(401, 'You don’t have permissions to view this page Please contact your administration!');
                    // return back()->with('result_message', 'You don’t have permissions to view this page Please contact your administration!')->send();
                }
            }
        }
    }
}


function getUserPermission()
{
    $user_permission = \App\Models\Permission\UserPermission::where('user_id', Auth::id())->pluck('command_id')->toArray();
    $group_perm = [];

    $user = Auth::user();
    $groups_user = $user->group_user()->get();
    if ($groups_user->count() > 0) {


        foreach ($groups_user as $group_user) {
            $permissionInGroup = \App\Models\Permission\GroupPermission::where('group_id', $group_user->group_id)
                ->pluck('command_id')
                ->toArray();
            $r = array_merge($group_perm, $permissionInGroup);
        }
        return array_unique(array_merge($user_permission, $r));
    } else {
        return array_unique($user_permission);
    }
}


function element_permitted($screen_id, $controller_name, $action_name, $command_id, $command_type_id)
{
    return checkPermission($screen_id, $controller_name, $action_name, $command_id, $command_type_id);
}


if (!function_exists('abortMy')) {
    /**
     * Throw an HttpException with the given data.
     *
     * @param  int $code
     * @param  string $message
     * @param  array $headers
     * @return void
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
}


if (!function_exists('checkPermUserGroup')) {
    function checkPermUserGroup($screen_id, $command_id, $command_type_id, $user_id)
    {
        $havePermission = '';
        $user = \App\Models\Permission\User::find($user_id);
        $groups_user = $user->group_user()->get();

        foreach ($groups_user as $group_user) {
            $permissionInGroup = \App\Models\Permission\GroupPermission::checkPermissionInGroup($group_user->group_id, $screen_id, $command_id, $command_type_id);
            if ($permissionInGroup === true) {
                $screenCommand = \App\Models\Permission\ScreenCommand::checkScreenCommand($screen_id, $command_id, $command_type_id);
                if ($screenCommand === true) {
                    $havePermission = 'checked disabled';
                }
            }
        }
        return $havePermission;
    }


    if (!function_exists('checkPermUser')) {
        function checkPermUser($screen_id, $command_id, $command_type_id, $user_id)
        {
            $havePermission = ' ';
            $user_permission = \App\Models\Permission\UserPermission::checkUserPermission($screen_id, $command_id, $command_type_id, $user_id);
            if ($user_permission === true) {

                $screenCommand = \App\Models\Permission\ScreenCommand::checkScreenCommand($screen_id, $command_id, $command_type_id);

                if ($screenCommand === true) {
                    $havePermission = 'checked';
                }
            }
            return $havePermission;
        }
    }

    if (!function_exists('checkPermInGroup')) {
        function checkPermInGroup($group_id, $screen_id, $command_id, $command_type_id)
        {
            $havePermission = '';
            $group_permission = \App\Models\Permission\GroupPermission::where('group_id', $group_id)
                ->where('screen_id', $screen_id)
                ->where('command_id', $command_id)
                ->where('command_type_id', $command_type_id)
                ->first();
            if ($group_permission) {
                $havePermission = 'checked';
            }
            return $havePermission;

        }
    }

}