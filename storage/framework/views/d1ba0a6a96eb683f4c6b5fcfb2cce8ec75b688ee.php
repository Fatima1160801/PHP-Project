<?php $__env->startSection('css'); ?>
    <style>
        .dropdown-toggle::after {
            display: none;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <div class="col-md-12 col-12 mr-auto ml-auto">
        <!--      Wizard container        -->
        <?php if($realTimeRecord != null): ?>
            <div class="alert alert-warning" id="alert-noti-data">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
                <span>
                <b> Heads up! - </b> There are data not saved in the form, do you want to recover it ?
                <button class="btn btn-success" id="btn-recover-rtr">Yes, recover it</button>
                <button class="btn btn-danger" id="btn-ignore-rtr">No, ignore that</button>
            </span>
            </div>
            <div id="project-data-json" style="display: none;"
                 data-json="<?php echo e($realTimeRecord->form_data_serialized); ?>"></div>
        <?php endif; ?>
        <div class="wizard-container">
            <div class="card card-wizard" data-color="rose" id="wizardActivity">
                <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                <div class="card-header text-center">
                    <h3 class="card-title">

                        <?php echo e($labels['screen_activity']??'screen_activity'); ?>


                        <span id="tem-massage">
                        <?php if(isset($activity_data) && $activity_data->temp == 1 ): ?>
                                <span class=" badge badge-danger">
                                    Temp
                              </span>

                                <div class="alert alert-rose alert-with-icon" data-notify="container"
                                     style=" margin-top: 7px; ">
                                <i class="material-icons" data-notify="icon">notifications</i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                                <span data-notify="message" style=" font-size: 13px; ">
This activity has been saved temporarily, please confirmation save
                                </span>
                            </div>
                            <?php endif; ?>
                        </span>
                        <?php if(isset($id)): ?>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            

                            
                            
                        <?php endif; ?>

                    </h3>
                </div>
                <div class="wizard-navigation">
                    <ul class="nav nav-pills nav-project">
                        <li class="nav-item">
                            <a data-project-id="" ; class="nav-link active" href="#ActivityTab"
                               data-toggle="tab"
                               role="tab">

                                <?php echo e($labels['activity']??'activity'); ?>


                            </a>
                        </li>
                        
                        
                        

                        
                        
                        
                        
                        

                        
                        
                        <li class="nav-item">
                            <a class="nav-link" href="#location" data-toggle="tab" role="tab">
                                <?php echo e($labels['activity_location']??'activity_location'); ?>


                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#activity_staff" data-toggle="tab" role="tab">
                                <?php echo e($labels['activity_staff']??'activity_staff'); ?>


                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#activity_lessons_learning" data-toggle="tab" role="tab">
                                <?php echo e($labels['activity_lessons_learning']??'activity_lessons_learning'); ?>

                            </a>
                        </li>
                        
                        
                        
                        

                        
                        
                        
                        
                        

                        <li class="nav-item">
                            <a class="nav-link" href="#attachments" data-toggle="tab" role="tab">
                                <?php echo e($labels['attachments']??'attachments'); ?>


                            </a>
                        </li>

                    </ul>

                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="ActivityTab">
                            <?php echo $activity; ?>

                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <div class="tab-pane" id="location">
                            <div id="content-location">
                                <div style="margin: auto" class="loader-div"></div>
                            </div>
                        </div>
                        <div class="tab-pane" id="activity_staff">
                            <div style="margin: auto" class="loader-div"></div>
                        </div>

                        <div class="tab-pane" id="activity_lessons_learning">
                            <div style="margin: auto" class="loader-div"></div>
                        </div>

                        
                        
                        
                        

                        
                        
                        
                        
                        
                        
                        
                        
                        
                        

                        
                        

                        
                        
                        
                        

                        <div class="tab-pane" id="attachments">
                            
                            <input type="hidden" id="object_primary_id" value="">
                            <div id="files-content"></div>

                            <div class="col-md-12">
                                <a href="#" class="btn btn-sm btn-previous btn-fill btn-default btn-wd pull-left"
                                   id="previous">
                                    <?php echo e($labels['previous']??'previous'); ?>

                                </a>

                                <a href="<?php echo e(route('activity.mainActivity.index')); ?>"
                                   class="btn btn-sm  btn-fill btn-rose btn-wd pull-right" id="finish">
                                    <?php echo e($labels['finish']??'finish'); ?>


                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- wizard container -->
    </div>


    <div class="modal fade  bd-example-modal-lg" id="modalLocation" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg" role="document">
            <div id="contentModal"></div>
        </div>
    </div>

    <div class="modal fade  bd-example-modal-lg" id="modalStaff" tabindex="-1" role="">
        <div class="modal-dialog  modal-lg" role="document">
            <div id="contentModal"></div>
        </div>
    </div>

    <div class="modal fade" id="modalAddActivityDelay" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-signup" role="document">
            <div id="contentModal"></div>
        </div>
    </div>

    <div class="modal fade" id="modalEditActivityDelay" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-signup" role="document">
            <div id="contentModal"></div>


        </div>
    </div>

    <div class="modal fade" id="addBeneficiarySubActivity_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-signup" role="document">
            <div id="contentModal"></div>

        </div>
    </div>


    <div class="modal fade" id="modalLessons" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-signup" role="document">
            <div id="contentModal"></div>

        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>

        $(document).ready(function () {

           var id_val= $('#formActivityMainAdd #id').val();
           if(id_val == ""){
               location.reload();
           }
            active_nev_link('activities_list');
            $('#planed_start_date').datetimepicker({
                format: 'DD/MM/YYYY'
            });
            $('#planed_end_date').datetimepicker({
                format: 'DD/MM/YYYY'
            });

            $('#act_start_date').datetimepicker({
                format: 'DD/MM/YYYY'
            });
            $('#act_end_date').datetimepicker({
                format: 'DD/MM/YYYY'
            });

            $('a[href="#attachments"]').click(function () {
                var primary_id = '<?php echo e($primary_id); ?>';
                if (primary_id == 0) {
                    primary_id = $('#object_primary_id').val();
                }
                var get_attachments_url = '<?php echo e(route('attachments.get_by_activity',['activity_type' => $activity_type])); ?>' + '/' + primary_id;
                $.get(get_attachments_url, function (response) {
                    $('#files-content').html(response);
                    DataTableCall('attachments-table');
                    $('[data-toggle="tooltip"]').tooltip();
                });
            });
            /*my function validation*/
            funValidateForm();
            setDatePlan();


        });


        wizard();
        datetimepicker();
        selectpicker();


        function wizard() {
            wizardActivity.initMaterialWizard();
            setTimeout(function () {
                $('#wizardActivity').addClass('active');
            }, 600);
        }

        function selectpicker() {
            $('.selectpicker').selectpicker();
            $('#project_id').selectpicker().attr('disabled', true)
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


        function setDatePlan() {


            var sub_activity_id = $('#formSubActivity #id').val();
            var main_activity_id = $('#formActivityMainAdd #id').val();

            if (sub_activity_id !== undefined && sub_activity_id !== null) {
                var parent_id = $('#formSubActivity #parent_id').val();
                $url = '<?php echo e(route('activity.mainActivity.getDatePlanned')); ?>' + '/' + 'activity' + '/' + parent_id;
                getDatePlan($url);
            } else if (main_activity_id !== undefined && main_activity_id !== null) {
                $url = '<?php echo e(route('activity.mainActivity.getDatePlanned')); ?>' + '/' + 'project' + '/' + main_activity_id;
                getDatePlan($url);

            }
        }

        function getDatePlan($url) {
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {

                    dateOnOpenPage(data);
                } ,
                error: function () {

                }
            });

        }


        function dateOnOpenPage(data){

            var act_start_date = $('#act_start_date').val();
            var act_end_date = $('#act_end_date').val();

            if (act_start_date =="" && act_end_date == "") {

                $('#planed_start_date').data("DateTimePicker").minDate(data.start_date);
                $('#planed_start_date').data("DateTimePicker").maxDate(data.end_date);
                $('#planed_end_date').data("DateTimePicker").minDate(data.start_date);
                $('#planed_end_date').data("DateTimePicker").maxDate(data.end_date);

                var planed_start_date =$('#planed_start_date').val();
                var planed_end_date =$('#planed_end_date').val();

                if(planed_start_date != "" &&  planed_end_date != ""){

                    $('#act_start_date').data("DateTimePicker").minDate(planed_start_date);
                    $('#act_start_date').data("DateTimePicker").maxDate(planed_end_date);

                    $('#act_end_date').data("DateTimePicker").minDate(planed_start_date);
                    $('#act_end_date').data("DateTimePicker").maxDate(planed_end_date);

                    $('#planed_start_date').data("DateTimePicker").maxDate(planed_end_date);
                    $('#planed_end_date').data("DateTimePicker").minDate(planed_start_date);


                }else if(planed_start_date != "" &&  planed_end_date == ""){
                    $('#act_start_date').data("DateTimePicker").minDate(planed_start_date);
                    $('#act_start_date').data("DateTimePicker").maxDate(data.end_date);

                    $('#act_end_date').data("DateTimePicker").minDate(planed_start_date);
                    $('#act_end_date').data("DateTimePicker").maxDate(data.end_date);

                    $('#planed_start_date').data("DateTimePicker").maxDate(data.end_date);
                    $('#planed_end_date').data("DateTimePicker").minDate(planed_start_date);

                }else if(planed_start_date == "" &&  planed_end_date != ""){
                    $('#act_start_date').data("DateTimePicker").minDate(data.start_date);
                    $('#act_start_date').data("DateTimePicker").maxDate(planed_end_date);

                    $('#act_end_date').data("DateTimePicker").minDate(data.start_date);
                    $('#act_end_date').data("DateTimePicker").maxDate(planed_end_date);

                    $('#planed_start_date').data("DateTimePicker").maxDate(planed_end_date);
                    $('#planed_end_date').data("DateTimePicker").minDate(data.start_date);
                }else{
                    $('#act_start_date').data("DateTimePicker").minDate(data.start_date);
                    $('#act_start_date').data("DateTimePicker").maxDate(data.end_date);

                    $('#act_end_date').data("DateTimePicker").minDate(data.start_date);
                    $('#act_end_date').data("DateTimePicker").maxDate(data.end_date);
                }

            }else if (act_start_date != "" &&  act_end_date != ""){

                var act_start_date =$('#act_start_date').val();
                var act_end_date =$('#act_end_date').val();

                $('#planed_start_date').data("DateTimePicker").minDate(data.start_date);
                $('#planed_start_date').data("DateTimePicker").maxDate(act_start_date);
                $('#planed_end_date').data("DateTimePicker").minDate( act_end_date);
                $('#planed_end_date').data("DateTimePicker").maxDate(data.end_date);

                var planed_start_date =$('#planed_start_date').val();
                var planed_end_date =$('#planed_end_date').val();

                if(planed_start_date != "" &&  planed_end_date != ""){

                    $('#act_start_date').data("DateTimePicker").minDate(planed_start_date);
                    $('#act_start_date').data("DateTimePicker").maxDate(planed_end_date);

                    $('#act_end_date').data("DateTimePicker").minDate(planed_start_date);
                    $('#act_end_date').data("DateTimePicker").maxDate(planed_end_date);
                }else if(planed_start_date != "" &&  planed_end_date == ""){

                    $('#act_start_date').data("DateTimePicker").minDate(planed_start_date);
                    $('#act_start_date').data("DateTimePicker").maxDate(data.end_date);

                    $('#act_end_date').data("DateTimePicker").minDate(planed_start_date);
                    $('#act_end_date').data("DateTimePicker").maxDate(data.end_date);

                }else if(planed_start_date == "" &&  planed_end_date != ""){

                    $('#act_start_date').data("DateTimePicker").minDate(data.start_date);
                    $('#act_start_date').data("DateTimePicker").maxDate(planed_end_date);

                    $('#act_end_date').data("DateTimePicker").minDate(data.start_date);
                    $('#act_end_date').data("DateTimePicker").maxDate(planed_end_date);
                }else{
                    $('#act_start_date').data("DateTimePicker").minDate(data.start_date);
                    $('#act_start_date').data("DateTimePicker").maxDate(data.end_date);

                    $('#act_end_date').data("DateTimePicker").minDate(data.start_date);
                    $('#act_end_date').data("DateTimePicker").maxDate(data.end_date);
                }

            }else if (act_start_date != "" &&  act_end_date == ""){

                var planed_start_date =$('#planed_start_date').val();
                var planed_end_date =$('#planed_end_date').val();

                $('#planed_start_date').data("DateTimePicker").minDate(data.start_date);
                $('#planed_start_date').data("DateTimePicker").maxDate(act_start_date);
                $('#planed_end_date').data("DateTimePicker").minDate( planed_start_date);
                $('#planed_end_date').data("DateTimePicker").maxDate(data.end_date);



                if(planed_start_date != "" &&  planed_end_date != ""){

                    $('#act_start_date').data("DateTimePicker").minDate(planed_start_date);
                    $('#act_start_date').data("DateTimePicker").maxDate(planed_end_date);

                    $('#act_end_date').data("DateTimePicker").minDate(planed_start_date);
                    $('#act_end_date').data("DateTimePicker").maxDate(planed_end_date);
                }else if(planed_start_date != "" &&  planed_end_date == ""){

                    $('#act_start_date').data("DateTimePicker").minDate(planed_start_date);
                    $('#act_start_date').data("DateTimePicker").maxDate(data.end_date);

                    $('#act_end_date').data("DateTimePicker").minDate(planed_start_date);
                    $('#act_end_date').data("DateTimePicker").maxDate(data.end_date);

                }else if(planed_start_date == "" &&  planed_end_date != ""){
                    $('#act_start_date').data("DateTimePicker").minDate(data.start_date);
                    $('#act_start_date').data("DateTimePicker").maxDate(planed_end_date);

                    $('#act_end_date').data("DateTimePicker").minDate(data.start_date);
                    $('#act_end_date').data("DateTimePicker").maxDate(planed_end_date);
                }else{
                    $('#act_start_date').data("DateTimePicker").minDate(data.start_date);
                    $('#act_start_date').data("DateTimePicker").maxDate(data.end_date);

                    $('#act_end_date').data("DateTimePicker").minDate(data.start_date);
                    $('#act_end_date').data("DateTimePicker").maxDate(data.end_date);
                }

            }else if (act_start_date == "" &&  act_end_date != ""){

                var planed_start_date =$('#planed_start_date').val();
                var planed_end_date =$('#planed_end_date').val();

                $('#planed_start_date').data("DateTimePicker").minDate(data.start_date);
                $('#planed_start_date').data("DateTimePicker").maxDate(planed_end_date);
                $('#planed_end_date').data("DateTimePicker").minDate(act_end_date);
                $('#planed_end_date').data("DateTimePicker").maxDate(data.end_date);



                if(planed_start_date != "" &&  planed_end_date != ""){

                    $('#act_start_date').data("DateTimePicker").minDate(planed_start_date);
                    $('#act_start_date').data("DateTimePicker").maxDate(planed_end_date);

                    $('#act_end_date').data("DateTimePicker").minDate(planed_start_date);
                    $('#act_end_date').data("DateTimePicker").maxDate(planed_end_date);
                }else if(planed_start_date != "" &&  planed_end_date == ""){

                    $('#act_start_date').data("DateTimePicker").minDate(planed_start_date);
                    $('#act_start_date').data("DateTimePicker").maxDate(data.end_date);

                    $('#act_end_date').data("DateTimePicker").minDate(planed_start_date);
                    $('#act_end_date').data("DateTimePicker").maxDate(data.end_date);

                }else if(planed_start_date == "" &&  planed_end_date != ""){
                    $('#act_start_date').data("DateTimePicker").minDate(data.start_date);
                    $('#act_start_date').data("DateTimePicker").maxDate(planed_end_date);

                    $('#act_end_date').data("DateTimePicker").minDate(data.start_date);
                    $('#act_end_date').data("DateTimePicker").maxDate(planed_end_date);
                }else{
                    $('#act_start_date').data("DateTimePicker").minDate(data.start_date);
                    $('#act_start_date').data("DateTimePicker").maxDate(data.end_date);

                    $('#act_end_date').data("DateTimePicker").minDate(data.start_date);
                    $('#act_end_date').data("DateTimePicker").maxDate(data.end_date);
                }

            }
        }
        /*******************when project change in form main activity  */
        $(document).on('change', '#formActivityMainAdd #project_id', function (e) {
            e.preventDefault();

            var project_id = $(this).val();
            var activity_id = $('#formActivityMainAdd #id').val();
            $url = "";
            if (activity_id) {
                $url = '<?php echo e(route("activity.mainActivity.staffByProjectMain")); ?>' + '/' + project_id + '/' + activity_id;
            } else {
                $url = '<?php echo e(route("activity.mainActivity.staffByProjectMain")); ?>' + '/' + project_id;
            }

            $("#staff_id option").remove();
            $("#staff_id ").append("<option  style='height: 37px;' value></option>");
            $('#staff_id').selectpicker('refresh');

            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {

                    $("#staff_id option").remove();
                    $("#staff_id ").append("<option  style='height: 37px;' value></option>");

                    if (data.project != null) {
                        planDateFillByProject(data['project']);
                    }
                    if (data.staff != null) {
                        selectStuff(data['staff']);
                    }
                    $('#staff_id').selectpicker('refresh');
                },
                error: function () {
                    $("#staff_id option").remove();
                    $("#staff_id ").append("<option  style='height: 37px;' value></option>");
                    $('#staff_id').selectpicker('refresh');
                }
            });

        });

        function planDateFillByProject(data) {
            var planed_start_date = data.plan_start_date;
            var planed_end_date = data.plan_end_date;
            $('#planed_start_date').data("DateTimePicker").minDate(planed_start_date);
            $('#planed_end_date').data("DateTimePicker").maxDate(planed_end_date);
        }


        function selectStuff(data) {

            $.each(data, function (index, value) {

                $("#staff_id").append('<option value=' + value['staff']['id'] + '>' + value['staff']['staff_name_na'] + '</option>');

            });
        }


        /*********** on change date */

        $(document).on('focusout', '#planed_start_date', function (e) {
            e.preventDefault();
            var planed_end_date = $('#planed_end_date').val();
            var act_start_date = $('#act_start_date').val();
            var act_end_date = $('#act_end_date').val();

            if (act_end_date == "" && act_start_date == "") {
                $('#planed_end_date').data("DateTimePicker").minDate($(this).val());
            }
            $('#act_start_date').data("DateTimePicker").minDate($(this).val());//.add(-1, 'd')

            if (act_start_date == "") {
                $('#act_start_date').val("");
            }
            if (planed_end_date == "") {
                $('#planed_end_date').val("");
            }

        })

        $(document).on('focusout', '#planed_end_date', function (e) {
            e.preventDefault();
            var act_start_date = $('#act_start_date').val();
            var act_end_date = $('#act_end_date').val();
            var planed_start_date = $('#planed_start_date').val();

            if (act_end_date == "" && act_start_date == "") {
                $('#planed_start_date').data("DateTimePicker").maxDate($(this).val());
            }
            $('#act_start_date').data("DateTimePicker").maxDate($(this).val());
            $('#act_end_date').data("DateTimePicker").maxDate($(this).val());


            if (act_start_date == "") {
                $('#act_start_date').val("");
            }
            if (act_end_date == "") {
                $('#act_end_date').val("");
            }
            if (planed_start_date == "") {
                $('#planed_start_date').val("");
            }

        })
        $(document).on('focusout', '#act_start_date', function (e) {
            e.preventDefault();
            var act_end_date = $('#act_end_date').val();

            $('#planed_end_date').data("DateTimePicker").minDate($(this).val());
            $('#act_end_date').data("DateTimePicker").minDate($(this).val());

            if (act_end_date == "") {
                $('#act_end_date').val("");
            }
        })

        $(document).on('focusout', '#act_end_date', function (e) {
            e.preventDefault();
            var act_start_date = $('#act_start_date').val();
            $('#planed_end_date').data("DateTimePicker").minDate($(this).val());
            $('#act_start_date').data("DateTimePicker").maxDate($(this).val());
            if (act_start_date == "") {
                $('#act_start_date').val("");
            }
        })


        function planDate() {
            var $parent_id = $('#parent_id').val();
            if ($parent_id != '0') {
                $url = '<?php echo e(route('activity.mainActivity.plandate')); ?>' + '/' + $parent_id;
                $.ajax({
                    url: $url,
                    dataTypes: 'json',
                    type: 'get',
                    beforeSend: function () {
                    },
                    success: function (data) {
                        planDateFill(data);
                    },
                    error: function () {
                    }
                })
            }
        }

        function planDateFill(data) {
            var planed_end_date = data.planed_end_date;
            var planed_start_date = data.planed_start_date;

            $('#planed_end_date').data("DateTimePicker").maxDate(planed_end_date);
            $('#planed_start_date').data("DateTimePicker").minDate(planed_start_date);

        }


        /***    sumbit add  main activity     ***/
        $(document).on('submit', '#formActivityMainAdd', function (e) {
            e.preventDefault();
            if (!is_valid_form($(this))) {
                return false;
            }
            var data = new FormData($(this)[0]);


            var id_ = $('#formActivityMainAdd #id').val();
            var project_id_ = $('#formActivityMainAdd #project_id').val();
            var activity_name_na_ = $('#formActivityMainAdd #activity_name_na').val();
            var activity_name_fo_ = $('#formActivityMainAdd #activity_name_fo').val();
            var activity_desc_na_ = $('#formActivityMainAdd #activity_desc_na').val();
            var activity_desc_fo_ = $('#formActivityMainAdd #activity_desc_fo').val();
            var activity_type_id_ = $('#formActivityMainAdd #activity_type_id').val();
            var planed_start_date_ = $('#formActivityMainAdd #planed_start_date').val();
            var planed_end_date_ = $('#formActivityMainAdd #planed_end_date').val();
            var act_start_date_ = $('#formActivityMainAdd #act_start_date').val();
            var act_end_date_ = $('#formActivityMainAdd #act_end_date').val();
            var status_id_ = $('#formActivityMainAdd #status_id').val();
            var staff_id_ = $('#formActivityMainAdd #staff_id').val();
            var notes_ = $('#formActivityMainAdd #notes').val();
            var activity_load_ = $('#formActivityMainAdd #activity_load').val();
            if (typeof act_start_date === typeof undefined || act_start_date === false) {
                act_start_date_ = "";
            }
            var params = {
                id: id_,
                project_id: project_id_,
                activity_name_na: activity_name_na_,
                activity_name_fo: activity_name_fo_,
                activity_desc_na: activity_desc_na_,
                activity_desc_fo: activity_desc_fo_,
                activity_type_id: activity_type_id_,
                planed_start_date: planed_start_date_,
                planed_end_date: planed_end_date_,
                act_start_date: act_start_date_,
                act_end_date: act_end_date_,
                status_id: status_id_,
                staff_id: staff_id_,
                notes: notes_,
                activity_load: activity_load_,
            };

            console.debug(params);
            var url = '<?php echo e(route('activity.main.store')); ?>';
            $.ajax({
                url: url,
                data: params,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                    $('#addActivityMain').prop("disabled", true);
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#formActivityMainAdd #id').val(data.mainActivity.id);
                        $('#object_primary_id').val(data.mainActivity.id);
                        $('#tem-massage').fadeOut();
                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('#addActivityMain').prop("disabled", false);
                    $('.loader').css('display', 'none');
                },
                error: function () {

                }
            })
        })


        /******    sub activity   *******/


        /*******************when project change in form sub activity  */

        $(document).on('change', '#formSubActivity #project_id', function (e) {
            e.preventDefault();

            var project_id = $(this).val();
            var parent_id = $('#formSubActivity  #parent_id').val();
            var activity_id = $('#formSubActivity #id').val();
            $url = "";
            if (activity_id) {
                $url = '<?php echo e(route("activity.mainActivity.staffByProjectSub")); ?>' + '/' + project_id + '/' + parent_id + '/' + activity_id;
            } else {
                $url = '<?php echo e(route("activity.mainActivity.staffByProjectSub")); ?>' + '/' + project_id + '/' + parent_id;
            }

            $("#staff_id option").remove();
            $("#staff_id ").append("<option  style='height: 37px;' value></option>");
            $('#staff_id').selectpicker('refresh');

            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {
                    $("#staff_id option").remove();
                    $("#staff_id ").append("<option  style='height: 37px;' value></option>");
                    if (data.project != null) {
                        planDateFillByProject(data['project']);
                    }
                    if (data.staff != null) {
                        selectStuff(data['staff']);
                    }

                    $('#staff_id').selectpicker('refresh');
                },
                error: function () {
                    $("#staff_id option").remove();
                    $("#staff_id ").append("<option  style='height: 37px;' value></option>");
                    $('#staff_id').selectpicker('refresh');
                }
            });

        });


        /***    submit add  sub activity     ***/
        $(document).on('submit', '#formSubActivity', function (e) {
            e.preventDefault();
            data = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                    $('#addActivitySub').prop("disabled", true);
                },
                success: function (data) {
                    if (data.status == 'true') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#formSubActivity #id').val(data.subActivity.id)
                    } else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('#addActivitySub').prop("disabled", false);
                    $('.loader').css('display', 'none');
                },
                error: function () {

                }
            })
        })

        /************************ indicator activity************************************************/

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        


        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        


        // $(document).on('click', '#btnNextIndicator', function () {
        //     $('[href="#indicator"]').click();
        // })

        $(document).on('click', '#previous-activity-tab', function () {
            $('[href="#ActivityTab"]').click();
        })


        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        /* on un checked  indicator unchecked for children  result */
        // $(document).on('click', '[name="indicator[]"]', function () {
        //     $this = $(this);
        //     var val = $this.val();
        //     if (!$this.is(":checked")) {
        //         $('[name="result[' + val + '][]"]').prop("checked", false);
        //     }
        // })
        /* on checked result check parent indicator*/
        // $(document).on('click', '.resultCheckBox', function () {
        //     $this = $(this);
        //     var parent_val = $this.attr('parentCheckBox');
        //     if ($this.is(":checked")) {
        //         $parent = $('[value="' + parent_val + '"]');
        //         if (!$parent.is(":checked")) {
        //             $parent.prop("checked", true);
        //         }
        //     }
        // })
        //
        // $(document).on('click', '.indicatorCheckBox', function () {
        //     $this = $(this);
        //     var parent_val = $this.val();
        //     if ($this.is(":checked")) {
        //         $('#oldValue' + parent_val).removeAttr('disabled');
        //         $('#planeValue' + parent_val).removeAttr('disabled');
        //     } else {
        //         $('#oldValue' + parent_val).attr('disabled', 'disabled');
        //         $('#planeValue' + parent_val).attr('disabled', 'disabled');
        //         $('#oldValue' + parent_val).val('0');
        //         $('#planeValue' + parent_val).val('0');
        //     }
        // })

        // $(document).on('click', '.isbeneficiary', function () {
        //     var inputId = $(this).attr('input-id');
        //     if ($(this).is(":checked")) {
        //         //$('#'+inputId).attr('disabled','disabled');
        //         $('#' + inputId).prop('disabled', true);
        //     } else {
        //         $('#' + inputId).prop('disabled', false);
        //     }
        // })


        /************* * *  beneficiary   * * **********/

        // $(document).on('click', '#btnNextBeneficiaries', function () {
        //     $('[href="#beneficiaries"]').click();
        // });

        // $(document).on('click', '#previous-indicator-tab', function () {
        //     $('[href="#indicator"]').click();
        // });


        // href="#beneficiaries"

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        


        
        
        
        
        
        
        
        
        
        

        
        

        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        

        
        
        

        // function cleanFormAddActivityBeneficiaries() {
        //     $('#formAddActivityBeneficiaries #ben_id option').removeAttr('selected');
        //     $('#formAddActivityBeneficiaries #ben_id option:first').attr('selected', 'selected');
        //     $('#formAddActivityBeneficiaries #activity_result_id option').removeAttr('selected');
        //     $('#formAddActivityBeneficiaries #activity_result_id option:first').attr('selected', 'selected');
        //     $('#formAddActivityBeneficiaries #planed_value').val('');
        //     $('#formAddActivityBeneficiaries #act_value').val('');
        //     $('#formAddActivityBeneficiaries #ben_date').val('');
        //     $('#formAddActivityBeneficiaries #ben_desc').val('');
        //     $('#formAddActivityBeneficiaries #id').val('');
        //     $('.selectpicker').selectpicker('refresh');
        //
        // }

        //


        // $(document).on('click', '#addBeneficiarySubActivity_btn', function (e) {
        //     e.preventDefault()
        //     //  addBeneficiarySubActivity_modal  contentModal
        //     var url = $(this).attr('href');
        //     $.ajax({
        //         url: url,
        //         dataTypes: 'html',
        //         type: 'get',
        //         beforeSend: function () {
        //             $('#addBeneficiarySubActivity_modal #contentModal').empty();
        //             $('#addBeneficiarySubActivity_modal #contentModal').html('<div style="margin: auto" class="loader-div"></div>');
        //         },
        //         success: function (data) {
        //             $('#addBeneficiarySubActivity_modal #contentModal').empty();
        //             $('#addBeneficiarySubActivity_modal #contentModal').html(data.html);
        //             selectpicker();
        //             funValidateForm();
        //         },
        //         error: function () {
        //         }
        //     });
        // });
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        


        $(document).on('change', 'input[name="checkAllBox"]', function (e) {
            e.preventDefault();

            $('.checkBeneficiaryType').removeAttr('checked');
            $('.checkBeneficiaryType').prop('checked', false);
            $('.checkBeneficiaryType').trigger("change");

            if ($('input[name=checkAllBox]').is(':checked')) {
                $('.checkBeneficiaryType').attr('checked', 'checked');
                $('.checkBeneficiaryType').prop('checked', true);
                $('.checkBeneficiaryType').trigger("change");
            }
        });

        $(document).on('keyup', '#allPlanValue', function (e) {
            e.preventDefault();
            var value = $('#allPlanValue').val();
            $('.planValue').val(value);
        });


        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        

        /*id="addBeneficiarySubActivity_modal"*/
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        /*///////////*****delete activity beneficiary****//////////*/
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        

        /*edit activity beneficiary*/

        // $(document).on('click', '#btnEditActivityBen', function (e) {
        //     e.preventDefault();
        //     $this = $(this);
        //
        //     var url = $(this).attr('href');
        //     $.ajax({
        //         url: url,
        //         dataTypes: 'json',
        //         type: 'get',
        //         beforeSend: function () {
        //             cleanFormAddActivityBeneficiaries();
        //             $($this).empty();
        //             $($this).html('<div style="margin: auto" class="loader-div"></div> <i class="material-icons">edit</i>');
        //         },
        //         success: function (data) {
        //             fillFormAddActivityBeneficiaries(data);
        //             datetimepicker();
        //
        //             $($this).empty();
        //             $($this).html('<i class="material-icons">edit</i>');
        //
        //         },
        //         error: function () {
        //
        //         }
        //     })
        // })
        // $(document).on('change', '#activity_result_id', function (e) {
        //     e.preventDefault();
        //     var option_val = $(this).val();
        //     var is_measurable = $('#activity_result_id option[value="' + option_val + '"]').attr('is_measurable');
        //     if (is_measurable == 2) {
        //         $('#planed_value').removeAttr('required');
        //         $('#planed_value').attr('readonly', 'readonly');
        //         $('#planed_value').val('0');
        //     } else {
        //         $('#planed_value').attr('required', 'required');
        //         $('#planed_value').removeAttr('readonly');
        //         $('#planed_value').val('');
        //     }
        // })

        // function fillFormAddActivityBeneficiaries(data) {
        //
        //     $('#formAddActivityBeneficiaries #ben_id option').removeAttr('selected');
        //     $('.selectpicker').selectpicker('refresh');
        //     $('#formAddActivityBeneficiaries #ben_id option[name="' + data.ben_id + '-' + data.ben_type_id + '"]').attr('selected', 'selected');
        //     $('.selectpicker').selectpicker('refresh');
        //
        //     $('#formAddActivityBeneficiaries #activity_result_id option').removeAttr('selected');
        //     $('.selectpicker').selectpicker('refresh');
        //
        //     $('#formAddActivityBeneficiaries #activity_result_id option[org_result_id="' + data.org_result_id + '"]').attr('selected', 'selected');
        //     $('.selectpicker').selectpicker('refresh');
        //
        //     $('#formAddActivityBeneficiaries #planed_value').val(data.planed_value);
        //     $('#formAddActivityBeneficiaries #act_value').val(data.act_value);
        //     $('#formAddActivityBeneficiaries #ben_date').val(data.ben_date);
        //     $('#formAddActivityBeneficiaries #ben_desc').val(data.ben_desc);
        //     // $('#formAddActivityBeneficiaries #activity_id').val(data.activity_id);
        //     // $('#formAddActivityBeneficiaries #project_id').val(data.project_id);
        //     $('#formAddActivityBeneficiaries #id').val(data.id);
        //     $('.selectpicker').selectpicker('refresh');
        // }

        function dataTableInclude() {
            DataTableCall('#table', 5);
            $('[data-toggle="tooltip"]').tooltip();
        }

        $(document).on('click', '.resultCheckBox', function () {
            var resultId = $(this).val();
            var parent_val = $this.attr('parentCheckBox');
            console.log(parent_val);

            if ($(this).is(':checked')) {
                $('[input-id="planValue' + resultId + '"]').prop('disabled', false);
                $('[id="planValue' + resultId + '"]').prop('disabled', false);
                $('[id="oldValue' + parent_val + '"]').prop('disabled', false);
                $('[id="planeValue' + parent_val + '"]').prop('disabled', false);
            } else {
                $('[input-id="planValue' + resultId + '"]').prop('disabled', true);
                $('[id="planValue' + resultId + '"]').prop('disabled', true);
                $('[id="planValue' + resultId + '"]').val('0');
                $('[input-id="planValue' + resultId + '"]').prop('checked', false);

            }
        })

        $(document).on('click', '#btnNextAttachments', function () {
            $('[href="#attachments"]').click();
        })

        $(document).on('click', '#btnNextStaff', function () {
            $('[href="#activity_staff"]').click();
        })


        $(document).on('click', '#previous-location-tab', function () {
            $('[href="#location"]').click();
        })


        $(document).on('click', '#previous-staff-tab', function () {
            $('[href="#activity_staff"]').click();
        })

        $(document).on('click', '#next-attachments-tab', function () {
            $('[href="#attachments"]').click();
        })

        $(document).on('click', '#btnNextLessons', function () {
            $('[href="#activity_lessons_learning"]').click();
        })

        $(document).on('click', '#btnNextLocation', function () {
            $('[href="#location"]').click();
        })

        $(document).on('click', '#previousActivityTab', function () {
            $('[href="#ActivityTab"]').click();
        })


        $(document).on('click', '[href="#location"]', function (e) {
            e.preventDefault();

            var activity_id = $('#id').val();
            var url = '<?php echo e(route('activity.location.index')); ?>' + '/' + activity_id;
            $.ajax({
                url: url,
                dataTypes: 'html',
                type: 'get',
                beforeSend: function () {
                    $('#wizardActivity #location #content-location').empty();
                    $('#wizardActivity #location #content-location').html('<div style="margin: auto" class="loader-div"></div>');
                },
                success: function (data) {
                    $('#wizardActivity #location #content-location').empty();
                    $('#wizardActivity #location #content-location').html(data);
                    datetimepicker();
                    selectpicker();
                    setTimeout(function () {
                    }, 500);

                },
                error: function () {
                }
            })
        })

        /** on open modal locations */

        $(document).on('click', '#AddLocation', function (e) {
            e.preventDefault();
            // var project_id = $('#formProjectMain #id').val();
            var activity_id = $('#formActivityMainAdd #id').val();
            if (activity_id === undefined) {
                activity_id = $('#formSubActivity #id').val();
            }
            url = '<?php echo e(route("activity.location.create")); ?>' + "/" + activity_id;
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {

                },
                success: function (data) {
                    $('#modalLocation #contentModal').html();
                    $('#modalLocation #contentModal').html(data.html.html);
                    selectpicker();
                    /*my function validation*/
                    funValidateForm();
                },
                error: function () {
                }
            });
        });


        /* activity.location.getDistanceByCityId*/

        /*******************when project change in form sub activity  */

        $(document).on('change', '#formLocationCreate #city_id', function (e) {
            e.preventDefault();
            var city_id = $(this).val();
            $url = '<?php echo e(route("activity.location.getDistanceByCityId")); ?>' + '/' + city_id;

            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                    $("#destrict_ option").remove();
                    $("#destrict_ ").append("<option  style='height: 37px;' value></option>");
                    $('#destrict_').selectpicker('refresh');
                },
                success: function (data) {
                    if (data != null) {
                        selectDestrice(data);
                    }

                    $('#destrict_').selectpicker('refresh');
                },
                error: function () {
                }
            });
        });

        function selectDestrice(data) {

            $.each(data, function (index, value) {
                $("#destrict_").append('<option value=' + index + '>' + value + '</option>');
            });
        }


        $(document).on('submit', '#formLocationCreate', function (e) {
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
                    $('.loader').css('display', 'block');
                    $('#btnLocationAdd').prop("disabled", true);
                },
                success: function (data) {

                    if (data == 'true') {
                        $('#modalLocation .close').click();
                        $('[rel="tooltip"]').tooltip();
                    }

                },
                error: function (data) {

                }
            })
        });


        $(document).on('hidden.bs.modal', '#modalLocation', function () {


            var activity_id = window.parent.$('#formActivityMainAdd #id').val();
            if (activity_id === undefined) {
                activity_id = window.parent.$('#formSubActivity #id').val();
            }
            url = '<?php echo e(route("activity.location.index")); ?>' + '/' + activity_id;
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#location #content-location').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#location #content-location').empty();
                    $('#location #content-location').html(data);
                    $('[rel="tooltip"]').tooltip();
                    // wizard()
                },
                error: function () {
                }
            });

        });

        /** on open modal  locations  edit*/

        $(document).on('click', '#btnEditActivityLocation', function (e) {
            e.preventDefault();
            // var project_id = $('#formProjectMain #id').val();
            url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalLocation #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalLocation #contentModal').empty();
                    $('#modalLocation #contentModal').html(data.html.html);
                    selectpicker();
                    /*my function validation*/
                    funValidateForm();
                },
                error: function () {
                }
            });
        });

        $(document).on('click', '#btnDeleteActivityLocation', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '<?php echo e($messageDeleteActivityLocation['text']); ?>',
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
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);

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
        $(document).on('click', '#btnNexLocation', function () {
            $('[href="#location"]').click();
        })
        $(document).on('click', '#previous-beneficiary-tab', function () {
            $('[href="#beneficiaries"]').click();
        })


        $(document).on('click', '[href="#activity_staff"]', function (e) {
            e.preventDefault();

            var activity_id = $('#id').val();
            var url = '<?php echo e(route('activity.staff.index')); ?>' + '/' + activity_id;
            $.ajax({
                url: url,
                dataTypes: 'html',
                type: 'get',
                beforeSend: function () {
                    $('#wizardActivity #activity_staff').empty();
                    $('#wizardActivity #activity_staff').html('<div style="margin: auto" class="loader-div"></div>');
                },
                success: function (data) {
                    $('#wizardActivity #activity_staff').empty();
                    $('#wizardActivity #activity_staff').html(data);
                    funValidateForm();

                    selectpicker();
                    setTimeout(function () {
                    }, 500);

                },
                error: function () {
                }
            })
        })

        $(document).on('submit', '#formAddValue', function (e) {
            e.preventDefault();
            if (!is_valid_form($(this))) {
                return false;
            }

            data_ = $(this).serialize();
            url_ = '<?php echo e(route('activity.staff.store')); ?>';
            var project_id = $('#formActivityMainAdd #project_id').val();
            var activity_id = $('#formActivityMainAdd #id').val();

            if (project_id === undefined && activity_id === undefined) {
                project_id = $('#formSubActivity #project_id').val();
                activity_id = $('#formSubActivity #id').val();
            }
            data_ = data_ + '&project_id=' + project_id + '&activity_id=' + activity_id;
            $.ajax({
                url: url_,
                data: data_,
                type: 'post',
                beforeSend: function () {
                    $('.loader').css('display', 'block');
                    $('[btn="btnToggleDisabled"]').prop("disabled", true);
                },
                success: function (data) {
                    selectStaffId(data.staff);
                    $('#activityStaffRow').empty();
                    $('#activityStaffRow').html(data.html);
                    $('.loader').css('display', 'none');
                    $('[btn="btnToggleDisabled"]').prop("disabled", false);
                },
                error: function () {
                }

            });
        });

        function selectStaffId(data) {
            console.log(data)
            $("#formAddValue #staff_id option").remove();
            $("#formAddValue #staff_id").append("<option  style='height: 37px;' value></option>");
            $("#formAddValue #staff_id").selectpicker('refresh');

            $.each(data, function (index, value) {

                $("#formAddValue #staff_id").append('<option value=' + value.id + '>' + value.staff_name_na + '</option>');
            });

            $("#formAddValue #staff_id").selectpicker('refresh');
        }

        $(document).on('click', '#btnDeleteActivityStuff', function (e) {
            e.preventDefault();
            var perant_id = $(this).data('id');
            swal({
                text: '<?php echo e($messageDeleteActivityStaff['text']); ?>',
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
                                selectStaffId(data.staff);
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                $('#staff_' + perant_id).css('background', 'red').delay(1000).hide(1000);
                            }
                        },
                        error: function () {
                        }
                    })
                } else {
                    return false;
                }
            })
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
            $.post(action_url, {form_id: 2}, function () {

            });
        }

        /* lessons learning and best practice */
        $(document).on('click', '[href="#activity_lessons_learning"]', function (e) {
            e.preventDefault();

            var activity_id = window.parent.$('#formActivityMainAdd #id').val();
            if (activity_id === undefined) {
                activity_id = window.parent.$('#formSubActivity #id').val();
            }
            var url = '<?php echo e(route('activity.lessons.index')); ?>' + '/' + activity_id;
            $.ajax({
                url: url,
                dataTypes: 'html',
                type: 'get',
                beforeSend: function () {
                    $('#wizardActivity #activity_lessons_learning').empty();
                    $('#wizardActivity #activity_lessons_learning').html('<div style="margin: auto" class="loader-div"></div>');
                },
                success: function (data) {
                    $('#wizardActivity #activity_lessons_learning').empty();
                    $('#wizardActivity #activity_lessons_learning').html(data.html);
                    funValidateForm();
                    selectpicker();
                    $('[data-toggle="tooltip"]').tooltip();
                    setTimeout(function () {
                    }, 500);

                },
                error: function () {
                }
            })
        })


        $(document).on('click', '#AddLessons', function (e) {
            e.preventDefault();
            // var project_id = $('#formProjectMain #id').val();
            var activity_id = $('#formActivityMainAdd #id').val();
            if (activity_id === undefined) {
                activity_id = $('#formSubActivity #id').val();
            }
            url = '<?php echo e(route("activity.lessons.create")); ?>' + "/" + activity_id;
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {

                },
                success: function (data) {
                    $('#modalLessons #contentModal').html();
                    $('#modalLessons #contentModal').html(data.html.html);
                    selectpicker();
                    funValidateForm();
                },
                error: function () {
                }
            });
        });

        $(document).on('submit', '#formActivityLessonsAdd', function (e) {
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
                    $('.loader').css('display', 'block');
                    $('#btnAddLessons').prop("disabled", true);
                },
                success: function (data) {
                    if (data == 'true') {
                        $('#modalLessons .close').click();
                        $('[rel="tooltip"]').tooltip();
                        $('.loader').css('display', 'none');

                    }
                    $('.loader').css('display', 'none');

                },
                error: function (data) {

                }
            })
        });

        $(document).on('hidden.bs.modal', '#modalLessons', function () {


            var activity_id = window.parent.$('#formActivityMainAdd #id').val();
            if (activity_id === undefined) {
                activity_id = window.parent.$('#formSubActivity #id').val();
            }

            url = '<?php echo e(route("activity.lessons.index")); ?>' + '/' + activity_id;
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#wizardActivity #activity_lessons_learning').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#wizardActivity #activity_lessons_learning').empty();
                    $('#wizardActivity #activity_lessons_learning').html(data.html);
                    $('[rel="tooltip"]').tooltip();
                    // wizard()
                },
                error: function () {
                }
            });

        });


        $(document).on('click', '#btnEditActivityLessons', function (e) {
            e.preventDefault();
            url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalLessons #contentModal').html('');
                    $('#modalLessons #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalLessons #contentModal').empty();
                    $('#modalLessons #contentModal').html(data.html.html);
                    selectpicker();
                    /*my function validation*/
                    funValidateForm();
                },
                error: function () {
                }
            });
        });
        $(document).on('submit', '#formUpdateActivityLessons', function (e) {
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
                    $('.loader').css('display', 'block');
                    $('#btnAddLessons').prop("disabled", true);
                },
                success: function (data) {
                    if (data == 'true') {
                        $('#modalLessons .close').click();
                        $('[rel="tooltip"]').tooltip();
                    }
                },
                error: function (data) {

                }
            })
        });
        $(document).on('click', '#btnDeleteActivityLessons', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '<?php echo e($messageDeleteActivityLessons['text']); ?>',
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
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);

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

        // $(document).on('click', '.btn-delay-reason-details', function () {
        //     var delay_id = $(this).data('id');
        //     $('#activity_delay #reason_notes_' + delay_id).toggle();
        // });


        // $(document).on('click', '#btn-show-delay-modal', function () {
        //     var url = $(this).data('href');
        //     $('#modalAddActivityDelay').modal('show');
        //     $.get(url, function (data) {
        //         $('#modalAddActivityDelay #contentModal').html(data.delay_form);
        //         $('.selectpicker').selectpicker();
        //         datetimepicker();
        //     });
        // });

        // $(document).on('submit', '#formActivityDelayAdd', function (e) {
        //     e.preventDefault();
        //
        //     var form = $(this).serialize();
        //     var url = $(this).attr('action');
        //     $.ajax({
        //         url: url,
        //         data: form,
        //         type: 'post',
        //         beforeSend: function () {
        //             $('.loader').show();
        //             $('#btn-add-activity-delay').attr('disabled', true);
        //         },
        //         success: function (data) {
        //             $('#btn-add-activity-delay').attr('disabled', false);
        //             $('.loader').hide();
        //             if (data.success == true) {
        //                 myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
        //                 $('#modalAddActivityDelay').modal('hide');
        //                 $('#activity_delay_content').empty();
        //                 $('#activity_delay_content').html(data.html);
        //
        //             } else if (data.success == false) {
        //                 myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
        //             }
        //         },
        //         error: function (data) {
        //         }
        //     });
        // });
        //
        // $(document).on('submit', '#formActivityDelayUpdate', function (e) {
        //     e.preventDefault();
        //
        //     var form = $(this).serialize();
        //     var url = $(this).attr('action');
        //     $.ajax({
        //         url: url,
        //         data: form,
        //         type: 'post',
        //         beforeSend: function () {
        //             $('.loader').show();
        //             $('#btn-add-activity-delay').attr('disabled', true);
        //         },
        //         success: function (data) {
        //             $('#btn-add-activity-delay').attr('disabled', false);
        //             $('.loader').hide();
        //             if (data.success == true) {
        //                 myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
        //                 $('#modalEditActivityDelay').modal('hide');
        //                 $('#activity_delay_content').empty();
        //                 $('#activity_delay_content').html(data.html);
        //
        //             } else if (data.success == false) {
        //                 myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
        //             }
        //         },
        //         error: function (data) {
        //         }
        //     });
        // });
        //
        //
        //
        //
        // $(document).on('click', '.btn-edit-delay', function () {
        //     var url = $(this).data('href');
        //     $('#modalEditActivityDelay').modal('show');
        //     $.get(url, function (data) {
        //         $('#modalEditActivityDelay #contentModal').html(data.delay_form);
        //         $('.selectpicker').selectpicker();
        //         datetimepicker();
        //     });
        // });


        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        

        
        
        
        
        


        // $(document).on('click', '#previous-delay-tab', function () {
        //     $('[href="#activity_delay"]').click();
        // });
        $(document).on('click', '#previous_activity_staff', function () {
            $('[href="#activity_staff"]').click();
        })

        // $(document).on('click', '#btnNextُُُExplainAchievement', function () {
        //     $('[href="#explain_achievement_div"]').click();
        //
        // })

        // $(document).on('click', '#btnNextDelay', function () {
        //     $('[href="#activity_delay"]').click();
        // })


        // $(document).on('submit', '#formAddActivityAchievement', function (e) {
        //     e.preventDefault();
        //     var form = $(this).serialize();
        //     var url = $(this).attr('action');
        //     $.ajax({
        //         url: url,
        //         data: form,
        //         type: 'post',
        //         beforeSend: function () {
        //             $('.loader').show();
        //             $('#addActivityAchievement').attr('disabled', true);
        //         },
        //         success: function (data) {
        //             $('.loader').hide();
        //             $('#addActivityAchievement').attr('disabled', false);
        //             myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
        //         },
        //         error: function (data) {
        //         }
        //     });
        // });


        $(document).on('keyup', '.bs-searchbox input', function () {
            var value = $(this).val();
            var type = $(this).first().parent().parent().parent().children('select').attr('id');
            if (type == 'ben_id') {
                getBeneficiaryByAjax(value);
            }

        });

        function getBeneficiaryByAjax(value) {
            var activity_id = $('#formActivityMainAdd #id').val();

            if (project_id === undefined && activity_id === undefined) {
                activity_id = $('#formSubActivity #id').val();
            }
            url = '<?php echo e(route('activity.beneficiaries.getBeneficiaryByName')); ?>';
            data = 'name=' + value + '&activity_id=' + activity_id;
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'json',
                data: data,
                success: function (data) {
                    console.log(data);
                    selectBeneficiary(data);
                }

            })
        }

        function selectBeneficiary(data) {
            $("#formAddActivityBeneficiaries #beneficiary_id option").remove();
            $('#formAddActivityBeneficiaries #beneficiary_id').selectpicker('refresh');
            $.each(data, function (index, value) {
                var name = value.id + "-" + value.type;
                var name_ben = 'ben_name_' + '<?php echo e(lang_character()); ?>' + '_id';
                $("#formAddActivityBeneficiaries #beneficiary_id")
                    .append('<option name=' + name + ' value=' + value.id + 'ben-type=' + value.type + '>' + name_ben + '</option>');
            });
            $('#beneficiary_id').selectpicker('refresh');
        }


        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        

        





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
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    
    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>

    <?php if(\Illuminate\Support\Facades\Auth::user()->lang_id ==2): ?>
        <script src="<?php echo e(asset('js/wizard-rtl.js')); ?>"></script>
    <?php else: ?>
        <script src="<?php echo e(asset('js/wizard.js')); ?>"></script>

    <?php endif; ?>

    <script src="<?php echo e(asset('assets/js/plugins/ckeditor/ckeditor.js')); ?>"></script>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>