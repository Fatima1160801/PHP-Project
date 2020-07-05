<?php $__env->startSection('content'); ?>

    <div class="card card-wizard" data-color="rose" id="wizardNotification">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">lock</i>
            </div>
            <h4 class="card-title">System Notifications Settings</h4>
        </div>
        <br><br>
        <div class="wizard-navigation">
            <ul class="nav nav-pills">
                <li class="nav-item" id="task_link" data-task-id="">
                    <a class="nav-link active" href="#select_users" data-toggle="tab" role="tab">
                        Select Users
                    </a>
                </li>
                <li class="nav-item" id="task_link" data-task-id="">
                    <a class="nav-link" href="#configure_notifications" data-toggle="tab" role="tab">
                        Notifications Settings
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="select_users">
                    <div class="row">
                        <div id="columns_data"></div>
                        <div class="col-md-5">
                            <div class="card" style="min-height: 400px;">
                                <div class="card-header card-header-text  btn-sm">
                                    <!--<div class="card-text">
                                        <h5 class="card-title">All Report Columns</h5>
                                    </div>-->
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th style="background-color:#ea2c6d;color:#fff">
                                                All Users
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody id="unselected_users">
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <tr class="unselected_user" style="cursor: pointer;" data-user-id="<?php echo e($user->id); ?>" data-user-name="<?php echo e($user->user_full_name); ?>">
                                                        <td><b><?php echo e($user->user_full_name); ?></b> <?= (in_array($user->id,$saved_settings_users)) ? '<span class="badge badge-success" style="float:right">Configured</span>' : '' ?></td>
                                                    </tr>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1" style="padding-top:160px">
                            <button type="button" id="btnMoveOneRight" class="btn btn-sm btn-rose "><i
                                        class="fa fa-angle-right"></i></button>
                            <button type="button" id="btnMoveAllRight" class="btn btn-sm btn-rose "
                                    style="width: 46px;"><i class="fa fa-angle-double-right"></i></button>
                            <button type="button" id="btnMoveAllLeft" class="btn btn-sm btn-rose "
                                    style="width: 46px;"><i class="fa fa-angle-double-left"></i></button>
                            <button type="button" id="btnMoveOneLeft" class="btn btn-sm btn-rose "><i
                                        class="fa fa-angle-left"></i></button>
                        </div>
                        <div class="col-md-5">
                            <div class="card" style="min-height: 400px;">
                                <div class="card-header card-header-text ">
                                </div>
                                <div class="card-body">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th style="background-color:#9c27b0;color:#fff">
                                                        Selected Users
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody id="selected_users">

                                                </tbody>
                                            </table>
                                    <input type="hidden" id="selected_users_input" value=''>
                                    <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $staffs_options = '';
                    foreach($staffs as $staff){
                        $staffs_options .= '<option value="'.$staff->id.'">'.((Auth::user()->lang_id == 1) ? $staff->staff_name_na : $staff->staff_name_fo).'</option>';
                    }
                ?>
                <div class="tab-pane" id="configure_notifications">
                    <div class="collapse-group">
                    <div class="collapse" id="collapseExample" style="display: block">
                        <button class="btn btn-primary open-button" type="button">
                            Open all
                        </button>
                        <button class="btn btn-primary close-button" type="button">
                            Close all
                        </button>
                        <div style="border-collapse:separate;border-spacing:6px;">
                            <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <br>
                                <div style="background-color: #339aff;cursor: pointer;color:#fff" data-toggle="collapse" href="#collapseModule<?php echo e($module->id); ?>" role="button" aria-expanded="false" aria-controls="collapseExample2">
                                    <div style="padding:10px">
                                <span><b style="font-weight:600"></b>
                                   <i class="icon-action fa fa-chevron-down text-white"></i> <?php echo e($module->module_name_na); ?></span>
                                    </div>
                                </div>
                                <br>
                                <div class="collapse" id="collapseModule<?php echo e($module->id); ?>" style="margin-<?php echo e(Auth::user()->lang_id == 1 ? 'left' : 'right'); ?>: 40px;">
                                    <?php $__currentLoopData = $module->screens()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $screen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($screen->has_notifications == 1): ?>
                                        <div style="background-color: #1ac1b8;cursor: pointer;color:#fff" data-toggle="collapse" href="#collapseScreen<?php echo e($screen->id); ?>" role="button" aria-expanded="false" aria-controls="collapseExample2">
                                            <div style="padding:10px">
                                      <span><b style="font-weight:600"></b>
                                    <i class="icon-action fa fa-chevron-down  text-white"></i> <?php echo e($screen->screen_name_na); ?></span>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="collapse" id="collapseScreen<?php echo e($screen->id); ?>" style="margin-<?php echo e(Auth::user()->lang_id == 1 ? 'left' : 'right'); ?>: 40px;">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Command</th>
                                                    <th>To Supervisor</th>
                                                    <th>To All Supervisors</th>
                                                    <th>To Another Users</th>
                                                    <th>Notification Text</th>
                                                    <th>User name Appearance</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $__currentLoopData = $screen->screen_commands()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $command): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($command->has_notifications == 1): ?>
                                                        <?php
                                                             $command_settings = $saved_notifications_settings->where('controller_name',$command->controller)->where('action_name',$command->action)->first();
                                                        ?>
                                                        <?php
                                                           if($command_settings != null){

                                                            foreach ($command_settings->anotherUsers() as $u){
                                                                var_dump($u->user_id);
                                                            }
                                                        }
                                                        ?>
                                                        <tr data-command-id="<?php echo e($command->id); ?>" data-screen-id="<?php echo e($command->screen_id); ?>" data-command-action="<?php echo e($command->action); ?>" data-command-controller="<?php echo e($command->controller); ?>">
                                                            <td><?php echo e($command->command_name); ?></td>
                                                            <td>
                                                                <div class="togglebutton switch-sidebar-mini">
                                                                    <label class="text-dark">
                                                                        <input class="permissionCheckBoxUser notificationCommand" id="to_main_sup_<?php echo e($command->id); ?>" type="checkbox" <?php echo e($command_settings != null ? ($command_settings->to_supervisor == 1 ? 'checked' : '') : ''); ?>>
                                                                        <span class="toggle"></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="togglebutton switch-sidebar-mini">
                                                                    <label class="text-dark">
                                                                        <input class="permissionCheckBoxUser notificationCommand" id="to_all_sup_<?php echo e($command->id); ?>" type="checkbox" <?php echo e($command_settings != null ? ($command_settings->is_all_supervisors == 1 ? 'checked' : '') : ''); ?>>
                                                                        <span class="toggle"></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <select class="form-control selectpicker notificationCommand" id="another_users_<?php echo e($command->id); ?>" name="another_users[]" data-style="select-with-transition" multiple data-live-search="true" title="Choose Staffs">
                                                                    <?php echo $staffs_options; ?>

                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control notificationCommand" id="noti_text_<?php echo e($command->id); ?>" style="width:300px" value="<?php echo e($command_settings != null ? $command_settings->notification_text : ''); ?>">
                                                            </td>
                                                            <td>
                                                                <select class="form-control selectpicker notificationCommand" id="un_location_<?php echo e($command->id); ?>">
                                                                    <option value="0">No Appearance</option>
                                                                    <option value="1">Before the text</option>
                                                                    <option value="2">After the text</option>
                                                                </select>
                                                                  <?php if($command_settings != null): ?>
                                                                    <script>
                                                                        document.getElementById('un_location_<?php echo e($command->id); ?>').value = '<?php echo e($command_settings->user_name_status); ?>';
                                                                    </script>
                                                                  <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                                </thead>
                                            </table>
                                        </div>
                                        <br>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <br>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .bg_c11 {
            background-color: #c1c1c1;
        }
    </style>
    <!--<div class="card  permission-class">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">lock</i>
            </div>
            <h4 class="card-title">System Notifications Settings</h4>
        </div>

        <div class="card-body">




        </div>
    </div> -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker({
                <?php if(Auth::user()->lang_id == 2 ): ?>
                noneSelectedText: 'لم يتم تحديد شيء',
                <?php endif; ?>
            });            active_nev_link('notifications-link')
        });


        $(function(){

            $('body').on('dblclick', '.unselected_user', function () {
                var arr = [];

                var user_name = $(this).attr('data-user-name');
                var user_id = $(this).attr('data-user-id');

                $(this).remove();

                $('#selected_users').append('<tr class="selected_user" style="cursor: pointer;" data-user-id="'+user_id+'" data-user-name="'+user_name+'">\n' +
                                                '<td><b>' + user_name + '</b></td>\n' +
                                            '</tr>');
            });


            $('body').on('dblclick', '.selected_user', function () {
                var user_name = $(this).attr('data-user-name');
                var user_id = $(this).attr('data-user-id');

                $(this).remove();

                $('#unselected_users').append('<tr class="unselected_user" style="cursor: pointer;" data-user-id="'+user_id+'" data-user-name="'+user_name+'">\n' +
                                                   '<td><b>' + user_name + '</b></td>\n' +
                                               '</tr>');
            });


            $('body').on('click', '.unselected_user', function () {
                var $item = $(this);
                $item.toggleClass('bg_c11');
                if ($item.attr('data-selected')) {
                    $item.removeAttr('data-selected');
                } else {
                    $item.attr('data-selected', 'yes');
                }
                $("tr[data-selected]").each(function () {
                    var $item2 = $(this);
                    if ($item2.attr('data-id') != $item.attr('data-id')) {
                        $item2.removeAttr('data-selected');
                        $item2.toggleClass('bg_c11');
                    }
                });
            });


            $('body').on('click', '.selected_user', function () {
                var $item = $(this);
                $item.toggleClass('bg_c11');
                if ($item.attr('data-selected')) {
                    $item.removeAttr('data-selected');
                } else {
                    $item.attr('data-selected', 'yes');
                }
                $("tr[data-selected]").each(function () {
                    var $item2 = $(this);
                    if ($item2.attr('data-id') != $item.attr('data-id')) {
                        $item2.removeAttr('data-selected');
                        $item2.toggleClass('bg_c11');
                    }
                });
            });


            $('#btnMoveOneLeft').click(function () {
                var x = '';
                $("tr[data-selected]").each(function () {

                    var user_name = $(this).attr('data-user-name');
                    var user_id = $(this).attr('data-user-id');

                    $('#unselected_users').append('<tr class="unselected_user" style="cursor: pointer;" data-user-id="'+user_id+'" data-user-name="'+user_name+'">\n' +
                                                        '<td><b>' + user_name + '</b></td>\n' +
                                                  '</tr>');
                    $(this).remove();
                    $(this).removeAttr('data-selected');
                });

            });

            $('#btnMoveOneRight').click(function () {
                var x = '';
                $("tr[data-selected]").each(function () {

                    var user_name = $(this).attr('data-user-name');
                    var user_id = $(this).attr('data-user-id');

                    $('#selected_users').append('<tr class="selected_user" style="cursor: pointer;" data-user-id="'+user_id+'" data-user-name="'+user_name+'">\n' +
                        '<td><b>' + user_name + '</b></td>\n' +
                        '</tr>');
                    $(this).remove();
                    $(this).removeAttr('data-selected');
                });

            });


            $('#btnMoveAllRight').click(function () {
                var str = '';
                $('.unselected_user').each(function () {

                    var user_name = $(this).attr('data-user-name');
                    var user_id = $(this).attr('data-user-id');

                    str += '<tr class="selected_user" style="cursor: pointer;" data-user-id="'+user_id+'" data-user-name="'+user_name+'">\n' +
                               '<td><b>' + user_name + '</b></td>\n' +
                           '</tr>';
                    $(this).remove();
                    $(this).removeAttr('data-selected');
                });

                var prev = $('#selected_users').html();
                $('#selected_users').html(prev+str);

            });

            $('#btnMoveAllLeft').click(function () {
                var str = '';
                $('.selected_user').each(function () {

                    var user_name = $(this).attr('data-user-name');
                    var user_id = $(this).attr('data-user-id');

                    str += '<tr class="unselected_user" style="cursor: pointer;" data-user-id="'+user_id+'" data-user-name="'+user_name+'">\n' +
                        '<td><b>' + user_name + '</b></td>\n' +
                        '</tr>';
                    $(this).remove();
                    $(this).removeAttr('data-selected');
                });

                var prev = $('#unselected_users').html();
                $('#unselected_users').html(prev+str);

            });


            $('.notificationCommand').change(function(){

                var selected_users = [];
                var to_another_users = [];

                var command_id = $(this).closest('tr').attr('data-command-id');
                var screen_id = $(this).closest('tr').attr('data-screen-id');
                var command_action = $(this).closest('tr').attr('data-command-action');
                var command_controller = $(this).closest('tr').attr('data-command-controller');

                if ($('#to_main_sup_'+command_id).is(':checked')) {
                    to_main_sup = 'yes';
                } else {
                    to_main_sup = 'no';
                }

                if ($('#to_all_sup_'+command_id).is(':checked')) {
                    to_all_sup = 'yes';
                } else {
                    to_all_sup = 'no';
                }

                $('#another_users_'+command_id+' option:selected').each(function () {
                    to_another_users.push($(this).attr('value'));
                });

                var notification_text = $('#noti_text_'+command_id).val();
                var username_location = $('#un_location_'+command_id).val();
                var _token = $('#_token').val();

                $('.selected_user').each(function () {
                    var user_id = $(this).attr('data-user-id');
                    selected_users.push(user_id);
                });

                var url = '<?php echo e(route('settings.notifications.save')); ?>';

                var request_params = {
                    command_id : command_id,
                    screen_id : screen_id,
                    command_action : command_action,
                    command_controller : command_controller,
                    selected_users : selected_users,
                    to_main_sup : to_main_sup,
                    to_all_sup : to_all_sup,
                    to_another_users : to_another_users,
                    notification_text : notification_text,
                    username_location : username_location,
                    _token : _token,
                };

                $.post(url,request_params);

            });


            $(".open-button").on("click", function () {
                $(this).closest('.collapse-group').find('.collapse').collapse('show');
            });

            $(".close-button").on("click", function () {
                $(this).closest('.collapse-group').find('.collapse').collapse('hide');
            });

        });


    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/jquery.validate.min.js')); ?>"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="<?php echo e(asset('assets/js/plugins/jquery.bootstrap-wizard.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-datetimepicker.min.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('js/notifi_settings_wizard.js')); ?>"></script>
    <script>

        wizard();

        function wizard() {
            notifiWizard.initMaterialWizard();
            setTimeout(function () {
                $('#wizardNotification').addClass('active');
            }, 100);
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>