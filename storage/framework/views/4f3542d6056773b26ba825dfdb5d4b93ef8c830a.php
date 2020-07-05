<?php $__env->startSection('css'); ?>
    <style>


    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                <div class="row">
                    <div class="col-md-4"><?php echo e($labels['goals_list'] ?? 'goals_list'); ?></div>
                    <div class="col-md-8" style=" background-color: #fff7d0; border-radius: 10px; ">
                        <div class="row">
                            <?php if(isset($strategics)): ?>
                                <div class='col-md-6'>
                                    <div class="row">
                                        <label style="text-align: center;padding: 17px;font-weight: bold;"
                                               for='strategic_id' class='col-md-4 col-form-label'>

                                            <?php echo e($labels['strategic_index'] ??'strategic_index'); ?>

                                        </label>

                                        <div class='col-md-6'>
                                            <div class='form-group has-default bmd-form-group'>
                                                <select id="strategic_id" name="strategic_id"
                                                        class="form-control  selectpicker" data-live-search='true'
                                                        data-style='btn btn-link'>

                                                    <?php $__currentLoopData = $strategics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $strategic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <?php
                                                            $checked ='';
                                                                    if($strategic->id == $strategic_id){
                                                                        $checked ='selected';
                                                                        }
                                                        ?>
                                                        <option value="<?php echo e($strategic->id); ?>" <?php echo e($checked); ?>><?php echo e($strategic->strategic_name_na); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class='col-md-6'>
                                <div class="row">
                                    <label style="text-align: center;padding: 17px;font-weight: bold;"
                                           for='strategic_id' class='col-md-4 col-form-label'>

                                        <?php echo e($labels['status'] ??'status'); ?>

                                    </label>

                                    <div class='col-md-6'>

                                        <div class='form-group has-default bmd-form-group'>

                                            <select id="status_id" name="status_id"
                                                    class="form-control  selectpicker" data-live-search='true'
                                                    data-style='btn btn-link'>

                                                <option value="0" <?php if($status==0 || $status==null): ?>  selected <?php endif; ?> >
                                                  <?php echo e(statusLang(0)); ?>

                                                </option>
                                                <option value="1" <?php if($status==1): ?> selected <?php endif; ?>>
                                                    <?php echo e(statusLang(1)); ?>

                                                </option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </h4>
        </div>
        <div class="card-body ">

            <a href="<?php echo e(route('goals.main.create')); ?>" class="btn btn-sm btn-success "
               rel="tooltip" data-original-title=""
               title="<?php echo e($labels['add_main_goals'] ?? 'add_main_goals'); ?>" data-placement="top"
               id="AddMainGoals">
                <i class="material-icons">add</i>
                <?php echo e($labels['add_main_goals'] ?? 'add_main_goals'); ?>

            </a>
            <a href="<?php echo e(route('goals.main.index.tree')); ?>" class="btn btn-sm btn-default pull-right"
               rel="tooltip" data-original-title="" title="tree" data-placement="top"
               id="AddMainGoals">
                <i class="material-icons">format_align_right</i>
            </a>


            <table class="table org-goal" id="table">
                <tbody>
                <?php if($goals_indic_result_view != null): ?>

                    <?php $__currentLoopData = $goals_indic_result_view->where('goal_parent_id','0')->unique('goal_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$goal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="width: 2% !important;" class="   height-30"></td>
                            <td style="width: 2% !important;" class="  height-30"></td>
                            <td style="width: 14% !important;" class="height-30"></td>
                            <td style="width: 14% !important;" class="height-30"></td>
                            <td style="width: 10% !important;" class="height-30 "></td>
                            <td style="width: 22% !important;" class="height-30"></td>
                            <td style="width: 22% !important;" class="height-30"></td>
                            <td style="width: 10% !important;" class="height-30"></td>
                        </tr>
                        <tr class="main-goal-style">
                            <td colspan="7">
                                <img src="<?php echo e(asset('\images\mg.png')); ?>" style=" width: 25px; ">
                                <?php echo e($goal->goal_name); ?>

                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm ">
                                        <?php echo e($labels['actions']??'actions'); ?>

                                    </button>
                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                            data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" style="    width: 200px;">

                                        <li>
                                            <a href="<?php echo e(route('goals.main.edit',$goal->goal_id)); ?>" id="EditGoals">
                                                <?php echo e($labels['edit'] ?? 'edit'); ?>

                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?php echo e(route('goals.indicators.create',$goal->goal_id)); ?>"
                                               id="AddIndicators">
                                                <?php echo e($labels['add_indicator'] ?? 'add_indicator'); ?>

                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?php echo e(route('goals.sub.create',$goal->goal_id)); ?>" id="EditActivity">
                                                <?php echo e($labels['add_sub_goal'] ?? 'add_sub_goal'); ?>

                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?php echo e(route('goals.main.destroy',$goal->goal_id)); ?>"
                                               id="DeleteMainGoals">
                                                <?php echo e($labels['delete'] ?? 'delete'); ?>



                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        
                        
                        
                        
                        

                        <?php if($goals_indic_result_view->where('goal_id',$goal->goal_id)->where('indic_id','!=','null')->count() >0): ?>
                            <?php $__currentLoopData = $goals_indic_result_view->where('goal_id',$goal->goal_id)->where('indic_id','!=','null')->unique('indic_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$indic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($indic->indic_id): ?>
                                    <tr>
                                        <td style="border-bottom: 1px solid #ffffff"></td>
                                        <td style="border-bottom: 1px solid #ffffff"></td>
                                        <td colspan="5">
                                            <img src="<?php echo e(asset('images/i.png')); ?>"  style="margin-top: -15px;width: 25px; ">
                                            <?php echo e($indic->indicator_name); ?>


                                        </td>
                                        <td >
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success btn-sm ">
                                                    <?php echo e($labels['actions']??'actions'); ?>

                                                </button>
                                                <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu" style="    width: 168px;">

                                                    <li>
                                                        <a href="<?php echo e(route('goals.indicators.edit',$indic->indic_id)); ?>"
                                                           id="EditIndicator">
                                                            <?php echo e($labels['edit_indicator'] ?? 'edit_indicator'); ?>

                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo e(route('goals.indicators.destroy',$indic->indic_id)); ?>"
                                                           id="DeleteIndicator">
                                                            <?php echo e($labels['delete_indicator'] ?? 'delete_indicator'); ?>

                                                        </a>
                                                    </li>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                </ul>
                                            </div>
                                        </td>

                                    </tr>
                                <?php endif; ?>


                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <?php if($goals_indic_result_view->where('goal_parent_id',$goal->goal_id)->count() >0): ?>
                            <?php $__currentLoopData = $goals_indic_result_view->where('goal_parent_id',$goal->goal_id)->unique('goal_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$goal_sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <tr class="sub-goal-style">
                                    <td></td>
                                    <td colspan="6">
                                        <img src="<?php echo e(asset('\images\sg.png')); ?>" style=" width: 25px; ">
                                        <?php echo e($goal_sub->goal_name); ?>


                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success btn-sm ">
                                                <?php echo e($labels['actions']??'actions'); ?>

                                            </button>
                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle"  data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="    width: 168px;">

                                                <li>
                                                    <a href="<?php echo e(route('goals.sub.edit',$goal_sub->goal_id)); ?>"
                                                       id="EditGoals">
                                                        <?php echo e($labels['edit_sub_goals'] ?? 'edit_sub_goals'); ?>

                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo e(route('goals.sub.destroy',$goal_sub->goal_id)); ?>"
                                                       id="DeleteSubGoals">
                                                        <?php echo e($labels['delete'] ?? 'delete'); ?>

                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo e(route('goals.indicators.create',$goal_sub->goal_id)); ?>"
                                                       id="AddIndicators">
                                                        <?php echo e($labels['add_indicator'] ?? 'add_indicator'); ?>

                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <?php if($goals_indic_result_view->where('goal_id',$goal_sub->goal_id)->where('indic_id','!=','null')->count() >0): ?>
                                    <?php $__currentLoopData = $goals_indic_result_view->where('goal_id',$goal_sub->goal_id)->where('indic_id','!=','null')->unique('indic_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$indic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($indic->indic_id): ?>
                                            <tr>
                                                <td class="" style="border-bottom: 1px solid #ffffff"></td>
                                                <td class="" style="border-bottom: 1px solid #ffffff"></td>
                                                <td colspan="5">
                                                    <img src="<?php echo e(asset('images\i.png')); ?>" style="margin-top: -15px;width: 25px; ">
                                                    <?php echo e($indic->indicator_name); ?>


                                                </td>

                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success btn-sm ">
                                                            <?php echo e($labels['actions']??'actions'); ?>

                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-success btn-sm dropdown-toggle"
                                                                data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu" style="    width: 168px;">

                                                            <li>
                                                                <a href="<?php echo e(route('goals.indicators.edit',$indic->indic_id)); ?>"
                                                                   id="EditIndicator">
                                                                    <?php echo e($labels['edit_indicator'] ?? 'edit_indicator'); ?>

                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo e(route('goals.indicators.destroy',$indic->indic_id)); ?>"
                                                                   id="DeleteIndicator">
                                                                    <?php echo e($labels['delete_indicator'] ?? 'delete_indicator'); ?>

                                                                </a>
                                                            </li>
                                                            
                                                                
                                                                   
                                                                    
                                                                
                                                            
                                                        </ul>
                                                    </div>
                                                </td>

                                            </tr>
                                        <?php endif; ?>


                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>



                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                </tbody>
            </table>


        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(function () {
            active_nev_link('goals');
            $('.selectpicker').selectpicker();

            setTimeout(function () {
                $('.selectpicker').selectpicker('refresh');


            }, 1000);
        });
        $(document).on('click', '#DeleteSubGoals', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({

                text: '<?php echo e($messageDeleteSubGoals['text']); ?>',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success btn-sm',
                cancelButtonClass: 'btn btn-danger btn-sm',
                buttonsStyling: false,
            }).then(result => {
                if (result == true) {
                    // var project_id = $('#formProjectMain #id').val();
                    url = $(this).attr('href');
                    $.ajax({
                        url: url,
                        type: 'delete',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == 'true') {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                            }
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                        },
                        error: function () {
                        }
                    });
                }
            })
        });

        $(document).on('click', '#DeleteMainGoals', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                text: '<?php echo e($messageDeleteMainGoals['text']); ?>',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger btn-sm',
                buttonsStyling: false,
            }).then(result => {
                if (result == true) {
                    // var project_id = $('#formProjectMain #id').val();
                    url = $(this).attr('href');
                    $.ajax({
                        url: url,
                        type: 'delete',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == 'true') {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                            }
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        },
                        error: function () {
                        }
                    });
                }
            })
        });


        $(document).on('click', '#DeleteResult', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                text: '<?php echo e($messageDeleteResult['text']); ?>',
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    // var project_id = $('#formProjectMain #id').val();
                    url = $(this).attr('href');
                    $.ajax({
                        url: url,
                        type: 'delete',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == 'true') {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                            }
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                        },
                        error: function () {
                        }
                    });
                }
            })
        });


        $(document).on('click', '#DeleteIndicator', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({

                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                text: '<?php echo e($messageDeleteIndicator['text']); ?>',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    // var project_id = $('#formProjectMain #id').val();
                    url = $(this).attr('href');
                    $.ajax({
                        url: url,
                        type: 'delete',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == 'true') {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                            }
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                        },
                        error: function () {
                        }
                    });
                }
            })
        });


        $(document).on('change', '#strategic_id', function (e) {
            e.preventDefault();
            var strategic_id = $('#strategic_id').val();
            var status_id = $('#status_id').val();
            var url = '<?php echo e(route("goals.main.index.table")); ?>' + '/' + strategic_id + '/' + status_id;
            window.location.href = url;
        });

        $(document).on('change', '#status_id', function (e) {
            e.preventDefault();
            var strategic_id = $('#strategic_id').val();
            var status_id = $('#status_id').val();
            var url = '<?php echo e(route("goals.main.index.table")); ?>' + '/' + strategic_id + '/' + status_id;
            window.location.href = url;
        });

    </script>



<?php $__env->stopSection(); ?>




<?php $__env->startSection('js'); ?>

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>
    
    
    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>