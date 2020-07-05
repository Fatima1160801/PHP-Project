<?php $__env->startSection('css'); ?>
    <style>
        .dropdown-toggle::after {
            display: none;
        }

        #result_search_actual .card-body {
            height: 350px !important;
        }

        #actual_beneficiary_list .card-body {
            height: 350px !important;
        }


    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <div class="col-md-12 col-12 mr-auto ml-auto">
        <!--      Wizard container        -->
        <?php if($realTimeRecord != null): ?>
            <div class="alert alert-info " align="center" id="alert-noti-data">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>

                <span>
                <b> Heads up! - </b>
                There are data not saved in the form, do you want to recover it ?
                    <div>
                           <button class="btn btn-success btn-sm" id="btn-recover-rtr">Yes, recover it</button>
                <button class="btn btn-danger btn-sm" id="btn-ignore-rtr">No, ignore that</button>
                    </div>

            </span>
            </div>
            <div id="project-data-json" style="display: none;"
                 data-json="<?php echo e($realTimeRecord->form_data_serialized); ?>"></div>
        <?php endif; ?>
        <div class="wizard-container">
            <div class="card card-wizard" data-color="rose" id="wizardProject">
                <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

               <div class="row">
                   <div class="col-md-4"></div>
                   <div class="card-header text-center col-md-4">
                       <h3 class="card-title text-align-center">
                           <?php echo e($labels['project'] ?? 'project'); ?>

                           <?php if(isset($project_id)): ?>
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               

                               
                               
                           <?php endif; ?>
                       </h3>

                   </div>
                   <div class="text-right col-md-4">
                       <?php if(isset($project_id)): ?>
                           <a target="_blank" href="<?php echo e(route('tasks.create',['project',$project_id])); ?>"
                              class="btn btn-default btn-sm"
                              data-toggle="tooltip" data-placement="top"
                               
                           >
                               <i class="material-icons">assignment</i>
                               <?php echo e($labels['add_task'] ?? 'add_task'); ?>

                           </a>
                       <?php endif; ?>
                   </div>

               </div>




                <div class="wizard-navigation">
                    <ul class="nav nav-pills nav-project">
                        <li class="nav-item">
                            <a id="projectLink" data-project-id="" ; class="nav-link active" href="#project"
                               data-toggle="tab"
                               role="tab">
                                <?php echo e($labels['project'] ?? 'project'); ?>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="goalslink" href="#goallls" data-toggle="tab" role="tab">
                                <?php echo e($labels['project_goals'] ?? 'project_goals'); ?>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="gtargeted_beneficiaries_link" href="#targeted_beneficiaries_tabe"
                               data-toggle="tab"
                               role="tab">
                                <?php echo e($labels['targeted_beneficiaries'] ?? 'targeted_beneficiaries'); ?>

                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="achievementlink" href="#achievement_tabe" data-toggle="tab"
                               role="tab">
                                <?php echo e($labels['achievement'] ?? 'achievement'); ?>

                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="donorslink" href="#project-donors" data-toggle="tab" role="tab">
                                <?php echo e($labels['project_donors'] ?? 'project_donors'); ?>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="stafflink" href="#project-staffs" data-toggle="tab" role="tab">
                                <?php echo e($labels['project_staff'] ?? 'project_staff'); ?>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="attachmentslink" href="#project-files" data-toggle="tab" role="tab">
                                <?php echo e($labels['attachments'] ?? 'attachments'); ?>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="attachmentshistory" href="#project-history" data-toggle="tab"
                               role="tab">
                                <?php echo e($labels['project_history'] ?? 'project_history'); ?>

                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="project">

                            <?php echo $projectmain; ?>

                        </div>
                        <div class="tab-pane" id="goallls">

                            <div id="goals-main">
                                <?php echo $goals; ?>

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
                        <div class="tab-pane" id="targeted_beneficiaries_tabe">

                            <div id="targeted-beneficiaries">
                                <?php echo $targeted_beneficiaries; ?>

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
                        <div class="tab-pane" id="achievement_tabe">

                            <div id="achievement_content">
                                <?php echo $achievement; ?>

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
                        <div class="tab-pane" id="project-donors">
                            <div id="donors-content">
                                <?php echo $donors; ?>

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
                        <div class="tab-pane" id="project-staffs">
                            <div id="staffs-content">
                                <?php echo $staffs; ?>

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
                        <div class="tab-pane" id="project-files">
                            <input type="hidden" id="object_primary_id" value="">
                            <div id="files-content"></div>

                            <div class="col-md-12">
                                <a href="#" class="btn btn-sm btn-previous btn-fill btn-default btn-wd pull-left"
                                   id="previous">
                                    <?php echo e($labels['previous'] ?? 'previous'); ?>

                                </a>
                                <a href="<?php echo e(route('project.project.index')); ?>"
                                   class="btn btn-sm  btn-fill btn-rose btn-wd pull-right" id="finish">
                                    <?php echo e($labels['finish'] ?? 'finish'); ?>

                                </a>
                            </div>

                        </div>
                        <div class="tab-pane" id="project-history">
                            <div class="table-responsive">
                                <table class="table  table-sm table-bordered table-responsive" id="history-table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Reference No</th>
                                        <th>Project Name "English"</th>
                                        <th>Project Name "Arabic"</th>
                                        <th>Plan Start Date</th>
                                        <th>Plan End Date</th>
                                        <th>Actual Start Date</th>
                                        <th>Actual End Date</th>
                                        <th>Program</th>
                                        <th>Category</th>
                                        <th>Manager</th>
                                        <th>Coordinator</th>
                                        <th>project Description "EN"</th>
                                        <th>project Description "AR"</th>
                                        <th>Plan Budget</th>
                                        <th>Actual Budget</th>
                                        <th>Currency</th>
                                        <th>Donor Percent</th>
                                        <th>Institute Percent</th>
                                        <th>Beneficieirs Percent</th>
                                        <th>Updated at</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($project_history != null): ?>
                                        <?php $__currentLoopData = $project_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($ph->reference_no); ?></td>
                                                <td><?php echo e($ph->project_name_na); ?></td>
                                                <td><?php echo e($ph->project_name_fo); ?></td>
                                                <td><?php echo e(dateFormatSite($ph->plan_start_date)); ?></td>
                                                <td><?php echo e(dateFormatSite($ph->plan_end_date)); ?></td>
                                                <td><?php echo e(dateFormatSite($ph->act_start_date)); ?></td>
                                                <td><?php echo e(dateFormatSite($ph->act_end_date)); ?></td>
                                                <td><?php echo e($ph->program ? $ph->program->{'program_name_'.lang_character()} : ""); ?></td>
                                                <td><?php echo e($ph->category ? $ph->category->{'category_name_'.lang_character1()} : ""); ?></td>
                                                <td><?php echo e($ph->manager ? $ph->manager->{'staff_name_'.lang_character()} : ""); ?></td>
                                                <td><?php echo e($ph->coordinator ? $ph->coordinator->{'staff_name_'.lang_character()} : ""); ?></td>
                                                <td><?php echo e($ph->project_desc_na); ?></td>
                                                <td><?php echo e($ph->project_desc_fo); ?></td>
                                                <td><?php echo e($ph->plan_budget); ?></td>
                                                <td><?php echo e($ph->act_budget); ?></td>
                                                <td><?php echo e($ph->currency ? $ph->currency->currency_name_na : ""); ?>

                                                    [<?php echo e($ph->currency ?  $ph->currency->currency_symbol : ""); ?>]
                                                </td>
                                                <td><?php echo e($ph->donors_percent); ?> %</td>
                                                <td><?php echo e($ph->institute_percent); ?>%</td>
                                                <td><?php echo e($ph->beneficieirs_percent); ?>%</td>
                                                <td><?php echo e(dateFormatSite($ph->updated_at)); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- wizard container -->
    </div>




    <div class="modal fade   bd-example-modal-lg  " id="modalResultsChainCreateOverall" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg " role="document">
            <div id="contentModal">


            </div>
        </div>
    </div>

    <div class="modal fade  bd-example-modal-lg " id="modalEditResultChainOverall" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg " role="document">
            <div id="contentModal">

            </div>
        </div>
    </div>

    <div class="modal fade   bd-example-modal-lg  " id="modalAddResultChainSpecific" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg " role="document">
            <div id="contentModal">


            </div>
        </div>
    </div>

    <div class="modal fade  bd-example-modal-lg " id="modalEditResultChainSpecific" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg " role="document">
            <div id="contentModal">

            </div>
        </div>
    </div>

    <div class="modal fade  bd-example-modal-lg " id="modalAddResultChainResult" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg " role="document">
            <div id="contentModal">

            </div>
        </div>
    </div>

    <div class="modal fade  bd-example-modal-lg " id="modalEditResultChainResult" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg " role="document">
            <div id="contentModal">

            </div>
        </div>
    </div>

    <div class="modal fade  bd-example-modal-lg " id="modalAddResultChainActivity" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg " role="document">
            <div id="contentModal">

            </div>
        </div>
    </div>

    <div class="modal fade  bd-example-modal-lg " id="modalEditResultChainActivity" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg " role="document">
            <div id="contentModal">

            </div>
        </div>
    </div>

    <div class="modal fade   bd-example-modal-lg " id="modalGoalAddSub" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg " role="document">
            <div id="contentModal">

            </div>
        </div>
    </div>
    <div class="modal fade  bd-example-modal-lg " id="modalIndicatorResult" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg " role="document">
            <div id="contentModal">

            </div>
        </div>
    </div>

    <div class="modal fade  bd-example-modal-lg" id="modalDonors" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg" role="document">
            <div id="contentModal"></div>
        </div>
    </div>
    <div class="modal fade  bd-example-modal-lg" id="modalStaff" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg" role="document">
            <div id="contentModal"></div>
        </div>
    </div>

    <div class="modal fade  bd-example-modal-lg" id="modalValueResult" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg" role="document">
            <div id="contentModal"></div>
        </div>
    </div>

    <div class="modal fade  bd-example-modal-lg" id="modalresultCreateIndicator" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg" role="document">
            <div id="contentModal"></div>
        </div>
    </div>

    <div class="modal fade  bd-example-modal-lg" id="modalresultEditIndicator" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg" role="document">
            <div id="contentModal"></div>
        </div>
    </div>

    <div class="modal fade  bd-example-modal-lg" id="modalTargetedBeneficiaries" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg" role="document">
            <div id="contentModal"></div>
        </div>
    </div>



    <div class="modal fade  bd-example-modal-lg" id="modalActually_beneficiaries" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg" role="document">
            <div id="contentModal"></div>
        </div>
    </div>

    <div class="modal fade  bd-example-modal-lg" id="modalAddAchievement" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg" role="document">
            <div id="contentModal"></div>
        </div>
    </div>
    <div class="modal fade  bd-example-modal-lg" id="modalresultEditActivity" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg" role="document">
            <div id="contentModal"></div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>


        $(document).ready(function () {
            active_nev_link('project-index')

            $('#plan_start_date').datetimepicker({
                format: 'DD/MM/YYYY',

            });
            $('#plan_end_date').datetimepicker({

                  format: 'DD/MM/YYYY'
            });

            $("#plan_start_date").on("dp.change", function (e) {
                $('#plan_end_date').data("DateTimePicker").minDate(e.date);
            });

            funValidateForm();
            setTimeout(function () {
                openTabe();
            }, 300)



        });

        function project_files(){
            var primary_id = '<?php echo e($primary_id); ?>';
            if (primary_id == 0) {
                primary_id = $('#object_primary_id').val();
            }
            var get_attachments_url = '<?php echo e(route('attachments.get_by_activity',['activity_type' => $activity_type])); ?>' + '/' + primary_id;
            $.get(get_attachments_url, function (response) {
                $('#files-content').html(response);
                $('#attachments-table').DataTable({
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records"
                    }
                });
                $('[data-toggle="tooltip"]').tooltip();
            });
        }
        $('a[href="#project-files"]').click(function () {
        //  project_files();
        });


        function openTabe() {
            var pageURL = window.location.href;
            var lastURLSegment = pageURL.substr(pageURL.lastIndexOf('#') + 1);
            if (pageURL != lastURLSegment) {
                if (lastURLSegment.length > 0) {

                    $('#' + lastURLSegment).click();
                }
            }
        }

        wizard();
        datetimepicker();
        selectpicker();

        function wizard() {
            projectWizard.initMaterialWizard();
            setTimeout(function () {
                $('#wizardProject').addClass('active');
            }, 20);
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
                format: 'DD/MM/YYYY',

            });
        }


        DataTableCall('#history-table', 20);
        /*******************project min add */
        // var $validator = $('#formProjectMain').validate({
        //     errorPlacement: function(error, element) {
        //
        //         if(element.hasClass('selectpicker')){
        //             $(element).parent().append(error);
        //         }else{
        //             $(element).after(error);
        //         }
        //
        //
        //     },
        //     highlight: function(element, errorClass, validClass) {
        //         if($(element).hasClass('selectpicker')) {
        //             $(element).parent().addClass(errorClass).removeClass(validClass);
        //         }
        //         $(element).addClass(errorClass).removeClass(validClass);
        //     },
        //     unhighlight: function(element, errorClass, validClass) {
        //         if($(element).hasClass('selectpicker')) {
        //             $(element).parent().removeClass(errorClass).addClass(validClass);
        //
        //         }
        //         $(element).removeClass(errorClass).addClass(validClass);
        //     }
        // });


        $(document).on('submit', '#formProjectMain', function (e) {
            e.preventDefault();

            if (!is_valid_form($(this))) {
                return false;
            }

            var form = $(this).serialize();
            var url = '<?php echo e(route("project.project.storeprojectmain")); ?>';
            $.ajax({
                url: url,
                // dataTypes: 'json',
                data: form,
                type: 'post',
                beforeSend: function () {

                    $('#saveProjectMain').prop("disabled", true);
                    $('.loader').css('display', 'block')

                },
                success: function (data) {

                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#projectLink').attr('data-project-id', data.project.id);
                        $('#formProjectMain #id').val(data.project.id);
                        $('#object_primary_id').val(data.project.id);
                        $('#saveProjectMain').prop("disabled", false);
                        $('.loader').attr("disabled", 'false');
                    } else if (data.status == 'false') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                    }
                    $('#saveProjectMain').prop("disabled", false);
                    $('.loader').css('display', 'none')


                },
                error: function (data) {

                }
            });

        })


        /********** goals ************************************/
        /*open modal  create main goals ResultsChainCreateOverall***/
        $(document).on('click', '#ResultsChainCreateOverall', function (e) {
            e.preventDefault();
            var project_id = $('#formProjectMain #id').val();
            url = '<?php echo e(route("project.results.chain.createOverall")); ?>' + '/' + project_id;
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalResultsChainCreateOverall #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalResultsChainCreateOverall #contentModal').html();
                    $('#modalResultsChainCreateOverall #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        $('#modalResultsChainCreateOverall').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });


        function wizardIndicators() {
            indicatorsWizard.initMaterialWizard();
            setTimeout(function () {
                $('#wizardIndicators').addClass('active');
            }, 100);
        }


        /* store main goal project  */
        $(document).on('submit', '#formStoreOverall', function (e) {
            e.preventDefault();
            if (!is_valid_form($(this))) {
                return false;
            }

            var data = $(this).serialize();
            var url = '<?php echo e(route("project.results.chain.storeOverall")); ?>';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                    $('#storeResult').prop("disabled", true);
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();


                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });


        /*open modal  edit EditResultChain Overall  ***/
        $(document).on('click', '#EditResultChainOverall', function (e) {
            e.preventDefault();
            url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalEditResultChainOverall #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalEditResultChainOverall #contentModal').empty();
                    $('#modalEditResultChainOverall #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });
        /* Update main  EditResultChain  Overall  */
        $(document).on('submit', '#formEditResultChainOverall', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = '<?php echo e(route("project.results.chain.update")); ?>';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'put',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                    $('#storeResult').prop("disabled", true);
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();
                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });


        $result_load_level_type = 0;
        /*open modal  add Result Chain Specific  ***/
        $(document).on('click', '#AddResultChainSpecific', function (e) {
            e.preventDefault();
            $result_load_level_type = 2;
            var url_ = $(this).attr('href');
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalAddResultChainSpecific #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalAddResultChainSpecific #contentModal').empty();
                    $('#modalAddResultChainSpecific #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });
        $(document).on('submit', '#formStoreSpecific', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = '<?php echo e(route("project.results.chain.storeSpecific")); ?>';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();
                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });
        /*open modal  edit Result Chain Specific  ***/
        $(document).on('click', '#EditResultChainSpecific', function (e) {
            e.preventDefault();
            $result_load_level_type = 2;

            var url_ = $(this).attr('href');
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalEditResultChainSpecific #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalEditResultChainSpecific #contentModal').empty();
                    $('#modalEditResultChainSpecific #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });
        $(document).on('submit', '#formEditResultChainSpecific', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = '<?php echo e(route("project.results.chain.updateSpecific")); ?>';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'put',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();

                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });

        $(document).on('click', '#DeletedResultChainSpecific', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                text: '<?php echo e($btnDeleteLeveL['text']); ?>',
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    var url_ = $(this).attr('href');
                    $.ajax({
                        url: url_,
                        type: 'delete',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == true) {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
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


        /*open modal    add Result Chain result  ***/
        $(document).on('click', '#AddResultChainResult', function (e) {
            e.preventDefault();
            var url_ = $(this).attr('href');
            $result_load_level_type = 3;

            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalAddResultChainResult #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalAddResultChainResult #contentModal').empty();
                    $('#modalAddResultChainResult #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });
        $(document).on('submit', '#formStoreResult', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = '<?php echo e(route("project.results.chain.storeResult")); ?>';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();

                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });

        /*open modal    edit Result Chain result  ***/

        $(document).on('click', '#EditResultChainResult', function (e) {
            e.preventDefault();
            $result_load_level_type = 3;
            var url_ = $(this).attr('href');
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalEditResultChainResult #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalEditResultChainResult #contentModal').empty();
                    $('#modalEditResultChainResult #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });
        $(document).on('submit', '#formEditResultChainResult', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = '<?php echo e(route("project.results.chain.updateResult")); ?>';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'put',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();

                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });
        $(document).on('click', '#btnDeleteResultChainResult', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                text: '<?php echo e($btnDeleteLeveL['text']); ?>',
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    var url_ = $(this).attr('href');
                    $.ajax({
                        url: url_,
                        type: 'delete',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == true) {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
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

        //add indicator to level 1 //

        $(document).on('click', '#LevelICreateIndicator', function (e) {
            e.preventDefault();
            var url_ = $(this).attr('href');
            $result_load_level_type = 1;
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalresultCreateIndicator #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalresultCreateIndicator #contentModal').empty();
                    $('#modalresultCreateIndicator #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });

        });
        $(document).on('submit', '#formLevelStoreIndicator', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();
                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    //  $('.loader').css('display', 'none');
                    //  $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });//add indicator to level 1 //

        //edit indicator to level 1 //

        $(document).on('click', '#LevelEditIndicator', function (e) {
            e.preventDefault();
            var url_ = $(this).attr('href');
            $result_load_level_type = 1;
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalresultEditIndicator #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalresultEditIndicator #contentModal').empty();
                    $('#modalresultEditIndicator #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
            console.log($result_load_level_type)
        });
        $(document).on('submit', '#formLevelUpdateIndicator', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();

                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });

        $(document).on('click', '#btnDeleteLevel_I_Indicator', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                text: '<?php echo e($btnDeleteIndicator['text']); ?>',
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    var url_ = $(this).attr('href');
                    $.ajax({
                        url: url_,
                        type: 'delete',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == true) {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
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



        //add indicator to level 2 //
        $(document).on('click', '#LevelIICreateIndicator', function (e) {
            e.preventDefault();
            var url_ = $(this).attr('href');
            $result_load_level_type = 2;
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalresultCreateIndicator #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalresultCreateIndicator #contentModal').empty();
                    $('#modalresultCreateIndicator #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });
        $(document).on('submit', '#formLevelIIStoreIndicator', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();
                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    //  $('.loader').css('display', 'none');
                    //  $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });//add indicator to level 2 //

        //edit indicator to level 2 //

        $(document).on('click', '#LevelIIEditIndicator', function (e) {
            e.preventDefault();
            var url_ = $(this).attr('href');
            $result_load_level_type = 2;
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalresultEditIndicator #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalresultEditIndicator #contentModal').empty();
                    $('#modalresultEditIndicator #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });
        $(document).on('submit', '#formLevelIIUpdateIndicator', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();

                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });
        $(document).on('click', '#btnDeleteLevel_II_Indicator', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                text: '<?php echo e($btnDeleteIndicator['text']); ?>',
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    var url_ = $(this).attr('href');
                    $.ajax({
                        url: url_,
                        type: 'delete',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == true) {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
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


        //add indicator to level 3 //

        $(document).on('click', '#resultCreateIndicator', function (e) {
            e.preventDefault();
            var url_ = $(this).attr('href');
            $result_load_level_type = 3;
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalresultCreateIndicator #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalresultCreateIndicator #contentModal').empty();
                    $('#modalresultCreateIndicator #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });
        $(document).on('submit', '#formResultsStoreIndicator', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = '<?php echo e(route("project.results.chain.resultsStoreIndicator")); ?>';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();

                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });//add indicator to level 3 //
        //edit indicator to level 3 //

        $(document).on('click', '#resultEditIndicator', function (e) {
            e.preventDefault();
            var url_ = $(this).attr('href');
            $result_load_level_type = 3;
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalresultEditIndicator #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalresultEditIndicator #contentModal').empty();
                    $('#modalresultEditIndicator #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });
        $(document).on('submit', '#formResultUpdateIndicator', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = '<?php echo e(route("project.results.chain.resultUpdateIndicator")); ?>';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();

                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });

         $(document).on('click', '#btnDeleteLevel_III_Indicator', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                text: '<?php echo e($btnDeleteIndicator['text']); ?>',
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    var url_ = $(this).attr('href');
                    $.ajax({
                        url: url_,
                        type: 'delete',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == true) {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
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



        /*open modal    add Result Chain activity  ***/
        $(document).on('click', '#AddResultChainActivity', function (e) {
            e.preventDefault();
            $result_load_level_type = 4;

            var url_ = $(this).attr('href');
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalAddResultChainActivity #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalAddResultChainActivity #contentModal').empty();
                    $('#modalAddResultChainActivity #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });
        $(document).on('submit', '#formStoreActivity', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = '<?php echo e(route("project.results.chain.storeActivity")); ?>';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();


                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });

        /*open modal    edit Result Chain activity  ***/
        $(document).on('click', '#resultEditActivity', function (e) {
            $result_load_level_type = 4;
            e.preventDefault();
            var url_ = $(this).attr('href');
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalresultEditActivity #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalresultEditActivity #contentModal').empty();
                    $('#modalresultEditActivity #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                      //  $('#modalresultEditActivity #contentModal').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });
        $(document).on('submit', '#formEditResultChainActivity', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = '<?php echo e(route("project.results.chain.updateActivity")); ?>';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'put',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();


                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });


        /*open modal    edit Result Chain activity  ***/

        $(document).on('click', '#EditResultChainActivity', function (e) {
            e.preventDefault();
            $result_load_level_type = 4;

            var url_ = $(this).attr('href');
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalEditResultChainActivity #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalEditResultChainActivity #contentModal').empty();
                    $('#modalEditResultChainActivity #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });
        $(document).on('submit', '#formEditResultChainActivity', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = '<?php echo e(route("project.results.chain.updateActivity")); ?>';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'put',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();


                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });


        $(document).on('change', '#formStoreActivity #level_type_id', function (e) {
            e.preventDefault();
            $level_type_id = $(this).val();
            $project_id = $('#formStoreActivity  #project_id').val();
            $("#formStoreActivity #level_id option").remove();
            $('#formStoreActivity #level_id').selectpicker('refresh');
            $("#formStoreActivity #level_id").append("<option  style='height: 37px;' value></option>");
            $('#formStoreActivity #level_id').selectpicker('refresh');
            $url = '<?php echo e(route('project.results.chain.levels')); ?>' + '/' + $level_type_id + '/' + $project_id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                    $('#formStoreActivity #level_id').val('');
                    $('#formStoreActivity #level_id').selectpicker('refresh');
                },
                success: function (data) {
                    if (data.levels != null) {
                        selectLevel(data['levels']);

                    }
                },
                error: function () {
                }
            });


        })

        function selectLevel(data) {
            $.each(data, function (index, value) {
                $("#formStoreActivity #level_id").append('<option value=' + index + '>' + value + '</option>');
            });
            $('#formStoreActivity #level_id').selectpicker('refresh');

        }

        $(document).on('change', '#formEditResultChainActivity #level_type_id', function (e) {
            e.preventDefault();
            $level_type_id = $(this).val();
            $project_id = $('#formEditResultChainActivity  #project_id').val();
            $("#formEditResultChainActivity #level_id option").remove();
            $('#formEditResultChainActivity #level_id').selectpicker('refresh');
            $("#formEditResultChainActivity #level_id").append("<option  style='height: 37px;' value></option>");
            $('#formEditResultChainActivity #level_id').selectpicker('refresh');
            $url = '<?php echo e(route('project.results.chain.levels')); ?>' + '/' + $level_type_id + '/' + $project_id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                    $('#formEditResultChainActivity #level_id').val('');
                    $('#formEditResultChainActivity #level_id').selectpicker('refresh');
                },
                success: function (data) {
                    if (data.levels != null) {
                        formEditResultChainActivityselectLevel(data['levels']);

                    }
                },
                error: function () {
                }
            });


        })

        function formEditResultChainActivityselectLevel(data) {
            $.each(data, function (index, value) {
                $("#formEditResultChainActivity #level_id").append('<option value=' + index + '>' + value + '</option>');
            });
            $('#formEditResultChainActivity #level_id').selectpicker('refresh');

        }


        /* on modal create main goals project close and edit*/

        $(document).on('hidden.bs.modal', '#modalresultEditIndicator,#modalresultCreateIndicator,#modalEditResultChainActivity,#modalAddResultChainActivity  ,#modalResultsChainCreateOverall ,#modalEditResultChainOverall ,#modalAddResultChainSpecific ,#modalEditResultChainSpecific ,#modalAddResultChainResult ,#modalEditResultChainResult ,#modalresultEditActivity', function () {

            $('#goals-main').empty();
            project_id = window.parent.$('#formProjectMain #id').val();
            project_id =  $('#formProjectMain #id').val();
            console.log($result_load_level_type, project_id)
            var url_ = '<?php echo e(route("project.resultsChain.goalIndex")); ?>' + '/' + project_id;
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#goals-main').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#goals-main').empty();
                    $('#goals-main').html(data.html.html);
                    wizard()

                    changeActive($result_load_level_type);
                    $('[rel="tooltip"]').tooltip();
                },
                error: function () {

                }
            });

        });

        function changeActive(id) {
            if (id == 2) {
                $('[href="#level2"]').click();
            } else if (id == 3) {
                $('[href="#level3"]').click();

            } else if (id == 4) {
                $('[href="#level4"]').click();

            }
            $result_load_level_type = 0;

        }


        /*     modalTargetedBeneficiaries */

        $(document).on('click', '#addTargetedBeneficiaries', function (e) {
            e.preventDefault();
            var project_id = window.parent.$('#formProjectMain #id').val();

            var url_ = $(this).attr('href') + '/' + project_id;
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalTargetedBeneficiaries #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalTargetedBeneficiaries #contentModal').empty();
                    $('#modalTargetedBeneficiaries #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        datetimepicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });
        $(document).on('submit', '#formTargetedBeneficiaries', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url_ = '<?php echo e(route("project.project.targetedBeneficiaries.store")); ?>';
            $.ajax({
                url: url_,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();


                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });
        $(document).on('click', '#editTargetedBeneficiaries', function (e) {
            e.preventDefault();
            var url_ = $(this).attr('href');
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalTargetedBeneficiaries #contentModal').empty();
                    $('#modalTargetedBeneficiaries #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalTargetedBeneficiaries #contentModal').empty();
                    $('#modalTargetedBeneficiaries #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        datetimepicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });
        $(document).on('submit', '#formEditTargetedBeneficiaries', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url_ = '<?php echo e(route("project.project.targetedBeneficiaries.update")); ?>';
            $.ajax({
                url: url_,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();


                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });
        $(document).on('hidden.bs.modal', '#modalTargetedBeneficiaries', function () {
            var project_id = window.parent.$('#formProjectMain #id').val();
            var url_ = '<?php echo e(route("project.project.targetedBeneficiaries.index")); ?>' + '/' + project_id;
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#targeted-beneficiaries').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#targeted-beneficiaries').empty();
                    $('#targeted-beneficiaries').html(data.html);
                    wizard();
                    $('[rel="tooltip"]').tooltip();
                },
                error: function () {

                }
            });

        });
        $(document).on('click', '#btnDeleteTargetedBeneficiaries', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                text: '<?php echo e($btnDeleteTargetedBeneficiaries['text']); ?>',
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    var url_ = $(this).attr('href');
                    $.ajax({
                        url: url_,
                        type: 'delete',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == 'true') {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            } else if(data.status == 'false') {
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            }else {
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            }
                        },
                        error: function () {
                        }
                    });
                }
            })
        });


        $(document).on('click', '#actually_beneficiaries', function (e) {
            e.preventDefault();
            var url_ = $(this).attr('href');
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalActually_beneficiaries #contentModal').empty();
                    $('#modalActually_beneficiaries #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalActually_beneficiaries #contentModal').empty();
                    $('#modalActually_beneficiaries #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        datetimepicker();
                        $('#modalActually_beneficiaries .card-body').perfectScrollbar();
                        $('#actual_beneficiary_list .card-body').perfectScrollbar();

                    }, 200);
                },
                error: function () {
                }
            });
        });
        $(document).on('submit', '#formSearchActualBeneficiary', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url_ = $(this).attr('action');
            ;
            $.ajax({
                url: url_,
                dataTypes: 'html',
                data: data,
                type: 'get',
                beforeSend: function () {
                    $('#result_search_actual .card-body').empty()
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status) {
                        $('#addActualBeneficiarySelected').removeAttr('hidden');
                        $('#result_search_actual .card-body').html(data.html)
                        $('#result_search_actual .card-body').perfectScrollbar();

                        $('.loader').css('display', 'none');
                    }
                },
                error: function () {
                }
            })
        });
        $(document).on('click', '#addActualBeneficiarySelected', function (e) {
            e.preventDefault();

            var ActualBene_id = [];
            $("input:checkbox[name='id_type[]']:checked").each(function () {
                ActualBene_id.push($(this).val());
            });

            var targeted_beneficiaries_id = $('[name="targeted_beneficiaries_id"]').val();
            var data = 'actualBene_id=' + ActualBene_id + '&targeted_beneficiaries_id=' + targeted_beneficiaries_id;
            var url_ = '<?php echo e(route('project.project.targetedBeneficiaries.addActualBeneficiarySelected')); ?>';

            $.ajax({
                url: url_,
                dataTypes: 'json',
                data: data,
                type: 'get',
                beforeSend: function () {
                    $('#addActualBeneficiarySelected .loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == true) {
                        $('#addActualBeneficiarySelected').attr('hidden','hidden');
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#result_search_actual .card-body').empty()
                        $('#result_search_actual .card-body').perfectScrollbar();
                        $('#addActualBeneficiarySelected .loader').css('display', 'none');
                        $('#actual_beneficiary_list .card-body').empty();
                        $('#actual_beneficiary_list .card-body').html(data.html);
                        $('#actual_beneficiary_list .card-body').perfectScrollbar();

                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#addActualBeneficiarySelected .loader').css('display', 'none');

                    }
                },
                error: function () {
                }
            })
        });
        $(document).on('click', '.actually_beneficiaries_destroy', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                text: '<?php echo e($btnDeleteActualTargetedBeneficiaries['text']); ?>',
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    var url_ = $(this).attr('href');
                    $.ajax({
                        url: url_,
                        type: 'delete',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == 'true') {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
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


        /*     project achievement */

        $(document).on('click', '#addAchievement', function (e) {
            e.preventDefault();
            var project_id = window.parent.$('#formProjectMain #id').val();
            var url_ = $(this).attr('href');
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalAddAchievement #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalAddAchievement #contentModal').empty();
                    $('#modalAddAchievement #contentModal').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        datetimepicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                        $('#level_type_id').prop( "disabled", true );
                        $('#level_id').prop( "disabled", true );
                        $('#indicator_id').prop( "disabled", true );
                    }, 200);
                },
                error: function () {
                }
            });
        });
        
            
            
            
            
            
            
                
                
                
                
                
                    
                    

                    
                    

                   
                
                    
                        
                    
                
                
                
            
        

        
            
            
                
            
            
        

        
            

            
            
            
                
                
                
                
                
                    
                    
                
                
                    
                
                
                
            
        
        
            

            
            
            
                
                
                
                

                
                    
                    
                
                
                    
                    
                    
                    
                        
                        
                        
                    
                


            
        


        
            
            
                
            
            
        

        $(document).on('submit', '#formAchievement', function (e) {
            e.preventDefault();
            var data = $(this).serialize()+"&level_type_id="+$("#formAchievement #level_type_id").val()+"&level_id="+$("#formAchievement #level_id").val()+"&indicator_id="+$("#formAchievement #indicator_id").val();
            var url_ = '<?php echo e(route("project.project.achievement.store")); ?>';
            $.ajax({
                url: url_,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();


                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });
        $(document).on('click', '#editAchievement', function (e) {
            e.preventDefault();
            var url_ = $(this).attr('href');
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalAddAchievement #contentModal ').empty();
                    $('#modalAddAchievement #contentModal  ').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalAddAchievement #contentModal ').empty();
                    $('#modalAddAchievement #contentModal  ').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        datetimepicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });
        $(document).on('change', '#formEditAchievement #level_type_id', function (e) {
            e.preventDefault();
            var data = $('#formEditAchievement').serialize();
            var url = '<?php echo e(route("project.project.achievement.onChangeType")); ?>';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('#modalAddAchievement #contentModal #formbyType').empty();
                    $('#modalAddAchievement #contentModal #formbyindicator').empty();
                    $('#modalAddAchievement #contentModal #formbyType').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalAddAchievement #contentModal #formbyType').empty();
                    $('#modalAddAchievement #contentModal #formbyType').html(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        datetimepicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });
        $(document).on('change', '#formEditAchievement #level_id', function (e) {
            e.preventDefault();

            var data = "level_type_id=" + $('#formEditAchievement #level_type_id').val() + '&project_id=' + $('#formEditAchievement #project_id').val() + '&level_id=' + $('#formEditAchievement #level_id').val();
            var url = '<?php echo e(route("project.project.achievement.getIndicatorByLevel")); ?>';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('#modalAddAchievement #contentModal #formbyindicator').empty();
                    $('#formEditAchievement #indicator_id option').remove();
                    $('#formEditAchievement #indicator_id option').selectpicker('refresh');
                },
                success: function (data) {
                    selectAchievementIndicator_edit(data);
                },
                error: function () {
                }
            });
        });
        $(document).on('change', '#formEditAchievement #indicator_id', function (e) {
            e.preventDefault();

            var data = "level_type_id=" + $('#formEditAchievement #level_type_id').val() + '&project_id=' + $('#formEditAchievement #project_id').val() + '&level_id=' + $('#formEditAchievement #level_id').val() + '&indicator_id=' + $('#formEditAchievement #indicator_id').val();
            var url = '<?php echo e(route("project.project.achievement.indicatorChangeCreate")); ?>';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',

                beforeSend: function () {
                    $('#modalAddAchievement #contentModal #formbyindicator').empty();
                    $('#modalAddAchievement #contentModal #formbyindicator').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalAddAchievement #contentModal #formbyindicator').empty();
                    $('#modalAddAchievement #contentModal #formbyindicator').append(data.html);
                    funValidateForm();
                    setTimeout(function () {
                        selectpicker();
                        datetimepicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },


            });
        })

        function selectAchievementIndicator_edit(data) {
            $("#formEditAchievement #indicator_id").append('<option value=""></option>');
            $.each(data, function (index, value) {
                $("#formEditAchievement #indicator_id").append('<option value=' + index + '>' + value + '</option>');
            });
            $('#formEditAchievement #indicator_id').selectpicker('refresh');
        }


        $(document).on('submit', '#formEditAchievement', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url_ = '<?php echo e(route("project.project.achievement.update")); ?>';
            $.ajax({
                url: url_,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();


                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });
        $(document).on('hidden.bs.modal', '#modalAddAchievement', function () {
            var project_id = window.parent.$('#formProjectMain #id').val();
            var url_ = '<?php echo e(route("project.project.achievement.index")); ?>' + '/' + project_id;
            $.ajax({
                url: url_,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#achievement_content').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#achievement_content').empty();
                    $('#achievement_content').html(data.html);
                    wizard();
                    $('[rel="tooltip"]').tooltip();
                },
                error: function () {

                }
            });

        });
        $(document).on('click', '#btnDeleteAchievement', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                text: '<?php echo e($btnDeleteAchievement['text']); ?>',
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    var url_ = $(this).attr('href');
                    $.ajax({
                        url: url_,
                        type: 'delete',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == 'true') {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
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

        /*   formAchievement
           addAchievement
           modalAddAchievement
   */
        /*  sub goals project create addProjectGoal*/
        $(document).on('click', '#addProjectGoalSub', function (e) {
            e.preventDefault();
            url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalGoalAddSub #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalGoalAddSub #contentModal').html();
                    $('#modalGoalAddSub #contentModal').html(data.html);

                    setTimeout(function () {
                        selectpicker();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                    }, 200);
                },
                error: function () {
                }
            });
        });
        /*  sub goals project store */
        $(document).on('submit', '#formGoalsSubAdd', function (e) {
            e.preventDefault();
            data = $(this).serialize();
            var url = '<?php echo e(route("project.goals.sub.store")); ?>';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                    $('#storeResult').prop("disabled", true);
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();

                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#storeResult').prop("disabled", false);
                },
                error: function () {
                }
            })
        });

        /* delete project goals*/
        $(document).on('click', '#btnProjectGoalsDelete', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '<?php echo e($btnProjectGoalsDelete['text']); ?>',
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
                            if (data.status == 'true') {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
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


        //  index Indicator && Result

        $(document).on('click', '#indexIndicatorResult', function (e) {
            e.preventDefault();
            url = '<?php echo e(route('project.goals.indicators.index')); ?>';
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalIndicatorResult #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalIndicatorResult #contentModal').html();
                    $('#modalIndicatorResult #contentModal').html(data);
                    getIndicatorForm();
                    setTimeout(function () {
                        wizardIndicators();
                        $('#wizardGoalStyle .card-body').perfectScrollbar();
                        $('[rel="tooltip"]').tooltip();
                    }, 200);
                },
                error: function () {
                }
            });
        });

        function getIndicatorForm() {
            var project_id = $('#formProjectMain #id').val();
            url = '<?php echo e(route('project.goals.indicators.create')); ?>' + '/' + project_id;
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalIndicatorResult  #add-indicator-tap-pane  #IndicatorContent').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalIndicatorResult #add-indicator-tap-pane  #IndicatorContent').empty();
                    $('#modalIndicatorResult #add-indicator-tap-pane #IndicatorContent').html(data);
                },
                error: function () {
                }
            });
        }


        /* store  indicator ,, check contains result before uncheck  */
        $(document).on('change', '#formIndicatorAdd [type="checkbox"]', function (e) {
            e.preventDefault();
            $this = $(this);
            $indic_id = $(this).val();
            var checkValue = $(this).is(':checked');
            if (checkValue == false) {
                $this.prop("checked", true);
                var project_id = $('#formProjectMain #id').val();
                var indicatore_id = $(this).val();
                url = '<?php echo e(route('project.goals.indicators.checkchildresult')); ?>' + '/' + project_id + '/' + indicatore_id;
                $.ajax({
                    url: url,
                    dataTypes: 'json',
                    type: 'get',
                    beforeSend: function () {
                    },
                    success: function (data) {
                        if (data.status == 'true') {
                            swal(
                                {
                                    cancelButtonClass: 'btn btn-danger  btn-sm',
                                    confirmButtonClass: 'btn btn-success  btn-sm',
                                    text: data.message.text,
                                    showCancelButton: true,
                                    buttonsStyling: false,

                                }).then(result => {
                                if (result) {
                                    $this.prop("checked", false);
                                    /************************** delete indicator on un check to checkbox ************************/

                                    data = 'indic_id=' + $indic_id + '&project_id=' + window.parent.$('#formProjectMain #id').val();
                                    var url = '<?php echo e(route("project.goal.indicators.delete")); ?>';
                                    $.ajax({
                                        url: url,
                                        dataTypes: 'json',
                                        data: data,
                                        type: 'post',
                                        beforeSend: function () {
                                        },
                                        success: function (data) {
                                            if (data.status == 'true') {
                                                // myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);


                                            }
                                        },
                                        error: function () {
                                        }
                                    })
                                }
                            }).catch(swal.noop);
                        } else {
                            $this.prop("checked", false);
                            /************************** delete indicator on un check to checkbox ************************/

                            data = 'indic_id=' + $indic_id + '&project_id=' + window.parent.$('#formProjectMain #id').val();
                            var url = '<?php echo e(route("project.goal.indicators.delete")); ?>';
                            $.ajax({
                                url: url,
                                dataTypes: 'json',
                                data: data,
                                type: 'post',
                                beforeSend: function () {
                                },
                                success: function (data) {
                                    if (data.status == 'true') {
                                        // myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);


                                    }
                                },
                                error: function () {
                                }
                            })
                        }
                    }, error: function () {
                    }
                });
            } else {
                /******** store indicator on check to checkbox********/
                var indic_id = $this.val();
                var projectGoalId = $(this).attr('projectGoalId');

                data = 'indic_id=' + indic_id + '&projectGoalId=' + projectGoalId + '&project_id=' + window.parent.$('#formProjectMain #id').val();
                var url = '<?php echo e(route("project.goals.indicators.store")); ?>';
                $.ajax({
                    url: url,
                    dataTypes: 'json',
                    data: data,
                    type: 'post',
                    beforeSend: function () {
                    },
                    success: function (data) {
                        if (data.status == 'true') {
                            // myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);


                        }
                    },
                    error: function () {
                    }
                })
            }
            $('[rel="tooltip"]').tooltip();
        });


        //check Are there indicators? project.goals.indicator
        $(document).on('click', ' #add-indicator-btn  ', function (e) {
            $this = $(this);
            var project_id = $('#formProjectMain #id').val();
            url = '<?php echo e(route('project.goals.indicator')); ?>' + '/' + project_id;
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'JSON',
                beforeSend: function () {
                }, success: function (data) {

                    $("input[name=tab1_flag]").val('0');
                    if (data == 'true') {
                        $("input[name=tab1_flag]").val('1');
                        $('[href="#add-indicator-tap-pane"]').click();
                        $("input[name=tab1_flag]").val('0');
                        getIndicatorForm();

                    } else {
                        e.preventDefault();
                        $($this).removeClass('btn-next');
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                }, error: function () {
                }
            });
        });

        $(document).on('click', '#previous-goal-tab', function () {
            $("input[name=tab1_back_goal]").val('1');
            $('[href="#add-goals-tap-pane"]').click();
            $("input[name=tab1_back_goal]").val('0');
        });




        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        


        /* store  result check   */
        $(document).on('change', '#formResultAdd [type="checkbox"]', function (e) {
            e.preventDefault();
            $this = $(this);
            $result_id = $(this).val();
            $projectGoalId = $(this).attr('projectGoalId');
            $projectIndicId = $(this).attr('projectIndicId');
            var checkValue = $(this).is(':checked');
            if (checkValue == false) {

                /******delete result********/
                data = 'result_id=' + $result_id + '&project_id=' + window.parent.$('#formProjectMain #id').val();
                var url = '<?php echo e(route("project.goals.result.delete")); ?>';
                $.ajax({
                    url: url,
                    dataTypes: 'json',
                    data: data,
                    type: 'post',
                    beforeSend: function () {
                    },
                    success: function (data) {
                        if (data.status == 'true') {
                            $this.prop("checked", false);
                            // myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        }
                    },
                    error: function () {
                    }
                })
            } else {
                /******** store result on check to checkbox********/

                data = 'projectGoalId=' + $projectGoalId + '&projectIndicId=' + $projectIndicId + '&result_id=' + $result_id + '&project_id=' + window.parent.$('#formProjectMain #id').val();
                var url = '<?php echo e(route("project.goals.result.store")); ?>';
                $.ajax({
                    url: url,
                    dataTypes: 'json',
                    data: data,
                    type: 'post',
                    beforeSend: function () {
                    },
                    success: function (data) {
                        if (data.status == 'true') {
                            $this.prop("checked", true);

                            // myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        }
                    },
                    error: function () {
                    }
                })
            }
            $('[rel="tooltip"]').tooltip();
        });

        //check Are there result?
        $(document).on('click', ' #next-result-tab  ', function (e) {
            $this = $(this);
            var project_id = $('#formProjectMain #id').val();
            url = '<?php echo e(route('project.goals.result')); ?>' + '/' + project_id;
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'JSON',
                beforeSend: function () {

                }, success: function (data) {
                    if (data == 'true') {
                        $("input[name=tab_flag_result]").val('1');
                        $('[href="#add-result-tap-pane"]').click();
                        $("input[name=tab_flag_result]").val('0');
                        getResultForm();


                    } else {
                        e.preventDefault();
                        $($this).removeClass('btn-next');
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                }, error: function () {
                }
            });
        });

        /***********result ***********/
        function getResultForm() {
            var project_id = $('#formProjectMain #id').val();
            url = '<?php echo e(route('project.goals.result.create')); ?>' + '/' + project_id;
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalIndicatorResult #add-result-tap-pane  #ResultContent').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');

                },
                success: function (data) {
                    $('#modalIndicatorResult #add-result-tap-pane  #ResultContent').html();
                    $('#modalIndicatorResult #add-result-tap-pane #ResultContent').html(data);
                },
                error: function () {
                }
            });
        }


        $(document).on('click', '#previous-indicator-tab', function () {
            $("input[name=tab_flag_indict]").val('1');
            $('[href="#add-indicator-tap-pane"]').click();
            $("input[name=tab_flag_indict]").val('0');
        })

        /********** Donors ************************************/
        /*open modal  Donors to create***/
        $(document).on('click', '#AddDonors', function (e) {
            e.preventDefault();
            var project_id = $('#formProjectMain #id').val();
            url = $(this).attr('href') + '/' + project_id;
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {

                },
                success: function (data) {
                    $('#modalDonors #contentModal').html();
                    $('#modalDonors #contentModal').html(data.html.html);
                    selectpicker();
                    funValidateForm();


                },
                error: function () {
                }
            });
        });
        /******stroe Dononrs ****/


        $(document).on('submit', '#formDonorsCreate', function (e) {
            e.preventDefault();
            if (!is_valid_form($(this))) {
                return false;
            }
            data = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block')
                    $('#btnDonorAdd').prop("disabled", true);
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#modalDonors #contentModal').html();
                        $('#modalDonors #contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();
                        $('#flag_reload_index_donor').val(1);
                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#btnDonorAdd').prop("disabled", false);

                },
                error: function (data) {

                }
            })
        });

        /*************** edit donor*************************/

        $(document).on('click', '#EditDonors', function (e) {
            e.preventDefault();
            // var project_id = $('#formProjectMain #id').val();
            url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {

                },
                success: function (data) {
                    $('#modalDonors #contentModal').html();
                    $('#modalDonors #contentModal').html(data.html.html);
                    funValidateForm();

                    selectpicker();
                },
                error: function () {
                }
            });
        });
        /******Update Dononrs ****/


        $(document).on('submit', '#formDonorsEdit', function (e) {
            e.preventDefault();
            if (!is_valid_form($(this))) {
                return false;
            }
            data = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'put',
                beforeSend: function () {
                    $('#btnDonorEdit').prop("disabled", true);
                    $('.loader').css('display', 'block');

                },
                success: function (data) {
                    if (data.status == 'true') {
                        //   CheckSessionStatus(icon = 'done', title = 'SUCCESS', type = 'success', delay = '5000');
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#modalDonors #contentModal').html();
                        $('#modalDonors #contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();
                        $('#flag_reload_index_donor').val(1);
                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').css('display', 'none');
                    $('#btnDonorEdit').prop("disabled", false);

                },
                error: function (data) {

                }
            })
        });

        /*on modal class */

        $(document).on('hidden.bs.modal', '#modalDonors', function () {

            var flag = $('#flag_reload_index_donor').val();
            if (flag == 1) {


                project_id = window.parent.$('#formProjectMain #id').val();
                url = '<?php echo e(route("project.project.donors.index")); ?>' + '/' + project_id;
                $.ajax({
                    url: url,
                    type: 'get',
                    dataTypes: 'html',
                    beforeSend: function () {
                        $('#flag_reload_index_donor').val(0);
                        $('#donors-content').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                    },
                    success: function (data) {
                        $('#modalDonors #contentModal').empty();
                        $('#donors-content').html(data);
                        $('[rel="tooltip"]').tooltip();
                        // wizard()
                    },
                    error: function () {
                    }
                });
            }
        });

        $(document).on('click', '#btnDeleteDonor', function (e) {

            e.preventDefault();
            $this = $(this);
            var did = $(this).attr('data-id');

            swal({
                text: '<?php echo e($messageDeleteDonor['text']); ?>',
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

                            if (data.status == 'true') {
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                $('#contentModal .close').click();
                                $('#donor_' + did).css('background-color', 'red').hide(1000);
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


        /*************************/


        /********** stuff ************************************/
        /*open modal  stuff to create***/
        $(document).on('click', '#AddStaff', function (e) {
            e.preventDefault();
            var project_id = $('#formProjectMain #id').val();
            url = $(this).attr('href') + '/' + project_id;

            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {

                },
                success: function (data) {
                    $('#modalStaff #contentModal').html();
                    $('#modalStaff #contentModal').html(data.html.html);
                    funValidateForm();
                    selectpicker();
                },
                error: function () {
                }
            });
        });

        /******stroe stuffs ****/

        $(document).on('submit', '#formStaffCreate', function (e) {
            e.preventDefault();
            if (!is_valid_form($(this))) {
                return false;
            }

            data = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('#btnStaffAdd').prop("disabled", true);
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    console.log(data)
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#modalStaff #contentModal').html();
                        $('#modalStaff #contentModal .close').click();
                        $('[rel="tooltip"]').tooltip();
                        $('#flag_reload_index_staff').val(1)
                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                    }
                    $('#btnStaffAdd').prop("disabled", false);
                    $('.loader').css('display', 'none');


                },
                error: function (data) {

                }
            })
        });

        $(document).on('hidden.bs.modal', '#modalStaff', function () {
            var flag = $('#flag_reload_index_staff').val();
            if (flag == 1) {
                project_id = window.parent.$('#formProjectMain #id').val();
                url = '<?php echo e(route("project.project.staff.index")); ?>' + '/' + project_id;
                $.ajax({
                    url: url,
                    type: 'get',
                    dataTypes: 'html',
                    beforeSend: function () {
                        $('#flag_reload_index_staff').val(0);
                        $('#staffs-content').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');

                    },
                    success: function (data) {

                        $('#staffs-content').html(data);
                        $('[rel="tooltip"]').tooltip();

                        wizard()

                    },
                    error: function () {
                    }
                });
            }
        })
        /*************** edit stuff *************************/

        $(document).on('click', '#EditStuff', function (e) {
            e.preventDefault();
            // var project_id = $('#formProjectMain #id').val();
            url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {


                },
                success: function (data) {
                    $('#modalStaff #contentModal').html();

                    $('#modalStaff #contentModal').html(data.html.html);
                    funValidateForm();
                    selectpicker();
                },
                error: function () {
                }
            });
        });

        /******Update staff ****/


        $(document).on('submit', '#formStaffEdit', function (e) {
            e.preventDefault();
            if (!is_valid_form($(this))) {
                return false;
            }

            data = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'put',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                    $('#btnStaffEdit').prop("disabled", true);

                },
                success: function (data) {
                    if (data.status == 'true') {
                        //   CheckSessionStatus(icon = 'done', title = 'SUCCESS', type = 'success', delay = '5000');
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#modalStaff #contentModal').html();
                        $('#modalStaff #contentModal .close').click();
                        $('#flag_reload_index_staff').val(1)

                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('#btnStaffEdit').prop("disabled", false);
                    $('.loader').css('display', 'none');
                },
                error: function () {

                }
            })
        });

        /*///////////*****delete staff****//////////*/
        $(document).on('click', '#btnDeleteStuff', function (e) {
            e.preventDefault();
            $this = $(this);
            var sid = $(this).attr('data-id');

            swal({
                text: '<?php echo e($messageDeleteStaff['text']); ?>',
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
                            $('#staff_' + sid).hide(1000);
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

        $(document).on('click', '#finishGoals', function () {
            $('#modalIndicatorResult').modal('hide');
        });


        $('#btn-recover-rtr').click(function () {
            var json = $('#project-data-json').attr('data-json');
            var data = JSON.parse(json);
            $.each(data, function (key, value) {
                if (key != '_token') {
                    $('#' + key).val(value);
                }
            });
            $('#alert-noti-data').fadeOut();
            cleanRtr();
        });


        $('#btn-ignore-rtr').click(function () {
            $('#alert-noti-data').fadeOut();
            cleanRtr();
        });


        function cleanRtr() {
            var action_url = '<?php echo e(route('RealTimeRecording.clean')); ?>';
            $.post(action_url, {form_id: 1}, function () {

            });
        }


        $(function () {
            // $('.project-goal-hover').hover(function () {
            //     $(this).css('color', 'red').find('.row').css('color', 'red')
            //
            // }, function () {
            //     $(this).css('color', 'black').find('.row').css('color', 'black')
            // })
            var hoverStyle = {
                color: 'red',
                fontWeight: 'bold'
            }
            var normalStyle = {
                color: 'black',
                fontWeight: 'normal'
            }
            $('.project-goal-hover .row').hover(function () {
                $(this).css(hoverStyle).find('.row').css(hoverStyle)

            }, function () {
                $(this).css(normalStyle).find('.row').css(normalStyle)
            })
        })

        $(function () {
            /*$('#table').DataTable({
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }
            });*/

            $('[data-toggle="tooltip"]').tooltip();
            //CheckSessionStatus(icon = 'done', title = 'SUCCESS', type = 'success', delay = '5000');
        })


        $(document).on('keyup', '#formDonorsEdit #share_percent', function (e) {
            e.preventDefault();
            var project_budget = $('#formDonorsEdit #project_donor_amount').val();
            var share_percent = $(this).val();
            if (parseFloat(share_percent) > 100) {
                $(this).val(100.00);
                share_percent = 100;
            }
            if ($(this).length > 0) {
                value = financial(parseFloat(project_budget) * parseFloat(share_percent) / 100);
                if (!isNaN(value)) {
                    $("#formDonorsEdit #budget").val(value);
                } else {
                    $("#formDonorsEdit #budget").val(0);
                }
            }
        });
        $(document).on('keyup', '#formDonorsEdit #budget', function (e) {
            e.preventDefault();
            var project_budget = $('#formDonorsEdit #project_donor_amount').val();
            var budget = $(this).val();
            if (parseFloat(budget) > parseFloat(project_budget)) {
                $(this).val(project_budget);
                budget = project_budget;
            }
            if ($(this).length > 0) {
                var value = financial(parseFloat(budget) * 100 / parseFloat(project_budget));
                if (!isNaN(value)) {
                    $("#formDonorsEdit #share_percent").val(value);
                } else {
                    $("#formDonorsEdit #share_percent").val(0);
                }
            }

        });
        $(document).on('keyup', '#formDonorsCreate #share_percent', function (e) {
            e.preventDefault();
            var project_budget = $('#formDonorsCreate #project_donor_amount').val();
            var share_percent = $(this).val();
            if (parseFloat(share_percent) > 100) {
                $(this).val(100.00);
                share_percent = 100;
            }

            if ($(this).length > 0) {
                value = financial(parseFloat(project_budget) * parseFloat(share_percent) / 100);
                if (!isNaN(value)) {
                    $("#formDonorsCreate #budget").val(value);
                } else {
                    $("#formDonorsCreate #budget").val(0);
                }
            }

        });

        function financial(x) {
            return Number.parseFloat(x).toFixed(2);
        }

        $(document).on('keyup', '#formDonorsCreate #budget', function (e) {
            e.preventDefault();
            var project_budget = $('#formDonorsCreate #project_donor_amount').val();
            var budget = $(this).val();

            if (parseFloat(budget) > parseFloat(project_budget)) {
                $(this).val(project_budget);
                budget = project_budget;
            }

            if ($(this).length > 0) {

                var value = financial(parseFloat(budget) * 100 / parseFloat(project_budget));
                if (!isNaN(value)) {
                    $("#formDonorsCreate #share_percent").val(value);
                } else {
                    $("#formDonorsCreate #share_percent").val(0);
                }
            }

        });


        $(document).ready(function (e) {
            if ($('#act_start_date').val() != "") {
                $('#plan_start_date').data("DateTimePicker").maxDate($('#act_start_date').val());
            }
            if ($('#act_end_date').val() != "") {
                $('#plan_end_date').data("DateTimePicker").minDate($('#act_end_date').val());
            }
        })



      $(document).on("click","#nextProjectMain",function (e) {
          e.preventDefault();
          $('#formProjectMain').click();
      })

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

    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>

    <?php if(\Illuminate\Support\Facades\Auth::user()->lang_id ==2): ?>
        <script src="<?php echo e(asset('js/wizard-rtl.js')); ?>"></script>
    <?php else: ?>
        <script src="<?php echo e(asset('js/wizard.js')); ?>"></script>

    <?php endif; ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>