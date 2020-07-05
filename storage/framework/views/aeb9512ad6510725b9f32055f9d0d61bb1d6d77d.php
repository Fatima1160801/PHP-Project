<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                <div class="row">
                    <div class="col-md-6">
                        <?php echo e($labels['project'] ?? 'project'); ?>

                    </div>
                    <div class="col-md-6">
                        <?php if(isset($strategics)): ?>

                            <div class='col-md-12' style=" background-color: #fff7d0; border-radius: 10px; ">
                                <div class="row">
                                    <label style="text-align: center;padding: 17px;font-weight: bold;"
                                           for='strategic_id' class='col-md-4 col-form-label'>
                                        <?php echo e($labels['strategic_index'] ??'strategic_index'); ?>                                    </label>
                                    <div class='col-md-8'>
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
                    </div>
                </div>
            </h4>

        </div>
        <div class="card-body ">
            <a href="<?php echo e(route('project.project.create')); ?>" class="btn btn-primary btn-sm btn-fab btn-round"
               data-toggle="tooltip" data-placement="top"
               title="<?php echo e($labels['add'] ?? 'add'); ?>">
                <i class="material-icons">add</i>
            </a>
            <?php if( Auth::user()->id == 1 || in_array(156,$userPermissions)): ?>
                <a href="<?php echo e(route('project.project.reportProject')); ?>" class="btn btn-primary  btn-sm btn-fab btn-round"
                   rel="tooltip" data-placement="top"
                   title="<?php echo e($labels['search'] ?? 'search'); ?>">
                    <i class="material-icons">search</i>
                </a>

            <?php endif; ?>

            <div class="table-responsive">
                <table class="table " id="table">
                    <thead>
                    <tr>
                        <th>#</th>


                        <th width="120">
                            <?php echo e($labels['reference_no'] ?? 'reference_no'); ?>

                        </th>
                        <th>
                            <?php echo e($labels['project_name'] ?? 'project_name'); ?>

                        </th>
                        <th>
                            <?php echo e($labels['Manager'] ?? 'Manager'); ?>

                        </th>
                        <th>
                            <?php echo e($labels['created_by'] ?? 'created_by'); ?>


                        </th>
                        <th width="180">
                            <?php echo e($labels['donors'] ?? 'donors'); ?>

                        </th>
                        <th width="120">
                            <?php echo e($labels['is_hidden'] ?? 'is_hidden'); ?>

                        </th>
                        <th width="120">
                            <?php echo e($labels['plan_starte_date'] ?? 'plan_starte_date'); ?>

                        </th>
                        <th width="120">
                            <?php echo e($labels['plan_end_date'] ?? 'plan_end_date'); ?>

                        </th>
                        <th width="130">
                            <?php echo e($labels['actions'] ?? 'actions'); ?>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($projects)): ?>
                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td><?php echo e($index+1); ?></td>
                                <td><?php echo e($project->reference_no); ?></td>
                                <td><?php echo e($project->getProjectNameByUserLang()); ?></td>
                                <td>

                                    <a href="<?php echo e(route('project.staff.edit',$project->manager_id)); ?>">
                                        <?php if( $project->manager): ?>
                                            <?php if( $project->manager->avatar_ =="" || $project->manager->avatar_ ==null): ?>

                                                <?php echo e($project->manager ? $project->manager->{'staff_name_'.lang_character()} :''); ?>

                                            <?php else: ?>
                                                <img src="<?php echo e(!empty($project->manager->avatar_) ? asset('images/user/photo/').'/'.$project->manager->avatar_ : asset('assets/img/placeholder.png')); ?>"
                                                     style="width:40px;height:40px" class="team-staff" data-toggle="tooltip" data-placement="top"
                                                     title=" <?php echo e($project->manager ? $project->manager->{'staff_name_'.lang_character()} :" "); ?>"  data-original-title="Avatar">
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </a>
                                </td>
                                <td>
                                     <?php if( $project->userCreate): ?>
                                    <a href="<?php echo e(route('project.staff.edit',$project->userCreate->staff_id)); ?>">
                                        <?php echo e($project->userCreate->user_full_name); ?>

                                    </a>
                                        <?php endif; ?>
                                </td>
                                <td>
                                    <?php $donors = $project->donors; ?>
                                    <?php if($donors->count()>0): ?>
                                        <?php $__currentLoopData = $donors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <ul class="list-group">
                                                <li class="list-group-item"> <?php echo e($donor->{'donor_name_'.lang_character()}); ?> </li>
                                            </ul>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($project->is_hidden == 0): ?> ongoing <?php else: ?> closed <?php endif; ?>
                                </td>

                                <td> <?php echo e(dateFormatSite($project->plan_start_date)); ?>  </td>
                                <td>  <?php echo e(dateFormatSite($project->plan_end_date)); ?>  </td>
                                <td>
                                    <a href="<?php echo e(route('project.project.show',$project->id)); ?>"
                                       class="btn btn-sm btn-info btn-round btn-fab"
                                       data-toggle="tooltip" data-placement="top" title="Show">
                                        <i class="material-icons">list_alt</i>
                                    </a>

                                    <a href="<?php echo e(route('project.project.edit',$project->id)); ?>"
                                       class="btn btn-sm btn-success btn-round btn-fab"
                                       data-toggle="tooltip" data-placement="top" title="<?php echo e($labels['edit'] ?? 'edit'); ?>">
                                        <i class="material-icons">edit</i>
                                    </a>

                                    <a href="<?php echo e(route('project.project.delete',$project->id )); ?>" id="btnProjectDelete"
                                       class="btn btn-sm btn-danger btn-round btn-fab"
                                       data-toggle="tooltip" data-placement="top"
                                       title="<?php echo e($labels['delete'] ?? 'delete'); ?>">
                                        <i class="material-icons">delete</i>
                                    </a>



                                    <a target="_blank" href="<?php echo e(route('project.project.part',$project->id )); ?>"
                                       class="btn btn-sm btn-info btn-round btn-fab"
                                       data-toggle="tooltip" data-placement="top"
                                       title="<?php echo e($labels['pert_chart'] ?? 'PERT Chart'); ?>">
                                        <i class="material-icons">print</i>
                                    </a>

                                    <a target="_blank" href="<?php echo e(route('tasks.create',['project',$project->id])); ?>"
                                       class="btn btn-sm btn-default btn-round btn-fab"
                                       data-toggle="tooltip" data-placement="top"
                                       title="<?php echo e($labels['add_task'] ?? 'add_task'); ?>">
                                        <i class="material-icons">assignment</i>
                                    </a>
                                    <a target="_blank" href="<?php echo e(route('project.dashboard.index',$project->id)); ?>"
                                       class="btn btn-sm btn-rose btn-round btn-fab"
                                       data-toggle="tooltip" data-placement="top"
                                       title="<?php echo e($labels['dashboard'] ?? 'Dashboard'); ?>">
                                        <i class="material-icons">dashboard</i>
                                    </a>
                                    
                                    
                                    
                                    
                                    
                                    
                                    

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(function () {
            active_nev_link('project-index')
            DataTableCall('#table', 9);
            $('[data-toggle="tooltip"]').tooltip();

            $('.selectpicker').selectpicker();
            setTimeout(function () {
                $('.selectpicker').selectpicker('refresh');
            }, 1000);
        })

        /*///////////*****delete staff****//////////*/
        $(document).on('click', '#btnProjectDelete', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '<?php echo e($messageDeleteProject['text']); ?>',
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
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
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                $('#contentModal .close').click();
                            } else {
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            }
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
            var url = '<?php echo e(route("project.project.index")); ?>' + '/' + strategic_id;
            window.location.href = url;
        });
        var reports_getData = "<?php echo e(route('reports.getData',2)); ?>";

    </script>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-datetimepicker.min.js')); ?>"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    
    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/modal_setting.js')); ?>"></script>
    <script src="<?php echo e(asset('js/wizardReport.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>