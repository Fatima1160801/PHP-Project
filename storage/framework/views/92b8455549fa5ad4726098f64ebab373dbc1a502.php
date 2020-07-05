<?php $__env->startSection('content'); ?>


    <div class="col-md-12 col-12 mr-auto ml-auto">
        <!--      Wizard container        -->
        <div class="wizard-container">
            <div class="card card-wizard" data-color="rose" id="wizardDonors">
                <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                <div class="card-header text-center">
                    <h3 class="card-title">
                        <?php echo e($labels['donors'] ?? 'donors'); ?>

                    </h3>
                </div>
                <div class="wizard-navigation">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a id="projectLink" data-project-id="" ; class="nav-link active" href="#DonorTab"
                               data-toggle="tab"
                               role="tab">

                                <?php echo e($labels['Donor_page'] ?? 'Donor_page'); ?>


                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="goalslink" href="#contacts" data-toggle="tab" role="tab">

                                <?php echo e($labels['contacts'] ?? 'contacts'); ?>


                            </a>
                        </li>
                        <?php if($focalPoint->count()>0): ?>
                            <li class="nav-item">
                                <a class="nav-link" id="goalslink" href="#focalPoint" data-toggle="tab" role="tab">

                                    <?php echo e($labels['focal_point'] ?? 'focal_point'); ?>


                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="DonorTab">
                            <?php echo $donor; ?>

                        </div>
                        <div class="tab-pane" id="contacts">

                            <div id="contacts-content">
                                <?php echo $contacts; ?>

                            </div>

                            <div class="col-md-12">
                                <a href="#" class="btn btn-sm btn-previous btn-fill btn-default btn-wd pull-left"
                                   id="previous">
                                    <?php echo e($labels['previous'] ?? 'previous'); ?>

                                </a>
                                
                                
                                
                                <button type="submit" class="btn btn-sm btn-next btn-rose pull-right"
                                        id="nextProjectMain">
                                    <?php echo e($labels['next'] ?? 'next'); ?>


                                </button>
                            </div>
                        </div>
                        <?php if($focalPoint->count()>0): ?>
                            <div class="tab-pane" id="focalPoint">

                                <div id="contacts-content">
                                    <?php echo $focalPoint_html; ?>

                                </div>

                                <div class="col-md-12">
                                    <a href="#" class="btn btn-sm btn-previous btn-fill btn-default btn-wd pull-left"
                                       id="previous">
                                        <?php echo e($labels['previous'] ?? 'previous'); ?>

                                    </a>
                                    
                                    
                                    
                                    <button type="submit" class="btn btn-sm btn-next btn-rose pull-right"
                                            id="nextProjectMain">
                                        <?php echo e($labels['finish'] ?? 'finish'); ?>

                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- wizard container -->
    </div>

    <div class="modal fade  bd-example-modal-lg " id="modalDonorContact" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg " role="document">
            <div id="contentModal">
                <div align="center" class="col-md-12 ">
                    <div class="loader loader-div">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade  bd-example-modal-lg " id="modalDonorContactEdit" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg " role="document">
            <div id="contentModal">
                <div align="center" class="col-md-12 ">
                    <div class="loader loader-div">
                    </div>
                </div>

            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>

        $(document).ready(function () {
            funValidateForm();
            active_nev_link('donors1');
           var donor_type= $('#donor_type_id').val();
            if (typeof donor_type !== typeof undefined && donor_type !== false && donor_type !=="") {
                $('#donor_type_id').change();
            }
            wizard();
        })



        datetimepicker();
        selectpicker();

        function wizard() {
            donorsWizard.initMaterialWizard();
            setTimeout(function () {
                $('#wizardDonors').addClass('active');
            }, 600);
        }

        function selectpicker() {
            $('.selectpicker').selectpicker();

        }

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

        // <span class="bmd-help">A block of help text that breaks onto a new line.</span>


        $(document).on('change', '#donor_type_id', function () {
            $this = $(this);
            var donor_type_id = $this.val();
            if (donor_type_id != null && donor_type_id != '') {
                url = '<?php echo e(route('project.donors.types.desc')); ?>' + '/' + donor_type_id;
                $.ajax({
                    url: url,
                    type: 'get',
                    beforeSend: function () {
                        if ($("#DonorTypeDescSpan")[0]) {
                            $("#DonorTypeDescSpan").html('<div class="loader pull-left" style=""> </d>');
                        } else {
                            $this.closest('.form-group').after('<span class="" id="DonorTypeDescSpan"><div class="loader pull-left" style="">  </d</span>');
                        }
                    },
                    success: function (data) {
                        if ($("#DonorTypeDescSpan")[0]) {
                            $("#DonorTypeDescSpan").text(data.type_desc_na);
                        } else {
                            $this.closest('.form-group').after('<span class="" id="DonorTypeDescSpan">' + data.type_desc_na + '</span>');
                        }
                    },
                    error: function () {
                    }
                });

            }


        })


        /*******************form add &Edit Donor  */
        $(document).on('submit', '#formEditDonor', function (e) {

            e.preventDefault();
            if (!is_valid_form($(this))) {
                return false;
            }
            var form = new FormData($(this)[0]);
            var url = '<?php echo e(route("project.donors.store")); ?>';
            $.ajax({
                url: url,
                // dataTypes: 'json',
                data: form,
                type: 'post',
                processData: false,
                contentType: false,
                async: true,
                beforeSend: function () {
                    $('#updateDonor').prop("disabled", true);
                    $('.loader').css('display', 'block');
                },
            }).done(function (data) {
                console.log(1);
                if (data.status == 'true') {
                    $('#formEditDonor #id').val(data.donor.id);
                }
                $('#updateDonor').prop("disabled", false);
                $('.loader').css('display', 'none');
                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
            }).fail(function (data) {
                console.log(2);
                var error = data.responseJSON;
                //var errors = error.errors;
                console.log(error)
            }).always(function (data) {
                console.log(data);
            });

        })


        $(document).on('click', '#addDonorContact', function () {
            $this = $(this);
            var donor_id = $('#formEditDonor #id').val();
            url = '<?php echo e(route('project.donors.contact.create')); ?>' + '/' + donor_id;
            $.ajax({
                url: url,
                type: 'get',
                beforeSend: function () {
                    $('#modalDonorContact #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');

                },
                success: function (data) {
                    $('#modalDonorContact #contentModal').empty();
                    $('#modalDonorContact #contentModal').html(data);
                    setTimeout(function () {
                        selectpicker();
                        wizard();
                    }, 200);
                    funValidateForm();
                },
                error: function () {
                }
            });
        })


        /*******************form add Donor contacts  */
        $(document).on('submit', '#formAddDonorContact', function (e) {
            e.preventDefault();
            if (!is_valid_form($(this))) {
                return false;
            }
            var form = $(this).serialize();
            var url = '<?php echo e(route("project.donors.contact.store")); ?>';
            $.ajax({
                url: url,
                // dataTypes: 'json',
                data: form,
                type: 'post',
                beforeSend: function () {
                    $('#btnDonorContactAdd').prop("disabled", true);
                    $('.loader').css('display', 'block')
                },
                success: function (data) {

                    console.log(data)
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        // $('#projectLink').attr('data-project-id', data.project.id);
                        //     $('#formProjectMain #id').val(data.project.id);
                        $('#modalDonorContact').modal('hide')
                        $('[rel="tooltip"]').tooltip();
                    }
                    $('#btnDonorContactAdd').prop("disabled", false);
                    $('.loader').css('display', 'none')
                },
                error: function (data) {
                }
            });

        })


        /*on modal  add contact  close  */

        $(document).on('hidden.bs.modal', '#modalDonorContact', function () {
            var donor_id = window.parent.$('#formEditDonor #id').val();
            url = '<?php echo e(route("project.donors.contact.index")); ?>' + '/' + donor_id;
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#contacts-content').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#contacts-content').empty();
                    $('#contacts-content').html(data);
                    wizard()
                },
                error: function () {
                }
            });
        })


        $(document).on('click', '#EditDonorContact', function (e) {
            e.preventDefault();
            // var project_id = $('#formProjectMain #id').val();
            url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalDonorContactEdit #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    console.log(data);
                    $('#modalDonorContactEdit #contentModal').empty();
                    $('#modalDonorContactEdit #contentModal').html(data);
                    funValidateForm();

                    selectpicker();
                },
                error: function () {
                }
            });
        });


        /*******************form add Donor contacts  */
        $(document).on('submit', '#formEditDonorContact', function (e) {
            e.preventDefault();
            if (!is_valid_form($(this))) {
                return false;
            }
            var form = $(this).serialize();
            var url = '<?php echo e(route("project.donors.contact.update")); ?>';
            $.ajax({
                url: url,
                // dataTypes: 'json',
                data: form,
                type: 'put',
                beforeSend: function () {
                    $('#btnDonorContactAdd').prop("disabled", true);
                    $('.loader').css('display', 'block')
                },
                success: function (data) {
                    console.log(data)
                    if (data.status == 'true') {

                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        // $('#projectLink').attr('data-project-id', data.project.id);
                        //     $('#formProjectMain #id').val(data.project.id);
                        $('#modalDonorContactEdit').modal('hide');
                        $('[rel="tooltip"]').tooltip();
                    } else {

                    }
                    $('#btnDonorContactAdd').prop("disabled", false);
                    $('.loader').css('display', 'none')
                },
                error: function (data) {

                }
            });

        })

        /*on modal  edit contact  close  */

        $(document).on('hidden.bs.modal', '#modalDonorContactEdit', function () {
            var donor_id = window.parent.$('#formEditDonor #id').val();
            url = '<?php echo e(route("project.donors.contact.index")); ?>' + '/' + donor_id;
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#contacts-content').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#contacts-content').empty();
                    $('#contacts-content').html(data);
                    wizard()
                },
                error: function () {
                }
            });
        })
        /*///////////*****delete contact****//////////*/
        $(document).on('click', '#btnDeleteContact', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '<?php echo e($messageDeleteDonorContact['text']); ?>',
                confirmButtonClass: 'btn btn-success btn-sm',
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
                            $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                            if (data.status == 'true') {
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


    </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <!-- Forms Validations Plugin -->
    <script src="<?php echo e(asset('assets/js/plugins/jquery.validate.min.js')); ?>"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="<?php echo e(asset('assets/js/plugins/jquery.bootstrap-wizard.js')); ?>"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="<?php echo e(asset('assets/js/plugins/jasny-bootstrap.min.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/js/plugins/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-datetimepicker.min.js')); ?>"></script>


    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>

    <?php if(\Illuminate\Support\Facades\Auth::user()->lang_id ==2): ?>
        <script src="<?php echo e(asset('js/wizard-rtl.js')); ?>"></script>
    <?php else: ?>
        <script src="<?php echo e(asset('js/wizard.js')); ?>"></script>

    <?php endif; ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>