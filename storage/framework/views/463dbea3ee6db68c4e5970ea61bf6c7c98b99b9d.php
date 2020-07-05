<?php $__env->startSection('content'); ?>

    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                Add New Agenda

            </h4>
        </div>
        <div class="card-body ">

            <div id="result-msg"></div>


            <?php echo Form::open(['route' => 'agenda.store' ,'action'=>'post' ,'id'=>'formAgendaCreate']); ?>

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
                        <a href="<?php echo e(route('home')); ?>" class="btn btn-default">
                            <?php echo e($labels['back']??'back'); ?>

                        </a>
                        <button type="submit" id="btnAddAgenda" class="btn btn-next btn-rose pull-right">
                            <div class="loader pull-left" style="display: none;"></div> <?php echo e($labels['save']??'save'); ?>

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

        $(function () {

            $('.selectpicker').selectpicker();
            datetimepicker();

            $("#start_date").on("dp.change", function (e) {
                $('#end_date').data("DateTimePicker").minDate(e.date);
            });

            $("#end_date").on("dp.change", function (e) {
                $('#start_date').data("DateTimePicker").maxDate(e.date);
            });


            $('#formAgendaCreate').submit(function(e){

                e.preventDefault();

                var form = $(this).serialize();
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    data: form,
                    type: 'post',
                    beforeSend: function () {
                        $('#btnAddAgenda').prop("disabled", true);
                        $('.loader').show();
                    },
                    success: function (data) {
                        $('#btnAddAgenda').prop("disabled", false);
                        $('.loader').hide();
                        if (data.success == true) {
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        } else if (data.success == false) {
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
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

    <script src="<?php echo e(asset('assets/js/plugins/jquery.validate.min.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/js/plugins/jquery.bootstrap-wizard.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-datetimepicker.min.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>

    <script>

        function datetimepicker() {
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
                format: 'DD/MM/YYYY'
            });
        }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>