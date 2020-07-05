<?php $__env->startSection('content'); ?>
    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['addVisit'] ?? 'addVisit'); ?>

            </h4>
        </div>
        <div class="card-body ">

            <div id="result-msg"></div>


            <?php echo Form::open(['route' => 'visits.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formVisitCreate']); ?>

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
                        <a href="<?php echo e(route('visits.index')); ?>" class="btn btn-default btn-sm">
                            <?php echo e($labels['back'] ?? 'back'); ?>

                        </a>
                        <button btn="btnToggleDisabled" type="submit" id="btnAddVisits"
                                class="btn btn-next btn-rose pull-right btn-sm">
                            <div class="loader pull-left" style="display: none;"></div> <?php echo e($labels['save'] ?? 'save'); ?>

                        </button>
                        <a href="#" id="cleanScreen" class="btn  btn-info pull-right btn-sm">
                            <?php echo e($labels['clean'] ?? 'clean'); ?>

                        </a>
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
        });

        $(document).on('submit', '#formVisitCreate', function (e) {
            if (!is_valid_form($(this))) {
                return false;
            }

            e.preventDefault();

            var form = new FormData($(this)[0]);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#btnAddVisits').attr("disabled", true);
                    $('.loader').show();
                },
                success: function (data) {
                    $('#btnAddVisits').attr("disabled", false);
                    $('.loader').hide();
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                        $('.loader').hide();
                    } else if (data.status == 'false') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    //$('#addBenf').prop("disabled", false);


                },
                error: function (data) {

                }
            });

        });

        $(document).on('click', '#cleanScreen', function (e) {
            e.preventDefault();
            $('#formVisitCreate')[0].reset();
            $('#beneficiary_id').selectpicker('refresh')
        })

        $(document).on('change', '#formVisitCreate #city_id', function (e) {
            e.preventDefault();
            var city_id = $(this).val();
            $url = '<?php echo e(route("visits.getDistanceByCityId")); ?>' + '/' + city_id;

            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                    $("#destrict_id option").remove();
                    $("#destrict_id ").append("<option  style='height: 37px;' value></option>");
                    $('#destrict_id').selectpicker('refresh');
                },
                success: function (data) {
                    if (data != null) {
                        selectDestrice(data);
                    }

                    $('#destrict_id').selectpicker('refresh');
                },
                error: function () {
                }
            });
        });

        function selectDestrice(data) {
            $.each(data, function (index, value) {
                $("#destrict_id").append('<option value=' + index + '>' + value + '</option>');
            });
        }

        $(document).on('change', '#formVisitCreate #destrict_id', function (e) {
            e.preventDefault();
            var destrict_id = $(this).val();
            var city_id = $('#city_id').val();
            $url = '<?php echo e(route("visits.getBeneficiaryByCityAndDistance")); ?>' + '/' + city_id + '/' + destrict_id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                    $("#beneficiary_id option").remove();
                    $("#beneficiary_id ").append("<option  style='height: 37px;' value></option>");
                    $('#beneficiary_id').selectpicker('refresh');
                },
                success: function (data) {
                    if (data != null) {
                        selectBeneficiary(data);
                    }
                    $('#beneficiary_id').selectpicker('refresh');
                },
                error: function () {
                }
            });
        });

        function selectBeneficiary(data) {
            $.each(data, function (index, value) {
                $("#beneficiary_id").append('<option value=' + index + '>' + value + '</option>');
            });
        }


        $(document).on('keyup','.bs-searchbox input',function(){
            var value = $(this).val();
            var type = $(this).first().parent().parent().parent().children('select').attr('id');
            if(type == 'beneficiary_id'){
                getBeneficiaryByAjax(value);
            }

        });

        function getBeneficiaryByAjax(value) {
          var city_id = $('#city_id').val();
          var destrict_id = $('#destrict_id').val();
            url='<?php echo e(route('visits.getBeneficiaryByName')); ?>';
            data = 'name='+value+'&city_id='+city_id+'&destrict_id='+destrict_id;
            $.ajax({
                url:url,
                type:'get',
                dataTypes:'json',
                data :data,
                success:function (data) {
                    selectBeneficiary(data);
                }

            })
        }

        function selectBeneficiary(data) {
            $("#beneficiary_id option").remove();
            $('#beneficiary_id').selectpicker('refresh');
            $.each(data, function (index, value) {
                $("#beneficiary_id").append('<option value=' + index + '>' + value + '</option>');
            });
            $('#beneficiary_id').selectpicker('refresh');
        }


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