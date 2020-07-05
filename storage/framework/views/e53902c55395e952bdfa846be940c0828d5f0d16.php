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
                        <?php echo e($labels['opportunity_title'] ?? 'Opportunity'); ?>

                    </div>

                </div>
            </h4>

        </div>
        <div class="card-body ">
            <a href="<?php echo e(route('opportunity.opportunity.create')); ?>" class="btn btn-primary btn-sm btn-fab btn-round"
               data-toggle="tooltip" data-placement="top"
               title="<?php echo e($labels['add'] ?? 'add'); ?>">
                <i class="material-icons">add</i>
            </a>
            
                
                   
                   
                    
                

            


                <table class="table" id="table">
                    <thead>
                    <tr>
                        <th style="width:2% ;">#</th>

                        <th  style="width:13%;">
                            <?php echo e($labels['opportunity_num_title'] ?? 'opportunity No.'); ?>

                        </th>
                        <th style="width:35% !important;" >
                            <?php echo e($labels["subject_title"]?? 'Subject'); ?>

                        </th>
                        <th  style="width:20% !important;">
                            <?php echo e($labels['opportunity_deadline_title'] ?? 'Deadline'); ?>

                        </th>
                        <th  style="width:10%;">
                            <?php echo e($labels['status_title'] ?? 'Status'); ?>

                        </th>
                        <th style="width:10%;">
                            <?php echo e($labels['status_leader_title'] ?? 'Team Leader'); ?>

                        </th>

                        <th  style="width:10%;">
                            <?php echo e($labels['actions'] ?? 'actions'); ?>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($opportunity_list)): ?>
                        <?php $__currentLoopData = $opportunity_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $rrr="project_".lang_character()?>
                            <tr>
                                <td><?php echo e($index+1); ?></td>
                                <td><?php echo e($item->id); ?></td>
                                <td ><?php echo e($item->{'subject_'.lang_character()}); ?></td>
                                <td><?php echo e($item->deadline ?? ""); ?></td>
                                <td><?php echo e($item->{'opportunity_status_'.lang_character()} ?? ""); ?></td>
                                <td><?php echo e($item->{'staff_name_'.lang_character()} ?? ""); ?></td>
                                
                                
                                  
                                      
                                  
                                      
                                  
                                



                                <td>
                                    
                                       
                                       
                                        
                                    

                                    
                                       
                                       
                                        
                                    

                                    <a href="<?php echo e(route('opportunity.opportunity.edit',$item->id)); ?>"
                                       class="btn btn-sm btn-success btn-round btn-fab"
                                       data-toggle="tooltip" data-placement="top" title="<?php echo e($labels['edit'] ?? 'edit'); ?>">
                                        <i class="material-icons">edit</i>
                                    </a>

                                    <a href="<?php echo e(route('opportunity.delete',$item->id )); ?>" id="btnOpportunityDelete"
                                       class="btn btn-sm btn-danger btn-round btn-fab"
                                       data-toggle="tooltip" data-placement="top"
                                       title="<?php echo e($labels['delete'] ?? 'delete'); ?>">
                                        <i class="material-icons">delete</i>
                                    </a>



                                    
                                       
                                       
                                       
                                        
                                    

                                    
                                    
                                    
                                    
                                    
                                    
                                    

                                </td>
                            </tr>
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
            active_nev_link('project-index')
            DataTableCall('#table', 7);
            $('[data-toggle="tooltip"]').tooltip();

            $('.selectpicker').selectpicker();
            setTimeout(function () {
                $('.selectpicker').selectpicker('refresh');
            }, 1000);
        })

        /*///////////*****delete Opportunity****//////////*/
        $(document).on('click', '#btnOpportunityDelete', function (e) {
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
                            if (data.status == true) {
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
            var url = '<?php echo e(route("opportunity.opportunity.index")); ?>' + '/' + strategic_id;
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