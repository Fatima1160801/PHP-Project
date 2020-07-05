<?php $__env->startSection('content'); ?>
    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                <?php echo e($labels['add_organization']??'add_organization'); ?>


            </h4>
        </div>
        <div class="card-body ">

            <div id="result-msg"></div>


            <?php echo Form::open(['route' => 'beneficiary.oraganizations.store'  ,'novalidate'=>'novalidate'
,'action'=>'post' ,'id'=>'formBeneficiaryOrgCreate']); ?>

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
                        <a  href="<?php echo e(route('beneficiary.oraganizations.index')); ?>" class="btn btn-default btn-sm">
                            <?php echo e($labels['back']??'back'); ?>

                        </a>
                        <button btn="btnToggleDisabled" type="submit" id="btnAddBenOrg" class="btn btn-next btn-rose pull-right btn-sm">
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
        $(document).ready(function () {
            active_nev_link('organizations');

            $('.selectpicker').selectpicker();
            funValidateForm();
        });

        $('#formBeneficiaryOrgCreate').submit(function(e){

            e.preventDefault();
            if (!is_valid_form($(this))) {
                return false;
            }

            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                beforeSend: function () {
                   $('#btnAddBenOrg').prop("disabled", true);
                    $('.loader').show();
                },
                success: function (data) {
                    $('.loader').hide();
                    $('#btnAddBenOrg').prop("disabled", false);
                    $('#btnAddBenOrg').removeAttr("disabled");

                    if (data.success == true) {
                        $('#formBeneficiaryOrgCreate')[0].reset();                    }
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                },
                error: function (data) {

                }
            });

        });

        $(document).on('change','#org_type',function (e) {
            e.preventDefault();
            var id = $(this).val();
            if(id == 1){
                $('#members_number').val('');
                $('#members_number').prop("disabled", true);
            }else{
                $('#members_number').prop("disabled", false);

            }
        })

        $(document).on('change', '#formBeneficiaryOrgCreate #city_id', function (e) {
            e.preventDefault();
            var city_id = $(this).val();
            $url = '<?php echo e(route("beneficiary.oraganizations.getDistanceByCityId")); ?>' + '/' + city_id;

            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                    $("#district_id option").remove();
                    $("#district_id ").append("<option  style='height: 37px;' value></option>");
                    $('#district_id').selectpicker('refresh');
                },
                success: function (data) {
                    if (data != null) {
                        selectDestrice(data);
                    }

                    $('#district_id').selectpicker('refresh');
                },
                error: function () {
                }
            });
        });

        function selectDestrice(data) {
            $.each(data, function (index, value) {
                $("#district_id").append('<option value=' + index + '>' + value + '</option>');
            });
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


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>