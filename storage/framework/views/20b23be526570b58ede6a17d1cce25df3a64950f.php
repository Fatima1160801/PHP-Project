<?php $__env->startSection('content'); ?>
    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['edit'] ?? 'Edit'); ?>

            </h4>
        </div>
        <div class="card-body ">

            <div id="result-msg"></div>

            <?php echo Form::open(['route' => 'settings.documents.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formOpportunityUpdate']); ?>

            
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
                <a href="<?php echo e(route('settings.documents.index')); ?>" class="btn btn-default btn-sm">
                    <?php echo e($labels['back'] ?? 'back'); ?>

                </a>
                <button btn="btnToggleDisabled" type="submit" id="btnEditOpportunity"
                        class="btn-sm btn btn-next btn-rose pull-right">
                    <div class="loader pull-left " style="display: none;"></div> <?php echo e($labels['save'] ?? 'save'); ?>

                </button>
            </div>
        </div>
    </div>


    <?php echo Form::close(); ?>

    </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            active_nev_link('visit-link');
            funValidateForm();
            $('.selectpicker').selectpicker();
            // $('.datetimepicker').datetimepicker({
            //     icons: {
            //         time: "fa fa-clock-o",
            //         date: "fa fa-calendar",
            //         up: "fa fa-chevron-up",
            //         down: "fa fa-chevron-down",
            //         previous: 'fa fa-chevron-left',
            //         next: 'fa fa-chevron-right',
            //         today: 'fa fa-screenshot',
            //         clear: 'fa fa-trash',
            //         close: 'fa fa-remove'
            //     },
            //     format: 'DD/MM/YYYY'
            // });
        });

        $(document).on('submit', '#formOpportunityUpdate', function (e) {

            if (!is_valid_form($(this))) {
                return false;
            }

            e.preventDefault();

            var form = new FormData($(this)[0]);
            var url = $(this).attr('action');
            // alert(url);
            // alert($(this).attr('action'));
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#btnEditOpportunity').attr("disabled", true);
                    $('.loader').show();
                },
                success: function (data) {
                    $('#btnEditOpportunity').attr("disabled", false);
                    $('.loader').hide();
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('.loader').hide();
                        setTimeout(() => {  window.location.href = "<?php echo e(route('settings.documents.index')); ?>"; }, 1000);
                    }

                },
                error: function (data) {

                }
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

    <script src="<?php echo e(asset('assets/js/plugins/jasny-bootstrap.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>