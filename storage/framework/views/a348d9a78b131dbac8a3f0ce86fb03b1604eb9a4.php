<?php $__env->startSection('content'); ?>
  <style>
    .card-wizard .bootstrap-select .disabled {
      display: inline-block;
    }

  </style>

  <div class="col-md-12 col-12 mr-auto ml-auto">
    <div class="card card-wizard" data-color="rose" id="createTaskWizard">

      <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
      <div class="card-header text-center">
        <h3 class="card-title">
          <?php echo e($labels['screen_add_tasks'] ?? 'screen_add_tasks'); ?>

        </h3>
        <h5 class="card-description"></h5>
      </div>
      <div class="wizard-navigation">
        <ul class="nav nav-pills">
          <li class="nav-item" id="task_link" data-task-id="">
            <a class="nav-link active" href="#main_info" data-toggle="tab" role="tab">
              <?php echo e($labels['task_info'] ?? 'task_info'); ?>


            </a>
          </li>
          <!--<li class="nav-item">
              <a class="nav-link" href="#assigned_to" data-toggle="tab" role="tab">
                  Assigned To
              </a>
          </li>-->
          <li class="nav-item">
            <a class="nav-link" href="#comments" data-toggle="tab" role="tab">
              <?php echo e($labels['comments'] ?? 'comments'); ?>

            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#log_hour" data-toggle="tab" role="tab">
              <?php echo e($labels['log_hour'] ?? 'log_hour'); ?>

            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#attachments" data-toggle="tab" role="tab">
              <?php echo e($labels['attachments'] ?? 'attachments'); ?>

            </a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="main_info">
            <div id="task_main_info">
              <?php echo Form::open(['route' => 'tasks.store' ,'action'=>'post' ,'id'=>'formTaskCreate']); ?>

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


              <div class='row'>
                <label for='assigned_staffs' class='col-md-2 col-form-label'>Assigned Staffs</label>
                <div class='col-md-10'>
                  <div class='form-group has-default bmd-form-group'>
                    <select required class="form-control selectpicker" id="assigned_staffs"
                            name="assigned_staffs[]" data-style="select-with-transition" multiple
                            data-live-search="true" title="Choose Staffs">
                      <?php if(count($staffs) >0): ?>
                        <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option
                              value="<?php echo e($staff->id); ?>"><?php echo e((Auth::user()->lang_id == 1 ? $staff->staff_name_na : $staff->staff_name_fo)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    </select>
                  </div>
                </div>
              </div>
              <br>
              <div class="col-md-12">
                <input type="hidden" id="activity_start_date" value="">
                <a href="#" class="btn btn-next btn-rose pull-right btn-sm" id="nextProjectMain">
                  <?php echo e($labels['next'] ?? 'next'); ?>

                </a>

                <button type="submit" id="saveTaskbtn" class="btn btn-primary  btn-sm pull-right">
                  <?php echo e($labels['save'] ?? 'save'); ?>


                  <div class="loader pull-left" style="display: none;"></div>
                </button>

                <a href="<?php echo e(route('tasks.index')); ?>" class="btn btn-sm btn-default pull-left"
                   id="nextProjectMain">
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
            <div id="log_hour_content">
              <div align="center" id="loader-icon-l" class="col-md-12">
                <div class="loader loader-div"></div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="attachments">
            <input type="hidden" id="object_primary_id" value="">
            <!-- <div align="center" id="loader-icon" class="col-md-12"> <div class="loader loader-div">  </div></div> -->
            <div id="files-content">

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



<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
  <script>

      var project_disabled = '<?php echo e($project_disabled); ?>';
      var activity_main_disabled = '<?php echo e($activity_main_disabled); ?>';
      var activity_sub_disabled = '<?php echo e($activity_sub_disabled); ?>';

      $(document).ready(function () {
          active_nev_link('tasks');

          funValidateForm();
          $("#start_date").on("dp.change", function (e) {
              $('#end_date').data("DateTimePicker").minDate(e.date);
          });

          $("#end_date").on("dp.change", function (e) {
              //        $('#start_date').data("DateTimePicker").maxDate(e.date);
          });

          $('#task_status_id').val(1).change();
          $('#task_priority_id').val(1).change();
          $('.selectpicker').selectpicker();
          datetimepicker();


          //    $('#activity_start_date').val($('#activity_id').val());

          $('a[href="#attachments"]').click(function () {
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
          wizard();
          createTaskFrom();
      });

      function createTaskFrom() {
           if(project_disabled ==1){

              $('#project_id').prop('disabled', true);
              $('#project_id').selectpicker('refresh');
          }
          if(activity_main_disabled == 1){
              $('#activity_id').prop('disabled', true);
              $('#activity_id').selectpicker('refresh');
          }
          if(activity_sub_disabled == 1){
              $('#sub_activity_id').prop('disabled', true);
              $('#sub_activity_id').selectpicker('refresh');
          }
      }


      
      
      
      
      
      

      
      
      

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


      $(document).on('click', '.btnEditTaskComment', function () {
          var url_ = $(this).attr('data-href');
          $.get(url_, function (response) {
              $('#taskCommentsModalForm').html(response);
              $('.selectpicker').selectpicker();
          });
          $('#taskCommentsModal').modal('show');
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
          var task_id = $('#task_link').attr('data-task-id');
          var url = '<?php echo e(route('tasks_comments.index')); ?>' + '/' + task_id;
          $.get(url, function (response) {
              $('#loader-icon-c').hide();
              $('#comments_content').html(response);
              /*$('#task-comments-table').DataTable({
                  language: {
                      search: "_INPUT_",
                      searchPlaceholder: "Search records",
                  }
              });*/
              $('[data-toggle="tooltip"]').tooltip();
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
    <script src="<?php echo e(asset('js/task_edit_wizard_rtl.js')); ?>"></script>
  <?php else: ?>
    <script src="<?php echo e(asset('js/task_edit_wizard.js')); ?>"></script>
  <?php endif; ?>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>