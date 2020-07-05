<?php $__env->startSection('content'); ?>

    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">person
                </i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['screen_add_staff_name'] ?? 'screen_add_staff_name'); ?>

            </h4>
        </div>

        <?php echo Form::open(['route' => 'project.staff.store'  ,'novalidate'=>'novalidate','enctype'=>'multipart/form-data','action'=>'post' ,'id'=>'formAdd']); ?>

        <div class="card-body ">
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


            <div class="card-footer ml-auto mr-auto">
                <div class="ml-auto mr-auto">
                    <a href="<?php echo e(route('project.staff.index')); ?>" class="btn btn-sm btn-default pull-left">
                        <?php echo e($labels['back'] ?? 'back'); ?></a>
                    <button btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="saveStaff">
                        <?php echo e($labels['save'] ?? 'save'); ?>

                        <div class="loader pull-left" style="display: none;"></div>
                    </button>
                </div>
            </div>

            <?php echo Form::close(); ?>

        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            active_nev_link('staff-link');
            $('.selectpicker').selectpicker({
                   noneSelectedText: 'لم يتم تحديد شيء',
            });
            var newdate = new Date();
            $('#dob').data("DateTimePicker").maxDate(newdate);
            funValidateForm();
        })

        $(document).on('submit', '#formAdd', function (e) {
            if (!is_valid_form($(this))) {
                return false
            }
        });

        $('.datetimepicker').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            },
            format: 'DD/MM/YYYY',
            useCurrent: false
        });
        // var newdate = new Date();
        // console.log(newdate);
        // newdate.setDate(newdate.getDate() + 1);
        // var dd = newdate.getDate();
        // var mm = newdate.getMonth() + 1;
        // var y = newdate.getFullYear();
        // var someFormattedDate = dd + '/' + mm + '/' + y;
        // console.log(someFormattedDate);
        // $('#dob').data("DateTimePicker").maxDate(someFormattedDate);

        // $("

    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <!-- Forms Validations Plugin -->
    <script src="<?php echo e(asset('assets/js/plugins/jquery.validate.min.js')); ?>"></script>


    <script src="<?php echo e(asset('assets/js/plugins/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-datetimepicker.min.js')); ?>"></script>


    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>

    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="<?php echo e(asset('assets/js/plugins/jasny-bootstrap.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>