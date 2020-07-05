<?php $__env->startSection('content'); ?>

    <div class="card  permission-class">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">lock</i>
            </div>
            <h4 class="card-title"> <?php echo e($title); ?></h4>
        </div>
        <div class="card-body">

            <div class="collapse-group">
                <button class="btn btn-primary open-button" type="button">
                    Open all
                </button>
                <button class="btn btn-primary close-button" type="button">
                    Close all
                </button>

                <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="card">
                        <header class="card-header bg-primary ">
                            <a href="#" data-toggle="collapse" data-target="#collapseModule<?php echo e($module->id); ?>"
                               aria-expanded="true" class="">
                                <i class="icon-action fa fa-chevron-down text-white"></i>
                                <span class="title "> <?php echo e($module->module_name_na); ?> </span>
                            </a>
                        </header>
                        <div class="collapse show" id="collapseModule<?php echo e($module->id); ?>" style="">
                            <article class="card-body">

                         <!------------------------------------------------------ screen.// -->
                                <?php $__currentLoopData = $module->screens()->orderBy('order_', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $screen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($screen->has_premission == 1): ?>
                                    <div class="card">
                                        <header class="card-header bg-info">

                                            <span class=" togglebutton switch-sidebar-mini text-left">
                                                <label>
                                                    <input screenNo="screen<?php echo e($screen->id); ?>" class="screenChecked" type="checkbox">
                                                    <span class="toggle"></span>
                                                </label>
                                            </span>

                                            <a href="#" data-toggle="collapse" data-target="#collapseScreen<?php echo e($screen->id); ?>" aria-expanded="true" class="">
                                                <i class="icon-action fa fa-chevron-down text-white"></i>
                                                <span class="title "><?php echo e($screen->screen_name_na); ?></span>
                                            </a>

                                        </header>
                                        <div class="collapse show" id="collapseScreen<?php echo e($screen->id); ?>" style="">
                                            <article class="card-body">
                                                <!------------------------------------------------------ command.// -->
                                                <div class="row">
                                                    <?php if($type =='user'): ?>
                                                        <?php $__currentLoopData = $screen->screen_commands()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $command): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                <div class="togglebutton switch-sidebar-mini">
                                                                    <label class="text-dark">
                                                                        <input class="permissionCheckBoxUser screen<?php echo e($screen->id); ?>"
                                                                               command-id="<?php echo e($command->id); ?>"
                                                                               screen-id="<?php echo e($screen->id); ?>"
                                                                               command-type-id="<?php echo e($command->screen_command_type_id); ?>"
                                                                               user_id="<?php echo e($user->id); ?>"
                                                                               type="checkbox"
                                                                                <?php echo e(checkPermUserGroup($screen->id,$command->id,$command->screen_command_type_id,$user->id)); ?>

                                                                                <?php echo e(checkPermUser($screen->id,$command->id,$command->screen_command_type_id,$user->id)); ?>>
                                                                        <span class="toggle"></span>
                                                                        <?php echo e($command->command_name); ?>

                                                                    </label>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                    <?php if($type =='group'): ?>
                                                        <?php $__currentLoopData = $screen->screen_commands()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $command): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                <div class="togglebutton switch-sidebar-mini">
                                                                    <label class="text-dark">
                                                                        <input class="permissionCheckboxGroup screen<?php echo e($screen->id); ?>"
                                                                               command-id="<?php echo e($command->id); ?>"
                                                                               screen-id="<?php echo e($command->screen_id); ?>"
                                                                               command-type-id="<?php echo e($command->screen_command_type_id); ?>"
                                                                               group_id="<?php echo e($group->id); ?>"
                                                                               type="checkbox"
                                                                                <?php echo e(checkPermInGroup($group->id  ,$screen->id,$command->id,$command->screen_command_type_id)); ?>>
                                                                        <span class="toggle"></span>
                                                                        <?php echo e($command->command_name); ?>

                                                                    </label>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </div>
                                                <!------------------------------------------------------ command.// -->


                                            </article> <!-- card-body.// -->
                                        </div> <!-- collapse .// -->
                                    </div> <!-- card.// -->
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <!------------------------------------------------------ endScreen.// -->

                            </article> <!-- card-body.// -->
                        </div> <!-- collapse .// -->
                    </div> <!-- card.// -->

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>


        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>


        $(".open-button").on("click", function () {
            $(this).closest('.collapse-group').find('.collapse').collapse('show');
        });

        $(".close-button").on("click", function () {
            $(this).closest('.collapse-group').find('.collapse').collapse('hide');
        });


        $(document).on('change', '.permissionCheckBoxUser', function (e) {
            e.preventDefault();
            var command_id = $(this).attr('command-id');
            var screen_id = $(this).attr('screen-id');
            var command_type_id = $(this).attr('command-type-id');
            var user_id = $(this).attr('user_id');
            var checkType = "";
            if ($(this).is(':checked')) {
                checkType = 'check';
            } else {
                checkType = 'uncheck';
            }
            data = {
                'screen_id': screen_id,
                'command_id': command_id,
                'command_type_id': command_type_id,
                'user_id': user_id,
                'checkType': checkType
            };
            var url = '<?php echo e(route("permission.permission.grantUser")); ?>';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {

                },
                success: function (data) {
                    //console.log(data);
                },
                error: function () {

                }
            })
        })

        /****************  not edit permission grant by group to user  ******************/
        $(document).on('change', '.screenChecked', function (e) {
            e.preventDefault();

            checkClass = '.' + $(this).attr('screenNo');

            if ($(this).is(':checked')) {

                $(checkClass).each(function () {
                    var attr = $(this).attr('disabled');
                  //  console.log($(this).attr('disabled') != 'disabled');
                    if($(this).attr('disabled') != 'disabled'){
                        $(this).prop('checked', true);
                        $(this).change();
                    }
                });
            } else {
                $(checkClass).each(function () {
                    if($(this).attr('disabled') != 'disabled'){
                        $(this).prop('checked', false);
                        $(this).change();
                    }
                });

            }
        });
        /*group*/

        $(document).on('change', '.permissionCheckboxGroup', function (e) {
            e.preventDefault();
            var command_id = $(this).attr('command-id');
            var screen_id = $(this).attr('screen-id');
            var command_type_id = $(this).attr('command-type-id');
            var group_id = $(this).attr('group_id');

            var checkType = "";
            if ($(this).is(':checked')) {
                checkType = 'check';
            } else {
                checkType = 'uncheck';
            }
            data = {
                'screen_id': screen_id,
                'command_id': command_id,
                'command_type_id': command_type_id,
                'group_id': group_id,
                'checkType': checkType
            };
            var url = '<?php echo e(route("permission.permission.grantGroup")); ?>';

            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                },
                success: function (data) {
                    console.log(data);
                },
                error: function () {
                }
            })
        })
        /*checked*/
        $(document).ready(function (e) {

            $('.screenChecked').each(function () {
                $this = $(this);
                $this.prop('checked', true);
                $this.prop('disabled', false);
                checkClass = '.' + $(this).attr('screenNo');
                $index = 0;
                $disabled = 0;
                $(checkClass).each(function () {
                    $index = $index + 1;
                    if ($(this).is(':checked') == false) {
                        $this.prop('checked', false);
                    }
                    if ($(this).is(':disabled') == true) {
                        $disabled = $disabled + 1;
                    }
                });
                if ($index == $disabled) {
                    $this.prop('disabled', true);

                }
            });

        })


        /**/
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>