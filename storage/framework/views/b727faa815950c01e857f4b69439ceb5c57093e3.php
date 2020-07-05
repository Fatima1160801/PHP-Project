<?php $__env->startSection('content'); ?>

    <div class="col-md-12 col-12 mr-auto ml-auto">
        <div class="card card-wizard" data-color="rose" id="createTaskWizard">

            <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
            <div class="card-header text-center">
                <h3 class="card-title">
                    <?php echo e($labels['opportunity_title'] ?? 'Opportunity'); ?>

                </h3>
                <h5 class="card-description"></h5>
            </div>
            <div class="wizard-navigation">
                <ul class="nav nav-pills">
                    <li class="nav-item" id="task_link" data-task-id="">
                        <a class="nav-link active" href="#main_info" data-toggle="tab" role="tab">
                            <?php echo e($labels['opportunity_label'] ?? 'opportunity'); ?>


                        </a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href="#assigned_to" data-toggle="tab" role="tab">
                            Assigned To
                        </a>
                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link" href="#comments" data-toggle="tab" role="tab">
                            <?php echo e($labels['notes_label'] ?? 'Notes'); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#log_hour" data-toggle="tab" role="tab">
                            <?php echo e($labels['attachments'] ?? 'attachments'); ?>

                        </a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="main_info">
                        <div id="task_main_info">
                            <?php if($page_action=="edit"): ?>
                            <?php echo Form::open(['route' => 'opportunity.update' ,'action'=>'post' ,'id'=>'formOpportinunityCreate']); ?>

                            <?php else: ?>
                            <?php echo Form::open(['route' => 'opportunity.store' ,'action'=>'post' ,'id'=>'formOpportinunityCreate']); ?>

                            <?php endif; ?>

                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <div class="col-md-6 opp-progress-status" style="display: none;">
                                <h6 style="text-transform: capitalize;font-weight: bold;"><?php echo e($labels['opp_status_label'] ?? 'Status'); ?> : <span style="text-transform: capitalize;font-weight:normal;" id="progress-stage">In progress</span></h6>
                                <h6 style="text-transform: capitalize;font-weight: bold;"><?php echo e($labels['opp_createdby_label'] ?? 'Created By'); ?> : <span id="progress-by" style="text-transform: capitalize;font-weight: normal;"><?php echo e(Auth::user()->user_full_name ?? ""); ?></span></h6>

                            </div>

                            <div class="col-md-12 opp-progress-approve-reject" id="fill-opp-progress-approve-reject">
                                <h6 style="text-transform: capitalize;font-weight: bold;" class="pull-left mr-5"><?php echo e($labels['opp_status_label'] ?? 'Status'); ?> : <span style="text-transform: capitalize;font-weight:normal;color:<?php echo e($opportunity->status_color); ?>;" id="title-app-rej"><?php if($page_action=="edit"): ?> <?php echo e($opportunity->statusInfo ? ($opportunity->statusInfo->{'opportunity_status_'.lang_character()} ? $opportunity->statusInfo->{'opportunity_status_'.lang_character()} :""):""); ?><?php else: ?> <?php endif; ?></span></h6>
                                <h6 style="text-transform: capitalize;font-weight: bold;" class="pull-left mr-5"><?php echo e($labels['opp_by_label'] ?? 'By'); ?> : <span id="title-app-rej-by" style="text-transform: capitalize;font-weight: normal;color:<?php echo e($opportunity->status_color); ?>;"><?php echo e($opportunity->status_by); ?></span></h6>
                                <h6 style="text-transform: capitalize;font-weight: bold;" class="pull-left mr-5"><?php echo e($labels['opp_date_label'] ?? 'Date'); ?> : <span id="title-app-rej-date" style="text-transform: capitalize;font-weight: normal;color:<?php echo e($opportunity->status_color); ?>;"><?php echo e($opportunity->status_at); ?></span></h6>
                                <h6 style="text-transform: capitalize;font-weight: bold;" class="pull-right mr-5"><?php echo e($labels['opp_createdby_label'] ?? 'Created By'); ?> : <span id="title-create-by" style="text-transform: capitalize;font-weight: normal;"><?php if($page_action=="edit"): ?> <?php echo e($opportunity->createdByInfo ? ($opportunity->createdByInfo->user_full_name ? $opportunity->createdByInfo->user_full_name :""):""); ?><?php else: ?> <?php endif; ?></span></h6>
                                <div class="clearfix"></div>
                            </div>


                            <?php echo $html; ?>




                                <input type="hidden" name="arr_members" id="arr_members" value="">
                                <input type="hidden" name="arr_jobs" id="arr_jobs" value="">


                                <div class="col-md-12">
                                    <div class="card-footer ml-auto mr-auto">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10" >
                                            <table id="table" class="drawTable table"><thead><tr><th style="width: 40%"><?php echo e($labels['team_members'] ?? 'Team Members'); ?></th><th style="width: 40%"><?php echo e($labels['job_title'] ?? 'Job Title'); ?></th><th style="width: 20%"><?php echo e($labels['actions'] ?? 'actions'); ?></th></tr></thead><tbody class="appendRows">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-1"></div>
                                </div>
                                </div>


                            <input type="hidden" value="<?php if($page_action=="edit"): ?><?php echo e($email_list??""); ?> <?php else: ?> <?php endif; ?>" name="follower_email" id="follower_email">
                                <input id="fixed_status_val" type="hidden" value="<?php if($page_action=="edit"): ?> <?php echo e($opportunity->opportunity_status_id ?? 1); ?><?php else: ?> 1 <?php endif; ?>" />

                            <br>
                            <div class="col-md-12">
                                <input type="hidden" id="activity_start_date" value="">
                                <a href="#" class="btn btn-next btn-rose pull-right btn-sm" id="nextProjectMain">
                                    <?php echo e($labels['next'] ?? 'next'); ?>

                                </a>

                                <button type="button" id="rejectBtn" data-toggle="modal" data-target="#opportunityApproveConfirmModal"  class="btn btn-danger  btn-sm pull-right">
                                    <?php echo e($labels['opportunity_reject'] ?? 'Reject'); ?>


                                    <div class="pull-left" style="display: none;"></div>
                                </button>

                                <a href="#" id="cancelRejectBtn" class="btn btn-danger  btn-sm pull-right">
                                    <?php echo e($labels['opportunity_cancel_reject'] ?? 'Cancel reject'); ?>


                                    <div class="pull-left" style="display: none;"></div>
                                </a>

                                <button type="button" data-toggle="modal" data-target="#opportunityApproveConfirmModal" id="approveBtn" class="btn btn-success  btn-sm pull-right">
                                    <?php echo e($labels['opportunity_approve'] ?? 'Approve'); ?>


                                    <div class="pull-left" style="display: none;"></div>
                                </button>

                                <button href="#"  id="cancelApproveBtn"  class="btn btn-success  btn-sm pull-right">
                                    <?php echo e($labels['opportunity_cancel_approve'] ?? 'Cancel approve'); ?>


                                    <div class="pull-left" style="display: none;"></div>
                                </button>

                                <button href="#"  id="deleteApporBtn"  class="btn btn-danger  btn-sm pull-right">
                                    <?php echo e($labels['opportunity_delete'] ?? 'Delete'); ?>

                                    <div class="pull-left" style="display: none;"></div>
                                </button>

                                <button type="submit" id="saveTaskbtn" class="btn btn-primary  btn-sm pull-right">
                                    <?php echo e($labels['save'] ?? 'save'); ?>


                                    <div class="loader pull-left" style="display: none;"></div>
                                </button>

                                <a href="#" style="display: none;" id="addProposalLink" class="btn btn-primary  btn-sm pull-right">
                                    <?php echo e($labels['add_proposal_label'] ?? 'Add Proposal'); ?>

                                    <div class="pull-left" style="display: none;"></div>
                                </a>

                                <a href="#" style="display: none;" id="addConceptLink" class="btn btn-primary  btn-sm pull-right">
                                    <?php echo e($labels['add_concept_label'] ?? 'Add Concept'); ?>

                                    <div class="pull-left" style="display: none;"></div>
                                </a>

                                <span id="display-reference-link"></span>

                                <a href="<?php echo e(route('opportunity.opportunity.index')); ?>" class="btn btn-sm btn-default pull-left"
                                   id="nextProjectMain2">
                                    <?php echo e($labels['back'] ?? 'back'); ?>

                                    <div class="ripple-container"></div>
                                </a>

                            </div>


                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                    <div class="tab-pane" id="assigned_to">
                        <div id="assigned_to_content">
                            <div align="center" id="loader-icon-a" class="col-md-12">
                                <div class="loader loader-div"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="comments">
                        <div id="comments_content">
                            <div align="center" id="loader-icon-c" class="col-md-12">
                                <div class="loader loader-div"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="log_hour">
                        <?php
                        $id__ = 0;
                        if($page_action=="edit"){
                         $id__ = $opportunity->id;
                         }
                         ?>

                        <input type="hidden" id="object_primary_id" value="<?php echo e($id__); ?>">

                       <div id="attachments_fixed_div"></div>
                       <div id="attachments_not_fixed_div"></div>
                        <div align="center" id="loader-icon-l" class="col-md-12">
                            <div class="loader loader-div"></div>
                        </div>

                    </div>


                    
                        
                        
                        

                        
                    

                </div>
            </div>
            <div class="card-footer">
                <div class="mr-auto">

                </div>
                <div class="ml-auto">

                    <input type="button" class="btn btn-finish btn-fill btn-rose btn-wd" name="finish" value="Finish"
                           style="display: none;">
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>


    <!-- ==============================================  Modals  ======================================================= -->



    <!-- ==============================================  Comments Modal  ======================================================= -->

    <div class="modal fade" id="taskCommentsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-signup" role="document">
            <div class="modal-content">
                <div class="card card-signup card-plain">
                    <div class="modal-header">
                        <h5 class="modal-title card-title" id="comments_modal_title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">clear</i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <?php echo Form::open(['route' => 'tasks_comments.store' ,'action'=>'post' ,'id'=>'formAddComment']); ?>

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div id="taskCommentsModalForm"></div>

                        <ul class="fileList"></ul>
                        <div class="col-md-12">
                            <div class="card-footer ml-auto mr-auto">
                                <div class="ml-auto mr-auto">
                                    <a id="modal-dismiss-f" href="#" class="btn btn-default">
                                        <?php echo e($labels['cancel'] ?? 'cancel'); ?>

                                    </a>
                                    <button type="submit" class="btn btn-next btn-rose pull-right">
                                        <div class="loader pull-left" style="display: none;"></div>
                                        <?php echo e($labels['save'] ?? 'save'); ?>

                                    </button>
                                </div>
                            </div>
                        </div>


                        <?php echo Form::close(); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="opportunityNoteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="card card-signup card-plain">
                    <div class="modal-header">
                        <h5 class="modal-title card-title" id="comments_modal_title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">clear</i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <?php echo Form::open( ['route' => 'opportunity.note.update','action'=>'post' ,'id'=>'formEditComment']); ?>

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>


                        <label for='edit_note' class='col-form-label'>Description</label>
                        <div class='form-group has-default bmd-form-group'>
                            <textarea class='form-control' rows="10" name='note' id='edit_note' required minLength='0' maxLength='1000' aria-required="true" aria-invalid="false" ></textarea>
                            <input type="hidden" value="" id="edit_note_id"  name="note_id">
                        </div>

                        <div class="col-md-12">
                            <div class="card-footer ml-auto mr-auto">
                                <div class="ml-auto mr-auto">
                                    <a id="modal-dismiss-f" href="#" data-dismiss="modal" aria-label="Close" class="close btn btn-sm btn-default">
                                        <?php echo e($labels['cancel'] ?? 'cancel'); ?>

                                    </a>
                                    <button type="submit" class="btn btn-next btn-sm  btn-rose pull-right">
                                        <div class="loader pull-left" style="display: none;"></div>
                                        <?php echo e($labels['save'] ?? 'save'); ?>

                                    </button>
                                </div>
                            </div>
                        </div>


                        <?php echo Form::close(); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="opportunityApproveConfirmModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="card card-signup card-plain">
                    <div class="modal-header">
                        <h5 class="modal-title card-title" id="comments_modal_title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">clear</i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <?php echo Form::open(['route' => 'opportunity.approve.reject' ,'action'=>'post' ,'id'=>'formOppStatusChange']); ?>

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                       <h3 class="text-center p-2 bolder" id="approved_reject_title"></h3>

                        <div class="col-md-12">
                            <label for="edit_note" class="col-form-label bolder">Date :</label>
                            <label for="edit_note" class="col-form-label"><?php echo e(\Carbon\Carbon::now('Asia/Gaza')->format('Y-m-d')); ?>,<?php echo e(\Carbon\Carbon::now('Asia/Gaza')->format('H:i A')); ?></label>
                        </div>
                        <div class="col-md-12">
                            <label for='edit_note' class='col-form-label bolder'>Note</label>
                            <div class='form-group has-default bmd-form-group'>
                                <textarea class='form-control'  name='note' id='approved_reject_note' ></textarea>
                                <input type="hidden" value="" name="type" id="approved_reject_type">
                                <input type="hidden" value="" name="opp_id" id="approved_reject_opp_id">
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="card-footer ml-auto mr-auto">
                                <div class="ml-auto mr-auto">
                                    <a id="modal-dismiss-f" href="#" class="btn btn-sm btn-default">
                                        <?php echo e($labels['cancel'] ?? 'cancel'); ?>

                                    </a>
                                    <button type="submit" class="btn btn-next btn-sm btn-rose pull-right">
                                        <div class="loader pull-left" style="display: none;"></div>
                                        <?php echo e($labels['save'] ?? 'save'); ?>

                                    </button>
                                </div>
                            </div>
                        </div>


                        <?php echo Form::close(); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="taskLoghourModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-signup" role="document">
            <div class="modal-content">
                <div class="card card-signup card-plain">
                    <div class="modal-header">
                        <h5 class="modal-title card-title" id="logour_modal_title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">clear</i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <?php echo Form::open(['route' => 'tasks_loghour.store' ,'action'=>'post' ,'id'=>'formAddLogour']); ?>

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div id="taskLoghourModalForm"></div>

                        <ul class="fileList"></ul>
                        <div class="col-md-12">
                            <div class="card-footer ml-auto mr-auto">
                                <div class="ml-auto mr-auto">
                                    <a id="modal-dismiss-l" href="#" class="btn btn-default">
                                        <?php echo e($labels['cancel'] ?? 'cancel'); ?>

                                    </a>
                                    <button type="submit" class="btn btn-next btn-rose pull-right">
                                        <div class="loader pull-left" style="display: none;"></div>
                                        <?php echo e($labels['save'] ?? 'save'); ?>

                                    </button>
                                </div>
                            </div>
                        </div>


                        <?php echo Form::close(); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
   if($page_action=="edit"){
    $data_team_id = [];
    $data_job_id = [];
    foreach($team_jobs as $team_job){

        $data_team_id[] = $team_job->staff_id;
        $data_job_id[] = $team_job->c_job_title_id;
    }
    }else{
        $data_team_id = [];
        $data_job_id = [];
    }

    ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            active_nev_link('tasks');

            funValidateForm();

            $("#deadline").on("dp.change", function (e) {
               // $('#expected_funder_feedback_dt').data("DateTimePicker").minDate(e.date);
            });

            $("#expected_funder_feedback_dt").on("dp.change", function (e) {
                //$('#deadline').data("DateTimePicker").maxDate(e.date);
            });

            // $("#start_date").on("dp.change", function (e) {
            //     $('#end_date').data("DateTimePicker").minDate(e.date);
            // });
            //
            // $("#end_date").on("dp.change", function (e) {
            //     //        $('#start_date').data("DateTimePicker").maxDate(e.date);
            // });

            $('#task_status_id').val(1).change();
            $('#task_priority_id').val(1).change();
            $('.selectpicker').selectpicker();

            datetimepicker();

            $("#deadline").on("dp.change", function (e) {
                $('#deadline').data("DateTimePicker").minDate(new Date());
            });

            //    $('#activity_start_date').val($('#activity_id').val());

            $('a[href="#log_hour"]').click(function () {
             //$('a[href="#attachments"]').click(function () {

                var primary_id = '<?php echo e($primary_id); ?>';
                //alert(primary_id+"h6");
                if (primary_id == 0) {
                    primary_id = $('#object_primary_id').val();
                   // alert(primary_id+"j6");
                }
                //alert(primary_id+"k6");

                get_fiexd_attachments(primary_id,'<?php echo e($activity_type); ?>',0,0);
                get_not_fixed_attachments(primary_id,'<?php echo e($activity_type); ?>');
                 
                
                    

                    
                        
                            
                            
                        
                    
                    
                
            });





            wizard();

            var app_st='<?php echo e($opportunity->opportunity_status_id ?? 1); ?>';
           <?php if($page_action=="edit"): ?>
                 fillJobTitle();
                 buttonControl(app_st);
                 <?php if($has_ref==true): ?>
                     displayReference();
                <?php endif; ?>

           <?php else: ?>
           buttonControlCreate();
           $(".opp-progress-approve-reject").html("");
            setTimeout(function(){
                $("#nextProjectMain").css("display","none");
            }, 500);
           <?php endif; ?>

           <?php if($closed_opport=="closed"): ?>
           disabledAllForm();
           <?php endif; ?>
           //if status approve add concept/proposal show
           var edit_status='<?php echo e($opportunity->opportunity_status_id ?? 1); ?>';
           if(edit_status==2){
               switchConceptProposal();
           }
        });


        
        
        
        
        
        

        
        
        

        $(document).on('change', '#project_id', function (e) {
            e.preventDefault();
            var pid = $(this).val();
            if (pid != '' && pid != null && pid != 0) {
                var url = '<?php echo e(route('task.getActivitiesList')); ?>' + '/' + pid;
                $.get(url, function (response) {
                    $('#activity_id').attr('disabled', false);
                    $('#activity_id').html(response);
                    $('#activity_id').selectpicker('refresh');
                });
            } else {
                $('#activity_id').html();
                $('#activity_id').attr('disabled', true);
            }
        })

        $(document).on('change', '#activity_id', function (e) {
            e.preventDefault();
            var aid = $(this).val();

            //   $('#result_id').selectpicker('refresh');
            var url__ = '<?php echo e(route('task.getSubActivitiesList')); ?>' + '/' + aid;
            $.ajax({
                url: url__,
                dataTypes: 'html',
                type: 'get',
                beforeSend: function () {
                    $('#sub_activity_id option').remove();
                    $('#sub_activity_id').html('<option value=""></option>');
                    $('#sub_activity_id').selectpicker('refresh');


                },
                success: function (data) {
                    if (data.status == true) {
                        $('#sub_activity_id').html(data.html);
                        $('#sub_activity_id').removeAttr('disabled');
                        $('#sub_activity_id').attr('required', 'required');
                        $('#sub_activity_id').selectpicker('refresh');
                    } else {
                        $('#sub_activity_id').empty();
                        $('#sub_activity_id').html('<option value=""></option>');
                        $('#sub_activity_id').attr('disabled', 'disabled');
                        $('#sub_activity_id').removeAttr('required', 'required');
                        $('#sub_activity_id').selectpicker('refresh');
                    }

                },
                error: function () {

                }
            });

            fill_assigned_staffs(aid);

            
            
            
            
            
            

            
            

            
            
            
            
            

            
            
            

            
            

            
            

        });

        function fill_assigned_staffs(activity_id) {
            var url = '<?php echo e(route('task.getStaffByActivityID')); ?>' + '/' + activity_id;
            $.ajax({
                url: url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                    $('#assigned_staffs option').remove();
                    $('#assigned_staffs').html('<option value=""></option>');
                    $('#assigned_staffs').selectpicker('refresh');

                },
                success: function (data) {
                    if (data.status == true) {
                        $("#assigned_staffs").append("<option value=''></option>");
                        $.each(data.staff, function (index, value) {
                            $("#assigned_staffs").append('<option value=' + index + '>' + value + '</option>');
                        });
                        $('#assigned_staffs').selectpicker('refresh');
                    }
                },
                error: function () {

                }
            });
        }

        $(document).on('change', '#sub_activity_id', function (e) {
            e.preventDefault();
            var aid = $(this).val();
            fill_assigned_staffs(aid);
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            

            
            

            
            
        });


        $(document).on('submit', '#formOpportinunityCreate', function (e) {

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
                    // $('#saveTaskbtn').prop("disabled", true);
                    $('.loader').show();
                },
                success: function (data) {
                    //$('#saveTaskbtn').removeAttr("disabled");
                    if (data.status == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        buttonControl(1);
                        var editswitch='<?php echo e(route('opportunity.update')); ?>';
                        $("#formOpportinunityCreate").attr('action',editswitch);
                         $('#task_link').attr('data-task-id', data.opp_id);
                       // alert(data.opp_id);
                         $('#object_primary_id').val(data.opp_id);
                        $('#id').val(data.opp_id);
                         //$('.opp-progress-status').show();
                        buttonControl(1);
                        $("#formOpportinunityCreate").attr("action","<?php echo e(route('opportunity.update')); ?>");
                        $('#rejectBtn').show();
                        $('#approveBtn').show();
                        $('#nextProjectMain').css("display","block");
                    } else if (data.status == false) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').hide();

                },
                error: function (data) {
                }
            });
        });



        $(document).on('submit', '#formTaskCreate', function (e) {

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
                    // $('#saveTaskbtn').prop("disabled", true);
                    $('.loader').show();
                },
                success: function (data) {
                    //$('#saveTaskbtn').removeAttr("disabled");
                    if (data.success == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#task_link').attr('data-task-id', data.tid);
                        $('#object_primary_id').val(data.tid);
                    } else if (data.success == false) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').hide();

                },
                error: function (data) {
                }
            });
        });


        $(document).ready(function () {
            $('.selectpicker').selectpicker();
            datetimepicker();

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

        });


        $(document).on('submit', '#formTaskUpdate', function (e) {

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
                    // $('#saveTaskbtn').prop("disabled", true);
                    $('.loader').show();
                },
                success: function (data) {
                    //$('#saveTaskbtn').removeAttr("disabled");
                    if (data.success == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    } else if (data.success == false) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').hide();

                },
                error: function (data) {
                }
            });
        });


        $(document).on('submit', '#formAssignStaff', function (e) {

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
                    // $('#saveTaskbtn').prop("disabled", true);
                    $('.loader').show();
                },
                success: function (data) {
                    //$('#saveTaskbtn').removeAttr("disabled");
                    if (data.success == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#assignStaffModal').modal('hide');
                        $('#loader-icon').show();
                        loadAssignedTo();
                    } else if (data.success == false) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').hide();

                },
                error: function (data) {
                }
            });

        });

        $(document).on('submit', '#formAddLogour', function (e) {
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
                    $('.loader').show();
                },
                success: function (data) {
                    if (data.success == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#taskLoghourModal').modal('hide');
                        $('#loader-icon-l').show();
                        loadLoghour();
                    } else if (data.success == false) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').hide();
                },
                error: function (data) {
                }
            });

        });


        $(document).on('submit', '#formAddComment', function (e) {
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
                    $('.loader').show();
                },
                success: function (data) {
                    //$('#saveTaskbtn').removeAttr("disabled");
                    if (data.success == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('#taskCommentsModal').modal('hide');
                        $('#loader-icon-c').show();
                        loadComments();
                    } else if (data.success == false) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').hide();
                },
                error: function (data) {
                }
            });
        });

        $(document).on('click', '#btnAddComment', function () {
            var task_id = $('#task_link').attr('data-task-id');
            var url_ = '<?php echo e(route('tasks_comments.create')); ?>' + '/' + task_id;
            $.get(url_, function (response) {
                $('#taskCommentsModalForm').html(response);
                $('.selectpicker').selectpicker();
                $('#formAddComment input[name="task_id"]').val(task_id);
                $('#formAddComment input[name="staff_id"]').val('<?php echo e(Auth::id()); ?>');
            });
            $('#taskCommentsModal').modal('show');
            $('#comments_modal_title').html('Add New Comment');
        });


        $(document).on('click', '.btnEditOpportunityNote', function () {
            //btnEditTaskComment
            $("#opportunityNoteModal #edit_note").text("");
            var note = $(this).attr('data-note');
            var id = $(this).attr('data-noteid');
            $("#opportunityNoteModal #edit_note").text(note);
            $("#opportunityNoteModal #edit_note").val(note);
            $("#opportunityNoteModal #edit_note_id").val(id);
            $('#comments_modal_title').html('Edit Comment');
        });

        $(document).on('click', '#btnAddLogHour', function (e) {
            e.preventDefault();
            var task_id = $('#task_link').attr('data-task-id');
            var url_ = '<?php echo e(route('tasks_loghour.create')); ?>' + '/' + task_id;
            $.get(url_, function (response) {
                $('#taskLoghourModalForm').html(response.html);
                $('.selectpicker').selectpicker();
                $('#formAddLogour input[name="task_id"]').val(task_id);
                $('#formAddLogour input[name="staff_id"]').val('<?php echo e(Auth::id()); ?>');
                datetimepicker();
                $('#log_date').data("DateTimePicker").minDate($('#activity_start_date').val());
                datetimepicker();
            });
            $('#taskLoghourModal').modal('show');
            $('#logour_modal_title').html(response.labels.add_log_hour)
        });

        $(document).on('click', '.btnEditTaskLogHour', function () {
            var url_ = $(this).attr('data-href');
            var task_id = $('#task_link').attr('data-task-id');
            $.get(url_, function (response) {
                $('#taskLoghourModalForm').html(response);
                $('.selectpicker').selectpicker();
                $('#formAddLogour input[name="task_id"]').val(task_id);
                $('#formAddLogour input[name="staff_id"]').val('<?php echo e(Auth::id()); ?>');
                $('#log_date').data("DateTimePicker").minDate($('#activity_start_date').val());
                datetimepicker();
            });
            $('#taskLoghourModal').modal('show');
            $('#logour_modal_title').html('Add Log Hour');
        });

        $('#assignStaffModal #modal-dismiss-f').click(function () {
            $('#assignStaffModal .close').click();
        });

        $('#taskCommentsModal #modal-dismiss-f').click(function () {
            $('#taskCommentsModal .close').click();
        });

        $('#taskLoghourModal #modal-dismiss-l').click(function () {
            $('#taskLoghourModal .close').click();
        });

        $(document).on('click', '.btnAssignedTaskDelete', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                text: '<?php echo e(getMessage('2.73')['text']); ?>',
                confirmButtonClass: 'btn btn-success btn-sm',
                cancelButtonClass: 'btn btn-danger btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    // var project_id = $('#formProjectMain #id').val();
                    url = $(this).attr('data-href');
                    $.ajax({
                        url: url,
                        type: 'delete',
                        beforeSend: function () {
                        },
                        success: function (data) {
                            if (data.status == 'true') {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
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


        $(document).on('click', '.btnCommentTaskDelete', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                text: '<?php echo e(getMessage('2.76')['text']); ?>',
                confirmButtonClass: 'btn btn-success btn-sm',
                cancelButtonClass: 'btn btn-danger btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    // var project_id = $('#formProjectMain #id').val();
                    url = $(this).attr('data-href');
                    $.ajax({
                        url: url,
                        type: 'delete',
                        beforeSend: function () {
                        },
                        success: function (data) {
                            if (data.status == 'true') {
                                $($this).closest('li').delay(1000).hide(1000);
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


        $(document).on('click', '.btnLoghourTaskDelete', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                text: '<?php echo e(getMessage('2.66')['text']); ?>',
                confirmButtonClass: 'btn btn-success btn-sm',
                cancelButtonClass: 'btn btn-danger btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    // var project_id = $('#formProjectMain #id').val();
                    url = $(this).attr('data-href');
                    $.ajax({
                        url: url,
                        type: 'delete',
                        beforeSend: function () {
                        },
                        success: function (data) {
                            if (data.status == 'true') {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
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

        function loadProgress() {

        }


        function wizard() {
            taskCreateWizard.initMaterialWizard();
            setTimeout(function () {
                $('#createTaskWizard').addClass('active');
            }, 100);
        }

        function loadComments() {
            //var form = $(this).serialize();
             var task_id = $('#object_primary_id').val();
            var url = '<?php echo e(route('opportunity.note.index')); ?>' + '/' + task_id;
            $.ajax({
                url: url,
                // dataTypes: 'json',
                data: '',
                type: 'get',
                beforeSend: function () {
                    $('#loader-icon-c').show();

                },
                success: function (response) {
                    $('#comments_content').html(response);
                    $('#loader-icon-c').hide();
                    $('#note_opp_id_input').val($('#object_primary_id').val());

                },
                error: function (response) {
                    $('#loader-icon-c').hide();
                }
            });

          
            
            
            
                
                
                
                    
                        
                        
                    
                
                
            
        }


        function loadDocuments() {
           // var task_id = $('#task_link').attr('data-task-id');
            var task_id = 1;
            var url = '<?php echo e(route('opportunity.document.index')); ?>' + '/' + task_id;
            $.get(url, function (response) {
                $('#loader-icon-l').hide();
                $('#log_hour_content').html(response);
                setTimeout(function () {
                    $('#btn_collapse_loghour').click();
                }, 500);
                /*$('#task-comments-table').DataTable({
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records",
                    }
                });*/
                $('[data-toggle="tooltip"]').tooltip();
                setTimeout(function(){
                    $("#document_type_id").selectpicker();
                    $('#table').DataTable({
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search records"
                        }
                    });
                    $('[data-toggle="tooltip"]').tooltip();

                    // DataTableCall('#table', 5);
                    }, 500);


            });
        }

        function loadLoghour() {

            var task_id = $('#task_link').attr('data-task-id');
            var url = '<?php echo e(route('tasks_loghour.index')); ?>' + '/' + task_id;
            $.get(url, function (response) {
                $('#loader-icon-l').hide();
                $('#log_hour_content').html(response);
                setTimeout(function () {
                    $('#btn_collapse_loghour').click();
                }, 500);
                /*$('#task-comments-table').DataTable({
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records",
                    }
                });*/
                $('[data-toggle="tooltip"]').tooltip();
            });
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
     /////////////////////////////////////////////////
        $('#member_ids').on('change', function (e) {
            var mem_label="<?php echo e($labels['opp_member_label'] ?? 'Member'); ?>";
            var job_label="<?php echo e($labels['opp_job_label'] ?? 'Job title'); ?>";
            $head='<div class="col-md-8 m-auto" id="job_table">' +
                '    <table class="table table-hover">' +
                '        <thead>' +
                '        <tr>' +
                '            <th width="30%">'+mem_label+'</th>' +
                '            <th width="10%"></th>' +
                '            <th width="60%">'+job_label+'</th>' +
                '        </tr>' +
                '        </thead>' +
                '        <tbody id="p_courses">';

            $fotter='  </tbody>' +
                '    </table>' +
                '</div>';
            $item='';
            $("#job_table").remove();
            var job_lists = <?php echo json_encode($job_lists, 15, 512) ?>;
            var itemList=[];
            $.each(job_lists, function (index, value) {
               itemList+='<option value=' + index + '>' + value + '</option>';
            });


            var countries = [];

            $("#member_ids option:selected").each(function () {
                var $this = $(this);
                if ($this.length) {
                    var selText = $this.text();
                    var selVal= $this.val();
                   // var ttt= $("#job_list_select_"+selVal+" option:selected" ).val();
                 //   countries.push(selVal);

                    $item+=
                        '<tr><td>'+selText+'</td>' +
                        ' <td><input type="hidden"  value="'+selVal+'"  name="m_id[]"></td>' +
                        '<td>' +
                    '<div class="col-md-12">'+
                    '<div class="row">'+
                    '<div class="col-md-8">'+
                    '<div class="form-group has-default bmd-form-group">'+
                    '<select class="form-control  selectpicker new_job_list" name="jobtitle[]" data-style="btn btn-link" id="job_list_select_'+selVal+'">';
                     // var sel_id=$("#job_list_select_"+selVal) ;
                    $saved=$("#job_list_select_"+selVal+" option:selected" ).val();
                    console.log($saved);
                    $item+='<option  style="height: 37px;" value></option>' + itemList + '  ' ;

                    $("#job_list_select_"+selVal+" option:eq("+$saved+")");
                   // $('.selDiv option:eq(1)')

                    // if($("#job_list_select_"+selVal+" option:selected" ).val() !="") {
                    //          $item+='<option  style="height: 37px;" value></option>' + itemList + '  ' ;
                    //      }else{
                    //          $item+=$("#job_list_select_"+selVal).html();
                    //      }
                    $item+='</select>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+

                    '</td>' +
                    '</tr>'
                }else{
                }
            });
            //
            // $.each($(".new_job_list  option:selected"), function(){
            //     countries.push($(this).val());
            // });
            // console.log(countries);

           // var ggg=countries;
            // setTimeout(function(){
            $('.job_list_tb').append($head+$item+$fotter);

            // var countries = [];
            // $.each($(".new_job_list  option:selected"), function(){
            //     countries.push($(this).val());
            // });
            // alert("You have selected:" + countries.join(", "));

            $(".new_job_list").selectpicker();

            // $ssel=[];
            // setTimeout(function(){
            //     $.each(ggg, function(index,value){
            //         $ssel.push($("#job_list_select_"+value+" option:selected" ).val());
            //     });
            //     console.log($ssel);
            // }, 500);



        });

        $(document).on('submit', '#formAddNote', function (e) {
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
                    $('.loader').show();
                },
                success: function (data) {
                    if (data.status == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        loadComments();
                    } else if (data.status == false) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').hide();
                },
                error: function (data) {
                    $('.loader').hide();
                }
            });
        });

        $(document).on('submit', '#formEditComment', function (e) {
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
                    $('.loader').show();
                },
                success: function (data) {
                    if (data.status == true) {
                        $('#opportunityNoteModal').modal('hide');
                        $('#note-item-'+data.note_id).text(data.note);
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    } else if (data.status == false) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').hide();
                },
                error: function (data) {
                    $('.loader').hide();
                }
            });
        });

        $(document).on('submit', '#formOppStatusChange', function (e) {
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
                    $('.loader').show();
                },
                success: function (data) {
                    if (data.status == true) {
                        buttonControl(data.opp_status);
                        drawBar(data.opp_status);
                        $('#opportunityApproveConfirmModal').modal('hide');
                        if(data.opp_status==2 || data.opp_status==3){
                            disabledAllForm();
                             if(data.opp_status==2){
                                switchConceptProposal();
                             }
                        }else{
                            enabledAllForm();
                        }
                        $("#approved_reject_note").val("");
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    } else if (data.status == false) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').hide();
                },
                error: function (data) {
                    $('.loader').hide();
                }
            });
        });

        $('#user_id').on('change', function (e) {
            var emailList = [];
            $("#user_id option:selected").each(function(i){
                emailList.push($(this).text());
            });
            $("#follower_email").val(emailList.join(","));

            // var blkstr = [];
            // $.each(value, function(idx2,val2) {
            //     var str = idx2 + ":" + val2;
            //     blkstr.push(str);
            // });
        });

        $(document).on('click', '#approveBtn', function () {
            $("#opportunityApproveConfirmModal #approved_reject_title").text('<?php echo e($labels['approve_modal_title'] ?? 'Approve Opportunity '); ?>');
            $("#opportunityApproveConfirmModal #approved_reject_type").val(2);
            $("#opportunityApproveConfirmModal #approved_reject_opp_id").val($("#object_primary_id").val());

            //actions


        });

        $(document).on('click', '#rejectBtn', function () {
            $("#opportunityApproveConfirmModal #approved_reject_title").text('<?php echo e($labels['reject_modal_title'] ?? 'Reject Opportunity'); ?>');
            $("#opportunityApproveConfirmModal #approved_reject_type").val(3);
            $("#opportunityApproveConfirmModal #approved_reject_opp_id").val($("#object_primary_id").val());
        });



        function buttonControl($status){
          //  alert($status);
            //var html="";
            if($status==2){
                $("#approveBtn").hide();
                $("#cancelApproveBtn").show();
                $("#cancelRejectBtn").hide();
                $("#rejectBtn").hide();
                $("#deleteApporBtn").hide();
                //switchpropConcept

            }else if($status==3){
                $("#approveBtn").hide();
                $("#cancelApproveBtn").hide();
                $("#cancelRejectBtn").show();
                $("#rejectBtn").hide();
                $("#deleteApporBtn").hide();
            }else{//if status 1
                $("#approveBtn").show();
                $("#cancelApproveBtn").hide();
                $("#cancelRejectBtn").hide();
                $("#rejectBtn").show();
                $("#deleteApporBtn").show();
            }

           //$(".opp-progress-approve-reject").css("display","block");
        }

        function drawBar($id){
            $('#fill-opp-progress-approve-reject').fadeOut();
            var rl = '<?php echo e(url('statusControl')); ?>' + '/' + $id;

            $.get(rl, function (response) {
                if(response.status==true) {
                    $('#fill-opp-progress-approve-reject').html(response.html);
                    $('#fill-opp-progress-approve-reject').fadeIn();
                   // $(".opp-progress-approve-reject").fadeOut();
                }else{
                    $('#fill-opp-progress-approve-reject').html("");
                }
            });
        }

        function htmlEscape(str) {
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');
        }

        function buttonControlCreate(){
            $("#approveBtn").hide();
            $("#cancelApproveBtn").hide();
            $("#cancelRejectBtn").hide();
            $("#rejectBtn").hide();
            $("#deleteApporBtn").hide();

        }

     function fillJobTitle() {
        $arr= <?php echo json_encode($arrayStaff_Selected, 15, 512) ?>;
        $job= <?php echo json_encode($arrayJob_Selected, 15, 512) ?>;
          //return false;
        // console.log($arr);
        // console.log($job);
        // return false;
         var mem_label="<?php echo e($labels['opp_member_label'] ?? 'Member'); ?>";
         var job_label="<?php echo e($labels['opp_job_label'] ?? 'Job title'); ?>";
         $head='<div class="col-md-8 m-auto" id="job_table">' +
             '    <table class="table table-hover">' +
             '        <thead>' +
             '        <tr>' +
             '            <th width="30%">'+mem_label+'</th>' +
             '            <th width="10%"></th>' +
             '            <th width="60%">'+job_label+'</th>' +
             '        </tr>' +
             '        </thead>' +
             '        <tbody id="p_courses">';

         $fotter='  </tbody>' +
             '    </table>' +
             '</div>';
         $item='';
         $("#job_table").remove();
         var job_lists = <?php echo json_encode($job_lists, 15, 512) ?>;
         //console.log(job_lists);
        // return false;
         var itemList=[];
         $.each(job_lists, function (index, value) {
             itemList+='<option value=' + index + '>' + value + '</option>';
         });
         $($arr).each(function (index, value) {
             var $this = $(this);
             if ($this.length) {
                 var selVal= value;
                 var selText = $("#member_ids option[value="+selVal+"]").text();
                 var selectedJob=$job[index];
                 console.log(selVal);
                 $item+=
                     '<tr><td>'+selText+'</td>' +
                     ' <td><input type="hidden"  value="'+selVal+'"  name="m_id[]"></td>' +
                     '<td>' +
                     '<div class="col-md-12">'+
                     '<div class="row">'+
                     '<div class="col-md-8">'+
                     '<div class="form-group has-default bmd-form-group">'+
                     '<select class="form-control  selectpicker new_job_list" name="jobtitle[]" data-style="btn btn-link" id="job_list_select_'+selVal+'">';
                 // var sel_id=$("#job_list_select_"+selVal) ;
                 //$saved=$("#job_list_select_"+selVal+" option:selected" ).val();
                 $saved=$job[index];
                 //alert($saved);
                 $item+='<option  style="height: 37px;" value></option>' + itemList + '  ' ;

                 //$("#job_list_select_"+selVal+" option:eq("+$saved+")");
                 setPicker(selVal,$saved);
                ///// $( "#job_list_select_"+selVal).val($saved);
                 ////$("#job_list_select_"+selVal).selectpicker("refresh");
                // alert("#job_list_select_"+selVal);
                 // $('.selDiv option:eq(1)')

                 // if($("#job_list_select_"+selVal+" option:selected" ).val() !="") {
                 //          $item+='<option  style="height: 37px;" value></option>' + itemList + '  ' ;
                 //      }else{
                 //          $item+=$("#job_list_select_"+selVal).html();
                 //      }
                 $item+='</select>'+
                     '</div>'+
                     '</div>'+
                     '</div>'+
                     '</div>'+

                     '</td>' +
                     '</tr>'
             }else{
             }
         });
         $('.job_list_tb').append($head+$item+$fotter);
         $("#internal_loader").hide();
        // $(".new_job_list").selectpicker();

        console.log($arr);
     }
    function setPicker($id,$val) {
        setTimeout(function(){
            $( "#job_list_select_"+$id).val($val);
            $("#job_list_select_"+$id).selectpicker("refresh");
            }, 800);


    }

        $(document).on('click', '#cancelRejectBtn', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                text: '<?php echo e(getMessage('2.302')['text']); ?>',
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    url = '<?php echo e(url("opportunity/cancel/approve/reject/")); ?>'+'/'+$('#object_primary_id').val();
                    $.ajax({
                        url: url,
                        type: 'get',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == true) {
                                buttonControl(1);
                                drawBar(1);
                                enabledAllForm();
                                // $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
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
            });
        });

        $(document).on('click', '#cancelApproveBtn', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                text: '<?php echo e(getMessage('2.301')['text']); ?>',
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    url = '<?php echo e(url("opportunity/cancel/approve/reject/")); ?>'+'/'+$('#object_primary_id').val();
                    $.ajax({
                        url: url,
                        type: 'get',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == true) {
                                buttonControl(1);
                                drawBar(1);
                                enabledAllForm();
                                // $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
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
            });
        });

        $(document).on('click', '#btnOpportunityDeleteNote', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                text: 'Are you want to delete note',
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
                            if (data.status == true) {
                                $($this).closest('li.timeline-inverted').css('background', '#F44336').delay(1000).hide(1000);
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

        /*///////////*****delete Opportunity****//////////*/
        $(document).on('click', '#deleteApporBtn', function (e) {
            var status=$("#fixed_status_val").val();
            if(status==1){
            e.preventDefault();
            $this = $(this);
            swal({
                text: '<?php echo e($messageDeleteProject['text']); ?>',
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    // var project_id = $('#formProjectMain #id').val();
                    url = '<?php echo e(url("opportunity/delete/")); ?>'+'/'+$('#object_primary_id').val();
                    $.ajax({
                        url: url,
                        type: 'delete',
                        beforeSend: function () {
                        },
                        success: function (data) {
                            if (data.status == true) {
                              //  $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                                window.location.href = "<?php echo e(url('opportunity/index')); ?>";

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
            });
            }else{
                myNotify('<?php echo e($abortDelete["icon"]); ?>', '<?php echo e($abortDelete["title"]); ?>', '<?php echo e($abortDelete["type"]); ?>', '5000','<?php echo e($abortDelete["text"]); ?>');
            }
        });

        // $(function(){
        //     $('input[type="checkbox"]').click(function(){
        //         if($(this).prop("checked") == true){
        //             $('input[type="checkbox"]').prop('checked', false);
        //             $(this).prop('checked', true);
        //         }
        //     });
        // });


        // $("#deadline").on("dp.change", function (e) {
        //         $('#expected_funder_feedback_dt').data("DateTimePicker").minDate(e.date);
        //
        // });
        //
        // $("#expected_funder_feedback_dt").on("dp.change", function (e) {
        //      $('#deadline').data("DateTimePicker").maxDate(e.date);
        //
        // });


        function disabledAllForm() {
            $("#saveTaskbtn").prop("disabled", true);
            $("#deleteApporBtn").css("display", "none");
            $("#approveBtn").css("display", "none");
            $("#formOpportinunityCreate select").prop("disabled", true);
            $("#formOpportinunityCreate input").prop("disabled", true);
            $("#formOpportinunityCreate textarea").prop("disabled", true);
            $("#formOpportinunityCreate select").parent().css("background","#e9ecef");
            $("#formOpportinunityCreate input[type='text']").css("background","#e9ecef");
            $("#formOpportinunityCreate textarea").css("background","#e9ecef");
        }

        function enabledAllForm() {
            $("#saveTaskbtn").prop("disabled", false);
            $("#deleteApporBtn").css("display", "block");
            $("#approveBtn").css("display", "block");
            $("#formOpportinunityCreate select").prop("disabled", false);
            $("#formOpportinunityCreate input").prop("disabled", false);
            $("#formOpportinunityCreate textarea").prop("disabled", false);
            $("#formOpportinunityCreate select").parent().css("background","none");
            $("#formOpportinunityCreate input[type='text']").css("background","none");
            $("#formOpportinunityCreate textarea").css("background","none");
        }

        function switchConceptProposal() {
            var radioValue = $("input[name='concept_proposal_flag']:checked").val();
            if(radioValue==1){
                $("#addProposalLink").show();
                $("#addConceptLink").hide();
            }else if(radioValue==2){
                $("#addProposalLink").hide();
                $("#addConceptLink").show();
            }else{
                $("#addProposalLink").hide();
                $("#addConceptLink").hide();
            }
        }


        /*///////////*****delete Opportunity****//////////*/
        $(document).on('click', '#addProposalLink', function (e) {
           var p_id = $('#object_primary_id').val();
           if(p_id ==""){
               p_id=0;
           }
            var propUrl="<?php echo e(route('proposal.proposal.create')); ?>"+"?opp_id="+p_id;
            window.location.href = propUrl;
        });

        $(document).on('click', '#addConceptLink', function (e) {
            var p_id = $('#object_primary_id').val();
            if(p_id ==""){
                p_id=0;
            }
            var propUrl="<?php echo e(route('concept.concept.create')); ?>"+"?concept_id="+p_id;
            window.location.href = propUrl;
        });



        /////////////////////*******************////////////////////////

             //****************/
        var arr_job_id = <?php echo json_encode($jobs); ?>


        var arr_team_ids = <?php echo json_encode($team_members); ?>


        //from opportunity_teams
        var data_team_id = <?php echo json_encode($data_team_id); ?>

        var data_job_id = <?php echo json_encode($data_job_id); ?>


        var members_selected = [];
        var all_indexes = [];
        var x = [];


        if(data_team_id.length == 0)
        {
            all_indexes.push(0);
            draw_members_jobs_raw(0,null);
        }
        else
        {
            for(i=0;i<data_team_id.length;i++)
            {
                all_indexes.push(i);
                draw_members_jobs_raw(i,null);
                document.querySelector('select[id^="members_'+i+'"]').value = data_team_id[i];
                document.querySelector('select[id^="jobs_'+i+'"]').value = data_job_id[i];
                members_selected.push(data_team_id[i]);
            }
        }


        // alert( document.querySelector('select[id^="members_0"]').value);

        // alert(data_team_id.length);
        function draw_members_jobs_raw(row_index,type=null)
        {

            var options_members = '<td class="members" ><select class="selectpicker selectMembers" name="members_'+row_index+'" id="members_'+row_index+'" data-style="btn btn-link" minlength="0" maxlength="10" data-live-search="true" >';

            $.each(arr_team_ids, function( index, value ) {
                options_members += '<option display="none;" value="'+value+'">'+index+'</option>';
            });
            options_members += '</select></td>';

            var options_jobs = '<td class="jobs" ><select class="selectpicker" name="jobs_'+row_index+'" id="jobs_'+row_index+'" data-style="btn btn-link" minlength="0" maxlength="10">';
            $.each(arr_job_id, function( index, value ) {
                options_jobs += '<option  value="'+value+'">'+index+'</option>';
            });

            options_jobs += '</select></td>';
            var add_button;


            add_button = '<a id="addRow_'+row_index+'" class="btn btn-success btn-sm btn-round btn-fab"data-toggle="tooltip" data-placement="top"title="<?php echo e($labels['add'] ?? 'add'); ?>" ><i style="color:#fff;" class="material-icons">add</i></a>';

            $('.appendRows').append('<tr id="tr_'+row_index+'">'+options_members+''+options_jobs+'<td><button type="button" rel="tooltip" id="deleteRow_'+row_index+'" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDelete"data-placement="top"  title=" <?php echo e($labels['delete'] ?? 'delete'); ?> "><i class="material-icons">clear</i></button>&nbsp;&nbsp;'+add_button+'</td></tr>');


            $('[id^="members_'+row_index+'"]').val(-1);
            $('[id^="jobs_'+row_index+'"]').val(-1);

            if(type == 1)
                $('.selectpicker').selectpicker();


        }

        for(i=0;i<data_team_id.length;i++)
        {
            if(i != (data_team_id.length-1))
                $('[id="addRow_'+i+'"]').hide();

        }

        var expected_max_index = data_team_id.length+1;

        // for(i=0;i<expected_max_index;i++)
        // {

        //     var selection = document.querySelector('select[id^="members_'+i+'"]') !== null;
        //     if (selection)
        //     {
        //         var member_id = document.querySelector('select[id^="members_'+i+'"]').value;
        //         // alert(member_id);
        //         $('[id^="members_"] option[value="'+member_id+'"]').attr('disabled','true');
        //     }

        // }



        $(document).on('click', '[id^="addRow_"]', function(){
            members_selected = [];
            var current_row_index = parseInt($(this).attr('id').substr(7));
            // alert($('select[id^="members_'+current_row_index+'"]').val());
            var members=document.querySelector('select[id^="members_'+current_row_index+'"]').value;
            var jobs=document.querySelector('select[id^="jobs_'+current_row_index+'"]').value;

            if(members > 0 && jobs > 0)
            {
                $('[id^="deleteRow_'+current_row_index+'"]').show();
                $('[id^="addRow_'+current_row_index+'"]').hide();
                var row_index = current_row_index+1;
                // alert(row_index);
                all_indexes.push(row_index);
                // alert(row_index);
                draw_members_jobs_raw(row_index,1);
                expected_max_index +=1;


                for(i=0;i<expected_max_index;i++)
                {

                    var selection = document.querySelector('select[id^="members_'+i+'"]') !== null;
                    if (selection)
                    {

                        var member_id = document.querySelector('select[id^="members_'+i+'"]').value;
                        // alert(member_id);
                        members_selected.push(member_id);
                        // alert(member_id);
                    }
                }


            }
            else
            {
                myNotify('<?php echo e($messageNo1["icon"]); ?>', '<?php echo e($messageNo1["title"]); ?>', '<?php echo e($messageNo1["type"]); ?>', '5000','<?php echo e($messageNo1["text"]); ?>');
               // alert('You Must Choose Values .');
            }

            // for(i=0;i<members_selected.length;i++)
            //     alert(members_selected[i]+' add');
        });

        $(document).on('click', '[id^="deleteRow_"]', function(){

            members_selected = [];
            if(all_indexes.length == 1)
            {
                //alert('Not Permitted To Deletete First Row!!');
                myNotify('<?php echo e($messageNo2["icon"]); ?>', '<?php echo e($messageNo2["title"]); ?>', '<?php echo e($messageNo2["type"]); ?>', '5000','<?php echo e($messageNo2["text"]); ?>');
                return false;
            }

            var current_row_index = parseInt($(this).attr('id').substr(10));

            var index = all_indexes.indexOf(current_row_index);
            all_indexes.splice(index, 1);
            var maxValueInArray = Math.max.apply(Math, all_indexes);
            // alert(maxValueInArray);
            $('[id^="addRow"]').hide();
            $('[id="addRow_'+maxValueInArray+'"]').show();
            $('tr').remove('[id="tr_'+current_row_index+'"]');


            for(i=0;i<expected_max_index;i++)
            {

                var selection = document.querySelector('select[id^="members_'+i+'"]') !== null;
                if (selection)
                {
                    var member_id = document.querySelector('select[id^="members_'+i+'"]').value;
                    members_selected.push(member_id);
                }
            }

        });



        var previous_value;
        $(".selectpicker").on('shown.bs.select', function(e) {
            previous_value = $(this).val();

        });

        $(document).on('change', 'select[id^="members_"]', function(){


            for(i=0;i<members_selected.length;i++)
            {
                // alert(members_selected[i] + ' array value');
                // alert($(this).val() + ' value choosen');
                if($(this).val() == members_selected[i])
                {
                    //alert('this member choosen previously!! ');
                    myNotify('<?php echo e($messageNo3["icon"]); ?>', '<?php echo e($messageNo3["title"]); ?>', '<?php echo e($messageNo3["type"]); ?>', '5000','<?php echo e($messageNo3["text"]); ?>');
                    $(this).val(previous_value);
                    $('.selectpicker').selectpicker('refresh')
                    return fasle;
                }
            }
            members_selected = [];
            for(i=0;i<expected_max_index;i++)
            {

                var selection = document.querySelector('select[id^="members_'+i+'"]') !== null;
                if (selection)
                {
                    var member_id = document.querySelector('select[id^="members_'+i+'"]').value;
                    members_selected.push(member_id);
                }
            }

        });

        $('#saveTaskbtn').click(function(){
            var arr_members = [];
            var arr_jobs = [];

            for(i=0;i<expected_max_index;i++)
            {
                // alert(i+' index');
                var selection = document.querySelector('select[id^="members_'+i+'"]') !== null;
                if (selection)
                {
                    var member_id = document.querySelector('select[id^="members_'+i+'"]').value;
                    var job_id = document.querySelector('select[id^="jobs_'+i+'"]').value;
                    if(all_indexes.length == 1 && member_id == '' && job_id == '')
                        break;
                    if(member_id == '' || job_id == '')
                    {
                       // alert('All Values Must Be Selected');
                        myNotify('<?php echo e($messageNo4["icon"]); ?>', '<?php echo e($messageNo4["title"]); ?>', '<?php echo e($messageNo4["type"]); ?>', '5000','<?php echo e($messageNo4["text"]); ?>');
                        return false;
                    }
                    // alert(document.querySelector('select[id^="members_'+i+'"]').value);
                    arr_members.push(document.querySelector('select[id^="members_'+i+'"]').value);
                    arr_jobs.push(document.querySelector('select[id^="jobs_'+i+'"]').value);
                }
            }
            $('#arr_members').val(arr_members);
            $('#arr_jobs').val(arr_jobs);

        });

        function displayReference(){
            $("#addProposalLink").hide();
            $("#addConceptLink").hide();
            //to display proposal or concept link depends on opport.
            var ref_link="";
            var ref_type='<?php echo e($type_ref ?? 1); ?>';
            var ref_id='<?php echo e($ref_data->id ?? 0); ?>';
            var text="";
            if(ref_id!=0) {
                if (ref_type == 1) {
                    ref_link = '<?php echo e(route('concept.concept.edit',$ref_data->id ?? 0)); ?>';
                    text="تصور";
                } else {
                    ref_link = '<?php echo e(route('proposal.proposal.edit',$ref_data->id ?? 0)); ?>';
                    text="عرض";
                }
            }
            var ref_subject='<?php echo e($ref_data->subject_na ?? ""); ?>';
            var item=   '<a href="'+ref_link+'" class="refer_link pull-right" id="nextProjectMain2">'+
                        '<div class="ripple-container"></div><i class="material-icons">link</i>'+
                        ''+text+'('+ref_subject+')'+'</a>';
            $("#display-reference-link").html(item)
        }

        //****************/



            
            

           
           
           


            
            
            
            

            
                
                
                    
                
                

                
                
                    
                
                
                
                
                
                
                
                
            

            

            
                
                
                
                
                
                
                
                
                
                    
                    

                    
                    
                    
                    
                    
                    
                        
                        
                        
                            
                            
                            
                            
                        
                    
                
                
                
                    
                
            

            
                
                
                
                    
                    
                
                
                
                
                
                
                
                
                

                
                
                    
                    
                    
                        
                        
                    
                
            

            
            
                
            

            
                
                
                    
                    
                    
                    
                        
                        
                        
                        
                    
                

            

        
            
            
            
            
                
                
                
                    
                    
                    
                        
                    
                    
                        
                        
                    
                    
                    
                    
                
            
            
            
            
            

        



    </script>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>
    <!-- Forms Validations Plugin -->
    <script src="<?php echo e(asset('assets/js/plugins/jquery.validate.min.js')); ?>"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="<?php echo e(asset('assets/js/plugins/jquery.bootstrap-wizard.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-datetimepicker.min.js')); ?>"></script>

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>


    <?php if(\Illuminate\Support\Facades\Auth::user()->lang_id ==2): ?>
        <script src="<?php echo e(asset('js/opportunity_edit_wizard_rtl.js')); ?>"></script>
    <?php else: ?>
        <script src="<?php echo e(asset('js/opportunity_edit_wizard.js')); ?>"></script>
    <?php endif; ?>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>