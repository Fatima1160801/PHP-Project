<?php $__env->startSection('content'); ?>
    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['LabelsSettings'] ?? 'LabelsSettings'); ?>

            </h4>
        </div>
        <div class="card-body ">

            <div id="result-msg"></div>


            <?php echo Form::open(['route'=>'labelsSettings.index','novalidate'=>'novalidate','method'=>'post' ,'id'=>'formSearch']); ?>


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

            <input type="hidden" name="button_clicked" id="button_clicked" value="">
            <div class="col-md-12">
                <div class="card-footer ml-auto mr-auto">
                    <div class="ml-auto mr-auto">
                        <button btn="btnToggleDisabled" type="submit" id="btnSearch"
                                class="btn btn-next btn-rose pull-right btn-sm">
                            <div class="loader pull-left" style="display: none;"></div> <?php echo e($labels['search'] ?? 'search'); ?>

                        </button>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">

                    <div class=" col-md-3 bolder">
                        <?php echo e($labels['label'] ?? 'Label'); ?>

                    </div>
                    <div class=" col-md-3 bolder">
                        <?php echo e($labels['labelHint'] ?? 'Label  Hint'); ?>

                    </div>
                    <div class=" col-md-3 bolder">
                        <?php echo e($labels['labelNew'] ?? 'Label New'); ?>

                    </div>
                    <div class=" col-md-3 bolder">
                        <?php echo e($labels['labelHintNew'] ?? 'Label Hint New'); ?>

                    </div>
                </div>
            </div>
            <hr>
            <?php if(!empty($results) && sizeof($results) >0): ?>
                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-12">
                        <div class="row">
                            <!-- <label for="interface_type_na" class="col-md-1 col-form-label">label</label> -->
                            <div class=" col-md-3">
                                <div class="form-group has-default bmd-form-group">
                                    <label><?php echo e($result->label); ?></label>
                                    
                                </div>
                            </div>
                            <div class=" col-md-3">
                                <div class="form-group has-default bmd-form-group">
                                    <label><?php echo e($result->label); ?></label>
                                    
                                </div>
                            </div>
                            <div class=" col-md-3">
                                <div class="form-group has-default bmd-form-group">
                                    <input type="text" value="" class="form-control  " name="labelNew_<?php echo e($result->id); ?>" id="labelNew_<?php echo e($result->id); ?>" required="" minlength="0" maxlength="100" alt="Inerface">
                                </div>
                            </div>
                            <div class=" col-md-3">
                                <div class="form-group has-default bmd-form-group">
                                    <input type="text" value="" class="form-control  " name="labelHintNew_<?php echo e($result->id); ?>" id="labelHintNew_<?php echo e($result->id); ?>" required="" minlength="0" maxlength="100" alt="Inerface">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="col-md-12">

                <div class="card-footer ml-auto mr-auto">
                    <div class="ml-auto mr-auto">
                        <button btn="btnToggleDisabled" type="submit" id="btnSave"
                                class="btn btn-next btn-rose pull-right btn-sm">
                            <div class="loader pull-left" style="display: none;"></div> <?php echo e($labels['save'] ?? 'save'); ?>

                        </button>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php echo Form::close(); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            active_nev_link('visitType-link');
            funValidateForm();
            $('input').prop('required',false);
            $('input[id^="label_"]').attr('disabled',true);
            $('input[id^="labelHint_"]').attr('disabled',true);

        });

        $('#btnSearch').click(function(){
            $('#button_clicked').val('search');
        });

        $('#btnSave').click(function(){
            $('#button_clicked').val('save');
        });


        // $(document).on('submit', '#formSearch', function (e) {
        //     if (!is_valid_form($(this))) {
        //         return false;
        //     }
        //     e.preventDefault();
        //     var form = new FormData($(this)[0]);
        //     var url = $(this).attr('action');
        //     // alert(url);
        //     $.ajax({
        //         url: url,
        //         data: form,
        //         type: 'post',
        //         processData: false,
        //         contentType: false,
        //         beforeSend: function () {
        //             $('#btnSearch').attr("disabled", true);
        //             $('.loader').show();
        //         },
        //         success: function (data) {

        //            $('#btnSearch').attr("disabled", false);
        //             $('.loader').hide();

        //              $("#formSearch").trigger("reset");
        //              setTimeout(() => {  window.location.href = "/rhodes-pme-new/opportunities"; }, 1000);
        //         },
        //         error: function (data) {

        //         }
        //     });
        // });

        // $(document).on('click', '#cleanScreen', function (e) {
        //     e.preventDefault();
        //     $('#formSearch')[0].reset();
        //     // $('#beneficiary_id').selectpicker('refresh')
        // })



    </script>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>
    <!-- Forms Validations Plugin -->
    <script src="<?php echo e(asset('assets/js/plugins/jquery.validate.min.js')); ?>"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="<?php echo e(asset('assets/js/plugins/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-datetimepicker.min.js')); ?>"></script>

    <!--    Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/jasny-bootstrap.min.js')); ?>"></script>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>