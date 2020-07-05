<?php $__env->startSection('content'); ?>

    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['screen_gantt_chart'] ?? 'screen_gantt_chart'); ?>

            </h4>
            <br>

            <?php echo Form::open(['route' => 'activity.gantt_chart.project' ,'action'=>'post' ,'id'=>'formGanttChartByProject']); ?>


            <div class="row">
                <label for="project_id" class="col-md-1 col-form-label"> <?php echo e($labels['Projects'] ?? 'Projects'); ?> </label>
                <div class="col-md-3">
                    <div class='form-group has-default bmd-form-group'>
                        <select class='form-control selectpicker' data-live-search="true" name='project_id' data-style='btn btn-link' id='project_id' required>
                            <option style='height: 37px;' value></option>
                            <?php if($projects_all): ?>
                                <?php $__currentLoopData = $projects_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project_): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($project_->id); ?>"><?php echo e($project_->{'project_name_'.lang_character()}); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <label for="by_date" class="col-md-1 col-form-label"> <?php echo e($labels['by'] ?? 'by'); ?></label>
                <div class="col-md-3">
                    <div class='form-group has-default bmd-form-group'>
                        <select class='form-control selectpicker' data-live-search="true" name='by_date' data-style='btn btn-link' id='project_id' required>
                            <option style='height: 37px;' value="p"><?php echo e(Auth::user()->lang_id == 1 ? 'Planed Date' : 'التاريخ المخطط'); ?></option>
                            <option style='height: 37px;' value="a"><?php echo e(Auth::user()->lang_id == 1 ? 'Actual Date' : 'التريخ الفعلي'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" btn="btnToggleDisabled" id="btn-show-activities-ganttChart" class="btn btn-rose pull-center">
                        <?php echo e(Auth::user()->lang_id == 1 ? 'View Gantt Chart' : 'عرض الرسم البياني'); ?>

                        <div class="loader pull-left" style="display: none;"></div>
                    </button>
                </div>
            </div>

            <?php echo Form::close(); ?>

            <br>
        </div>
        <div id="gantt-chart-element">

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            active_nev_link('idgantt_chart');

            $('#minimizeSidebar').click();

            $('#formGanttChartByProject').submit(function(e){
                e.preventDefault();
                var form = $(this).serialize();
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    data: form,
                    type: 'post',
                    beforeSend: function () {
                        $('.loader').show();
                        $('#btn-show-activities-ganttChart').attr('disabled',true);
                        $('#gantt-chart-element').html('<div style="margin: auto" class="loader-div"></div><br><br><br>');
                    },
                    success: function (data) {
                        $('#btn-show-activities-ganttChart').attr('disabled',false);
                        $('.loader').hide();
                        if (data.activities > 0 && data.error == false) {
                            $('#gantt-chart-element').html(data.chart);
                        } else if (data.activities < 1 && data.error == false) {
                            $('#gantt-chart-element').html('<div class="alert alert-danger"><?php echo e(getMessage('2.157')['text']); ?></div>');
                        } else if(data.activities == 0 && data.error == true) {
                            $('#gantt-chart-element').html('<div class="alert alert-danger">No project selected !!</div>');
                        }
                    },
                    error: function (data) {
                    }
                });
            });


        });


    </script>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>
    <!-- Forms Validations Plugin -->
    <script src="<?php echo e(asset('assets/js/plugins/jquery.validate.min.js')); ?>"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="<?php echo e(asset('assets/js/plugins/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-datetimepicker.min.js')); ?>"></script>

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jsgantt.js')); ?>"></script>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>