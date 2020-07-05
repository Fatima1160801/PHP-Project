<?php $__env->startSection('content'); ?>

    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                <?php echo e($screenNameadd); ?>

                <br>
                <?php echo e($screenName); ?></h4>
        </div>
        <div class="card-body ">


            <?php echo Form::open(['route' => 'goals.indicators.store'  ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formIndicatorCreate']); ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php echo $html; ?>



            <div class="col-md-12">

                <div class="card-footer ml-auto mr-auto">
                    <div class="ml-auto mr-auto">
                        <a href="<?php echo e(route('goals.main.index.table')); ?>" class="btn btn-default  btn-sm">
                            <?php echo e($labels['back']??'back'); ?>

                        </a>
                        <button type="submit" class="btn btn-next btn-rose pull-right  btn-sm">
                            <?php echo e($labels['save']??'save'); ?>

                        </button>
                    </div>
                </div>
            </div>


            <?php echo Form::close(); ?>

        </div>
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                    <tr>
                        <td>#</td>
                        <td>
                            <?php echo e($labels['indicator']??'indicator'); ?>

                        </td>
                        <td>
                            <?php echo e($labels['actions']??'actions'); ?>

                                                    </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $indicatorsByGoal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$indicator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index+1); ?></td>
                            <td><?php echo e($indicator->indic_name_na); ?></td>
                            <td>
                                <a href="<?php echo e(route('goals.indicators.edit',$indicator->id)); ?>" rel="tooltip"
                                   class="btn btn-sm   btn-round btn-success btn-fab  btn-sm"
                                   rel="tooltip" data-original-title=""
                                   title="<?php echo e($labels['edit_indicator']??'edit_indicator'); ?>"
                                   data-placement="top" id="EditIndicator">
                                    <i class="material-icons">edit</i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php $__env->stopSection(); ?>
        <?php $__env->startSection('script'); ?>

            <script>
                $(document).ready(function () {
                    $('.selectpicker').selectpicker();

                    funValidateForm();
                    active_nev_link('indicators_type')
                });

                $(document).on('submit', '#formIndicatorCreate', function (e) {
                    if (!is_valid_form($(this))) {
                        return false
                    }
                })

                $(document).on('change','#is_measurable',function (e) {
                    e.preventDefault();
                    is_measurable();
                })

                function is_measurable() {
                    $is_measurable = $('#is_measurable').val();
                    if($is_measurable == 1){
                        // $('#indic_unit').removeAttr('disabled');
                        // $('#is_collect').removeAttr('disabled');
                         $('#indic_unit').prop('disabled', false);
                        $('#indic_unit').selectpicker('refresh');
                         $('#is_collect').prop('disabled', false);
                        $('#is_collect').selectpicker('refresh');


                    }else if($is_measurable == 2){
                        // $('#indic_unit').attr('disabled','disabled');
                        // $('#is_collect').attr('disabled','disabled');
                        $('#indic_unit').val('');
                        $('#indic_unit').prop('disabled', true);
                        $('#indic_unit').selectpicker('refresh');
                        $('#is_collect').val('');
                        $('#is_collect').prop('disabled', true);
                        $('#is_collect').selectpicker('refresh');
                    }
                }

            </script>
    <?php $__env->stopSection(); ?>



    <?php $__env->startSection('js'); ?>

        <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
            <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>
            <!-- Forms Validations Plugin -->
            <script src="<?php echo e(asset('assets/js/plugins/jquery.validate.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>