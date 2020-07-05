<?php $__env->startSection('css'); ?>
  <style>
    .dropdown-toggle::after {
      display: none;
    }

    #modalActivitySetting .modal-body {
      max-height: 400px;
    }

    #modalActivitySetting .table {

    }

    .card-header {
      padding: 10px 10px !important
    }

    .booratrp-datetimepicker-widget {
      z-index: 99999999 !important;
    }
    .bootstrap-datetimepicker-widget.dropdown-menu.usetwentyfour.bottom.pull-right.open{
      z-index: 99999999 !important;

    }
    .table-responsive {

    }
    .bmd-form-group {
      position: static !important;
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
          <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
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

          </div>


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
              <a class="nav-link" href="#activity_beneficiary" data-toggle="tab" role="tab">
                <?php echo e($labels['beneficiaries']??'beneficiaries_'); ?>


              </a>
            </li>


            <li class="nav-item">
              <a class="nav-link" href="#activity_achievements" data-toggle="tab" role="tab">
                <?php echo e($labels['achievements']??'achievements'); ?>


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


            <div class="tab-pane" id="activity_beneficiary">

              <a href="#" rel="tooltip" class="btn btn-sm btn-primary btn-round btn-fab"
                 data-toggle="modal" data-target="#modalBeneficiary"
                 title="" data-placement="top" id="AddBeneficiary"
                 data-original-title="<?php echo e($labels['add_beneficiary']??'add_beneficiary'); ?>"
              >
                <i class="material-icons">add</i>
              </a>


              <div id="loaderTableBeneficiary" align="center" class="col-md-12 " style="display: none">
                <div class="loader loader-div"></div>
              </div>
              <div id="BeneficiaryTable">

                <table class="table">
                  <thead>
                  <tr class="background-color-indicator-activity">
                    <th>#</th>
                    <th>
                      <?php echo e($labels['city_name'] ?? 'city_name'); ?>

                    </th>
                    <th>
                      <?php echo e($labels['destrict_'] ?? 'destrict_'); ?>

                    </th>
                    <th>
                      <?php echo e($labels['beneficiary'] ?? 'beneficiary'); ?>

                    </th>
                    <th>
                      <?php echo e($labels['beneficiary_type'] ?? 'beneficiary_type'); ?>

                    </th>

                    <th>
                      <?php echo e($labels['actions'] ?? 'actions'); ?>

                    </th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(sizeof($activityBeneficiariesVm)>0): ?>
                    <?php $__currentLoopData = $activityBeneficiariesVm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$activityBeneficiary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($index+1); ?></td>
                        <td><?php echo e($activityBeneficiary->{'governorate_name_'.lang_character()}); ?></td>
                        <td><?php echo e($activityBeneficiary->{'location_name_'.lang_character()}); ?></td>
                        <td><?php echo e($activityBeneficiary->{'beneficieris_types_name_'.lang_character()}); ?></td>
                        <td><?php echo e($activityBeneficiary->{'ben_name_'.lang_character()}); ?></td>

                        <td>

                          <a href="<?php echo e(route('activity.beneficiary.destroy',$activityBeneficiary->activity_bene_id)); ?>"
                             rel="tooltip"
                             class="btn btn-sm btn-danger btn-fab btn-round btnDeleteActivityBeneficiary"
                             title="<?php echo e($labels['delete'] ?? 'delete'); ?>">
                            <i class="material-icons">delete</i>
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                  </tbody>
                </table>

              </div>
            </div>

            <div class="tab-pane" id="activity_achievements">
              <div class="col-md-12 <?php if(Auth::user()->lang_id ==1 ): ?> text-right <?php else: ?> text-left <?php endif; ?>">
                <a class="btn btn-light btn-sm"
                   href="<?php echo e(route('activity.activityAchievementType',$activity_data->id)); ?>"
                   id="activitySetting">
                  <i class="fa fa-cog fa-2x"></i>
                </a>
              </div>
              <div class="collapse-group">

                <button class="btn btn-primary btn-sm open-button" type="button">
                  Open all
                </button>
                <button class="btn btn-primary btn-sm  close-button" type="button">

                  Close all
                </button>
                <?php if(sizeof($achievementTypesSelected)>0): ?>
                  <?php $__currentLoopData = $achievementTypesSelected; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index__=>$type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                    <div class="card">
                      <header class="card-header bg-primary ">
                        <a href="#" data-toggle="collapse" data-target="#collapseModule<?php echo e($type->id); ?>"
                           aria-expanded="true" class="">
                          <i class="icon-action fa fa-chevron-down text-white"></i>
                          <span class="title "> <?php echo e($type->{'achivement_type_'.lang_character1()}); ?> </span>
                        </a>
                      </header>
                      <div class="collapse <?php if($index__ == 0): ?> show <?php endif; ?>" id="collapseModule<?php echo e($type->id); ?>" style="">
                        <article class="card-body">
                          <a href="#" data-achievement_type="<?php echo e($type->id); ?>"
                             class="btn btn-round btn-primary btn-fab btn-sm addBeneficiaryToAchievement"
                             data-toggle="modal" data-target="#modalAchievementBeneficiary">
                            <i class="fa fa-plus"></i>
                          </a>

                          <div class="col-md-12" id="achievementBeneficiaryTable_<?php echo e($type->id); ?>">
                            <?php echo $__env->make('activity/beneficiaries/beneficiary_achievement_table',
                            [
                              'activityAchievementBeneficiariesVW'=>\App\Models\Activity\ActivityAchievementBeneficiariesVW::activityAchievementBeneficiariesVW($type->id,$activity_data->id),
                              'attachmentTypeMetrics'=> \App\Models\Setting\AttachmentTypeMetrics::attachmentTypeMetric($type->id),
                              'labels'=>$labels,
                              'c_achivement_type_id'=>$type->id,
                              'activity_id'=>$activity_data->id,
                              'activityAchievemetBeneficiaryDTS'=>\App\Models\Activity\ActivityAchievementBeneficiariesDTS::activityAchievemetBeneficiaryDTS($activity_data->id,$type->id)
                            ]
                            , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                          </div>

                        </article> <!-- card-body.// -->
                      </div> <!-- collapse .// -->
                    </div> <!-- card.// -->

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </div>
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


  <div class="modal fade " id="modalActivitySetting" tabindex="-1" role="">
    <div class="modal-dialog" role="document">
      <div id="contentModal">
        <div class="modal-content ">
          <div class="card  card-plain">
            <div class="modal-header">
              <div class="card-header  text-center" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                  <i class="material-icons">clear</i>
                </button>
                <h4 class="card-title">
                  <?php echo e($labels['ActivitySetting'] ??'ActivitySetting'); ?>

                </h4>
                <br>
              </div>
            </div>

            <div class="modal-body">


              <?php echo Form::open(['route' => 'activity.setting.achievement.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'addActivitySetting']); ?>

              <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                  <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </div>
              <?php endif; ?>
              <input type="hidden" name="activity_id" value="<?php echo e($activity_data->id); ?>">
              <col-md-12>
                <div class="row" style="padding: 2px 15px;" id="div-search">
                  <div class=" col-md-9">
                    <div class="form-group ">
                      <input type="text"
                             class="form-control "
                             name="search"
                             placeholder="search"
                             autocomplete="off"
                             id="search">
                    </div>
                  </div>
                  <div class=" col-md-3 td-actions text-left">
                    <a href="#" class="btn btn-sm   btn-success btn-fab" id="achievementTypeSearch">

                      <i class="material-icons">search</i>
                      <div class="ripple-container"></div>
                    </a>
                    <a href="#" class="btn btn-sm    btn-success btn-fab" id="achievementTypeAll">

                      <i class="material-icons">list</i>
                      <div class="ripple-container"></div>
                    </a>


                  </div>
                  <div class="loader pull-left" style="display: none;"></div>
                </div>
              </col-md-12>
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <tbody>
                    <?php $__currentLoopData = $achievementTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$achievement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td>
                          <?php if(in_array($achievement->id,$activityAchievementTypes)): ?>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input checked name="achievement_type[]"
                                       class="form-check-input" type="checkbox"
                                       value="<?php echo e($achievement->id); ?>">
                                <span class="form-check-sign">
                                                                          <span class="check"></span>
                                                             </span>
                              </label>
                            </div>
                          <?php else: ?>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input name="achievement_type[]"
                                       class="form-check-input" type="checkbox"
                                       value="<?php echo e($achievement->id); ?>">
                                <span class="form-check-sign">
                                                                          <span class="check"></span>
                                                             </span>
                              </label>
                            </div>
                          <?php endif; ?>
                        </td>
                        <td><?php echo e($achievement->{'achivement_type_'.lang_character1()}); ?></td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="col-md-12">
                <div class="card-footer ml-auto mr-auto">
                  <div class="ml-auto mr-auto">
                    <button type="submit" id="submitActivitySetting" class="btn btn-rose btn-sm ">
                      <?php echo e($labels['save']??'save'); ?>

                      <div class="loader pull-left" style="display: none;"></div>
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



  <div class="modal fade" id="modalBeneficiary" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-signup" role="document">
      <div id="contentModal">
        <div class="modal-content ">
          <div class="card card-signup card-plain">
            <div class="modal-header">
              <div class="card-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                  <i class="material-icons">clear</i>
                </button>

                <h4 class="card-title">
                  <?php echo e($labels['Add_beneficiaries'] ?? 'Add_beneficiaries'); ?>

                </h4>
              </div>
            </div>
            <div class="modal-body">


              <div class="row" id=" ">
                <div class="col-md-12">
                  <form action="<?php echo e(route('activity.search_beneficiary')); ?>"
                        method="get" id="formSearchBeneficiary"
                        no-jquery-validate="no-jquery-validate">
                    <input type="hidden" value="<?php echo e($activity_data->id); ?>" id="activity_id" name="activity_id">
                    <div class="row">

                      <div class="col-md-3">
                        <div class="row">
                          <label style="padding-bottom: 0px;" for="city_id"
                                 class="col-md-12 col-form-label">  <?php echo e($labels['city_name'] ?? 'city_name'); ?></label>
                          <div class="col-md-12">
                            <div class='form-group has-default bmd-form-group'>
                              <select class="form-control selectpicker"
                                      data-style='btn btn-link' data-live-search="true" name="city_id"
                                      id="city_id">
                                <option style='height: 37px;' value></option>
                                <?php if(sizeof($cities)>0): ?>
                                  <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"><?php echo e($city); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="row">
                          <label style="padding-bottom: 0px;" for="destrict_"
                                 class="col-md-12 col-form-label">  <?php echo e($labels['destrict_'] ?? 'destrict_'); ?></label>
                          <div class="col-md-12">
                            <div class='form-group has-default bmd-form-group'>
                              <select class="form-control selectpicker" data-style='btn btn-link'
                                      data-live-search="true" name="destrict_" id="destrict_">
                                <option style='height: 37px;' value></option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="row">
                          <label style="padding-bottom: 0px;" for="beneficiary_type"
                                 class="col-md-12 col-form-label"><?php echo e($labels['beneficiary_type'] ?? 'beneficiary_type'); ?>

                          </label>
                          <div class="col-md-12">
                            <div class='form-group has-default bmd-form-group'>
                              <select class="form-control selectpicker" data-style='btn btn-link'
                                      data-live-search="true" name="beneficiary_type" id="beneficiary_type">
                                <option style='height: 37px;' value></option>
                                <?php if(sizeof($beneficiaryType)>0): ?>
                                  <?php $__currentLoopData = $beneficiaryType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"><?php echo e($type); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="row">
                          <label style="padding-bottom: 0px;" for="beneficiary_type"
                                 class="col-md-12 col-form-label"> <?php echo e($labels['beneficiary'] ?? 'beneficiary'); ?>

                          </label>
                          <div class="col-md-12">
                            <div class="form-group has-default bmd-form-group">
                              <input type="text" class="form-control" name="search"
                                     id="search" autocomplete="off"
                                     placeholder=" ">
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-12">
                        <button btn="btnToggleDisabled" type="submit" class="btn   btn-rose   btn-sm  pull-right"
                                id="search">
                          <?php echo e($labels['search']??'search'); ?>

                          <div class="loader pull-left" style="display: none;"></div>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="row" id="result_search_actual">
                <div class="col-md-12">

                </div>


                <div class="card-body col-md-12">

                </div>
                <div class="col-md-12" align="center">
                  <a href="#" class="btn btn-sm btn-rose" id="addActualBeneficiarySelected" hidden
                     data-toggle="tooltip" data-placement="top" title="Add">
                    <?php echo e($labels['add_selected']??'add_selected'); ?>

                    <div class="loader pull-left" style="display: none;"></div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>


  <div class="modal fade" id="modalAchievementBeneficiary" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-signup" role="document">
      <div id="contentModal">
        <div class="modal-content ">
          <div class="card card-signup card-plain">
            <div class="modal-header">
              <div class="card-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                  <i class="material-icons">clear</i>
                </button>

                <h4 class="card-title">
                  <?php echo e($labels['Add_beneficiaries'] ?? 'Add_beneficiaries'); ?>

                </h4>
              </div>
            </div>
            <div class="modal-body">


              <div class="row" id=" ">
                <div class="col-md-12">
                  <form action="<?php echo e(route('activity.achievement_search_beneficiary')); ?>" method="get"
                        id="formAchievementSearchBeneficiary"
                        no-jquery-validate="no-jquery-validate">
                    <input type="hidden" value="<?php echo e($activity_data->id); ?>" id="activity_id" name="activity_id">
                    <input type="hidden" name="achievement_type" id="achievement_type">
                    <div class="row">

                      <div class="col-md-3">
                        <div class="row">
                          <label style="padding-bottom: 0px;" for="city_id"
                                 class="col-md-12 col-form-label">  <?php echo e($labels['city_name'] ?? 'city_name'); ?></label>
                          <div class="col-md-12">
                            <div class='form-group has-default bmd-form-group'>
                              <select class="form-control selectpicker"
                                      data-style='btn btn-link' data-live-search="true" name="city_id"
                                      id="city_id">
                                <option style='height: 37px;' value></option>
                                <?php if(sizeof($cities)>0): ?>
                                  <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"><?php echo e($city); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="row">
                          <label style="padding-bottom: 0px;" for="destrict_"
                                 class="col-md-12 col-form-label">  <?php echo e($labels['destrict_'] ?? 'destrict_'); ?></label>
                          <div class="col-md-12">
                            <div class='form-group has-default bmd-form-group'>
                              <select class="form-control selectpicker" data-style='btn btn-link'
                                      data-live-search="true" name="destrict_" id="destrict_">
                                <option style='height: 37px;' value></option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="row">
                          <label style="padding-bottom: 0px;" for="beneficiary_type"
                                 class="col-md-12 col-form-label"><?php echo e($labels['beneficiary_type'] ?? 'beneficiary_type'); ?>

                          </label>
                          <div class="col-md-12">
                            <div class='form-group has-default bmd-form-group'>
                              <select class="form-control selectpicker" data-style='btn btn-link'
                                      data-live-search="true" name="beneficiary_type" id="beneficiary_type">
                                <option style='height: 37px;' value></option>
                                <?php if(sizeof($beneficiaryType)>0): ?>
                                  <?php $__currentLoopData = $beneficiaryType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"><?php echo e($type); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="row">
                          <label style="padding-bottom: 0px;" for="beneficiary_type"
                                 class="col-md-12 col-form-label"> <?php echo e($labels['beneficiary'] ?? 'beneficiary'); ?>

                          </label>
                          <div class="col-md-12">
                            <div class="form-group has-default bmd-form-group">
                              <input type="text" class="form-control" name="search"
                                     id="search" autocomplete="off"
                                     placeholder=" ">
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-12">
                        <button btn="btnToggleDisabled" type="submit" class="btn   btn-rose   btn-sm  pull-right"
                                id="search">
                          <?php echo e($labels['search']??'search'); ?>

                          <div class="loader pull-left" style="display: none;"></div>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="row" id="result_search_a_b">
                <div class="col-md-12">

                </div>


                <div class="card-body col-md-12">

                </div>
                <div class="col-md-12" align="center">
                  <a href="#" class="btn btn-sm btn-rose" id="addActualBeneficiarySelected" hidden
                     data-toggle="tooltip" data-placement="top" title="Add">
                    <?php echo e($labels['add_selected']??'add_selected'); ?>

                    <div class="loader pull-left" style="display: none;"></div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
  <script>
      var currency_symbol = '<?php echo e($currency_symbol); ?>';
      $(document).ready(function () {

          var id_val = $('#formActivityMainAdd #id').val();
          if (id_val == "") {
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

          currency_symbol_fun();


          $('#modalActivitySetting .modal-body').perfectScrollbar();

          $('.achievement_date').datetimepicker({
              format: 'DD/MM/YYYY'
          });

          DataTableCall('#BeneficiaryTable table', 6);

      });

      function currency_symbol_fun() {
          var planned_budget = $('#formActivityMainAdd  [for="planned_budget"]').text();
          $('#formActivityMainAdd  [for="planned_budget"]').text(planned_budget + '(' + currency_symbol + ')');

          var planned_contribution = $('#formActivityMainAdd  [for="planned_contribution"]').text();
          $('#formActivityMainAdd  [for="planned_contribution"]').text(planned_contribution + '(' + currency_symbol + ')');

          var act_budget = $('#formActivityMainAdd  [for="act_budget"]').text();
          $('#formActivityMainAdd  [for="act_budget"]').text(act_budget + '(' + currency_symbol + ')');

          var act_contribution = $('#formActivityMainAdd  [for="act_contribution"]').text();
          $('#formActivityMainAdd  [for="act_contribution"]').text(act_contribution + '(' + currency_symbol + ')');

      }


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
              },
              error: function () {

              }
          });

      }


      function dateOnOpenPage(data) {

          var act_start_date = $('#act_start_date').val();
          var act_end_date = $('#act_end_date').val();

          if (act_start_date == "" && act_end_date == "") {

              $('#planed_start_date').data("DateTimePicker").minDate(data.start_date);
              $('#planed_start_date').data("DateTimePicker").maxDate(data.end_date);
              $('#planed_end_date').data("DateTimePicker").minDate(data.start_date);
              $('#planed_end_date').data("DateTimePicker").maxDate(data.end_date);

              var planed_start_date = $('#planed_start_date').val();
              var planed_end_date = $('#planed_end_date').val();

              if (planed_start_date != "" && planed_end_date != "") {

                  $('#act_start_date').data("DateTimePicker").minDate(planed_start_date);
                  $('#act_start_date').data("DateTimePicker").maxDate(planed_end_date);

                  $('#act_end_date').data("DateTimePicker").minDate(planed_start_date);
                  $('#act_end_date').data("DateTimePicker").maxDate(planed_end_date);

                  $('#planed_start_date').data("DateTimePicker").maxDate(planed_end_date);
                  $('#planed_end_date').data("DateTimePicker").minDate(planed_start_date);


              } else if (planed_start_date != "" && planed_end_date == "") {
                  $('#act_start_date').data("DateTimePicker").minDate(planed_start_date);
                  $('#act_start_date').data("DateTimePicker").maxDate(data.end_date);

                  $('#act_end_date').data("DateTimePicker").minDate(planed_start_date);
                  $('#act_end_date').data("DateTimePicker").maxDate(data.end_date);

                  $('#planed_start_date').data("DateTimePicker").maxDate(data.end_date);
                  $('#planed_end_date').data("DateTimePicker").minDate(planed_start_date);

              } else if (planed_start_date == "" && planed_end_date != "") {
                  $('#act_start_date').data("DateTimePicker").minDate(data.start_date);
                  $('#act_start_date').data("DateTimePicker").maxDate(planed_end_date);

                  $('#act_end_date').data("DateTimePicker").minDate(data.start_date);
                  $('#act_end_date').data("DateTimePicker").maxDate(planed_end_date);

                  $('#planed_start_date').data("DateTimePicker").maxDate(planed_end_date);
                  $('#planed_end_date').data("DateTimePicker").minDate(data.start_date);
              } else {
                  $('#act_start_date').data("DateTimePicker").minDate(data.start_date);
                  $('#act_start_date').data("DateTimePicker").maxDate(data.end_date);

                  $('#act_end_date').data("DateTimePicker").minDate(data.start_date);
                  $('#act_end_date').data("DateTimePicker").maxDate(data.end_date);
              }

          } else if (act_start_date != "" && act_end_date != "") {

              var act_start_date = $('#act_start_date').val();
              var act_end_date = $('#act_end_date').val();

              $('#planed_start_date').data("DateTimePicker").minDate(data.start_date);
              $('#planed_start_date').data("DateTimePicker").maxDate(act_start_date);
              $('#planed_end_date').data("DateTimePicker").minDate(act_end_date);
              $('#planed_end_date').data("DateTimePicker").maxDate(data.end_date);

              var planed_start_date = $('#planed_start_date').val();
              var planed_end_date = $('#planed_end_date').val();

              if (planed_start_date != "" && planed_end_date != "") {

                  $('#act_start_date').data("DateTimePicker").minDate(planed_start_date);
                  $('#act_start_date').data("DateTimePicker").maxDate(planed_end_date);

                  $('#act_end_date').data("DateTimePicker").minDate(planed_start_date);
                  $('#act_end_date').data("DateTimePicker").maxDate(planed_end_date);
              } else if (planed_start_date != "" && planed_end_date == "") {

                  $('#act_start_date').data("DateTimePicker").minDate(planed_start_date);
                  $('#act_start_date').data("DateTimePicker").maxDate(data.end_date);

                  $('#act_end_date').data("DateTimePicker").minDate(planed_start_date);
                  $('#act_end_date').data("DateTimePicker").maxDate(data.end_date);

              } else if (planed_start_date == "" && planed_end_date != "") {

                  $('#act_start_date').data("DateTimePicker").minDate(data.start_date);
                  $('#act_start_date').data("DateTimePicker").maxDate(planed_end_date);

                  $('#act_end_date').data("DateTimePicker").minDate(data.start_date);
                  $('#act_end_date').data("DateTimePicker").maxDate(planed_end_date);
              } else {
                  $('#act_start_date').data("DateTimePicker").minDate(data.start_date);
                  $('#act_start_date').data("DateTimePicker").maxDate(data.end_date);

                  $('#act_end_date').data("DateTimePicker").minDate(data.start_date);
                  $('#act_end_date').data("DateTimePicker").maxDate(data.end_date);
              }

          } else if (act_start_date != "" && act_end_date == "") {

              var planed_start_date = $('#planed_start_date').val();
              var planed_end_date = $('#planed_end_date').val();

              $('#planed_start_date').data("DateTimePicker").minDate(data.start_date);
              $('#planed_start_date').data("DateTimePicker").maxDate(act_start_date);
              $('#planed_end_date').data("DateTimePicker").minDate(planed_start_date);
              $('#planed_end_date').data("DateTimePicker").maxDate(data.end_date);


              if (planed_start_date != "" && planed_end_date != "") {

                  $('#act_start_date').data("DateTimePicker").minDate(planed_start_date);
                  $('#act_start_date').data("DateTimePicker").maxDate(planed_end_date);

                  $('#act_end_date').data("DateTimePicker").minDate(planed_start_date);
                  $('#act_end_date').data("DateTimePicker").maxDate(planed_end_date);
              } else if (planed_start_date != "" && planed_end_date == "") {

                  $('#act_start_date').data("DateTimePicker").minDate(planed_start_date);
                  $('#act_start_date').data("DateTimePicker").maxDate(data.end_date);

                  $('#act_end_date').data("DateTimePicker").minDate(planed_start_date);
                  $('#act_end_date').data("DateTimePicker").maxDate(data.end_date);

              } else if (planed_start_date == "" && planed_end_date != "") {
                  $('#act_start_date').data("DateTimePicker").minDate(data.start_date);
                  $('#act_start_date').data("DateTimePicker").maxDate(planed_end_date);

                  $('#act_end_date').data("DateTimePicker").minDate(data.start_date);
                  $('#act_end_date').data("DateTimePicker").maxDate(planed_end_date);
              } else {
                  $('#act_start_date').data("DateTimePicker").minDate(data.start_date);
                  $('#act_start_date').data("DateTimePicker").maxDate(data.end_date);

                  $('#act_end_date').data("DateTimePicker").minDate(data.start_date);
                  $('#act_end_date').data("DateTimePicker").maxDate(data.end_date);
              }

          } else if (act_start_date == "" && act_end_date != "") {

              var planed_start_date = $('#planed_start_date').val();
              var planed_end_date = $('#planed_end_date').val();

              $('#planed_start_date').data("DateTimePicker").minDate(data.start_date);
              $('#planed_start_date').data("DateTimePicker").maxDate(planed_end_date);
              $('#planed_end_date').data("DateTimePicker").minDate(act_end_date);
              $('#planed_end_date').data("DateTimePicker").maxDate(data.end_date);


              if (planed_start_date != "" && planed_end_date != "") {

                  $('#act_start_date').data("DateTimePicker").minDate(planed_start_date);
                  $('#act_start_date').data("DateTimePicker").maxDate(planed_end_date);

                  $('#act_end_date').data("DateTimePicker").minDate(planed_start_date);
                  $('#act_end_date').data("DateTimePicker").maxDate(planed_end_date);
              } else if (planed_start_date != "" && planed_end_date == "") {

                  $('#act_start_date').data("DateTimePicker").minDate(planed_start_date);
                  $('#act_start_date').data("DateTimePicker").maxDate(data.end_date);

                  $('#act_end_date').data("DateTimePicker").minDate(planed_start_date);
                  $('#act_end_date').data("DateTimePicker").maxDate(data.end_date);

              } else if (planed_start_date == "" && planed_end_date != "") {
                  $('#act_start_date').data("DateTimePicker").minDate(data.start_date);
                  $('#act_start_date').data("DateTimePicker").maxDate(planed_end_date);

                  $('#act_end_date').data("DateTimePicker").minDate(data.start_date);
                  $('#act_end_date').data("DateTimePicker").maxDate(planed_end_date);
              } else {
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
          var planned_budget_ = $('#formActivityMainAdd #planned_budget').val();
          var planned_contribution_ = $('#formActivityMainAdd #planned_contribution').val();
          var color_ = $('#formActivityMainAdd #color').val();

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
              planned_budget: planned_budget_,
              planned_contribution: planned_contribution_,
              color: color_,
          };

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
                  $("#formLocationCreate #destrict_ option").remove();
                  $("#formLocationCreate #destrict_ ").append("<option  style='height: 37px;' value></option>");
                  $('#formLocationCreate #destrict_').selectpicker('refresh');
              },
              success: function (data) {

                  if (data != null) {

                      selectDestrice_formLocationCreate(data);
                  }

                  $('#formLocationCreate #destrict_').selectpicker('refresh');
              },
              error: function () {
              }
          });
      });

      function selectDestrice_formLocationCreate(data) {
          $.each(data, function (index, value) {
              $("#formLocationCreate #destrict_").append('<option value=' + index + '>' + value + '</option>');
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

                  if (data.status == true) {
                      //   $('#modalLocation .close').click();
                      //   $('[rel="tooltip"]').tooltip();
                      getDataLocation();
                      cleanFormAddLocation();
                      getCityByActivity();
                      myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                  }
                  $('.loader').css('display', 'none');
                  $('#btnLocationAdd').prop("disabled", false);
              },
              error: function (data) {

              }
          })
      });


      function getDataLocation() {
          var activity_id = window.parent.$('#formActivityMainAdd #id').val();
          if (activity_id === undefined) {
              activity_id = window.parent.$('#formSubActivity #id').val();
          }
          url = '<?php echo e(route("activity.location.indexTable")); ?>' + '/' + activity_id;
          $.ajax({
              url: url,
              type: 'get',
              dataTypes: 'html',
              beforeSend: function () {
                  $('#loaderTableLocation').show();
                  $('#loaderTableLocation .loader').show();
              },
              success: function (data) {
                  $('#locationTable').empty();
                  $('#locationTable').html(data);
                  $('[rel="tooltip"]').tooltip();
                  $('#loaderTableLocation').hide();
                  $('#loaderTableLocation .hide').show();

              },
              error: function () {
              }
          });

      };

      function cleanFormAddLocation() {
          $('#formLocationCreate #id').val('')
          $('#formLocationCreate #location_fo').val('')
          $('#formLocationCreate #location_na').val('')
          $('#formLocationCreate #city_id').val('')
          $('#formLocationCreate #city_id').selectpicker('refresh');
          $('#formLocationCreate #destrict_').val('')
          $('#formLocationCreate #destrict_').selectpicker('refresh');
          $('#formLocationCreate #team_member').val('')
          $('#formLocationCreate #team_member').selectpicker('refresh');
      }

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
                  cleanFormAddLocation();
                  $('#loaderTableLocation').show();
                  $('#loaderTableLocation .loader').show();

                  // $('#modalLocation #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
              },
              success: function (data) {
                  //   $('#modalLocation #contentModal').empty();
                  //  $('#modalLocation #contentModal').html(data.html.html);
                  //  selectpicker();

                  if (data.status == true) {
                      FillFormAddLocation(data);
                      $('#loaderTableLocation').hide();
                      $('#loaderTableLocation .loader').hide();

                  }

                  /*my function validation*/
                  funValidateForm();
              },
              error: function () {
              }
          });
      });

      function FillFormAddLocation(data) {

          $('#formLocationCreate #id').val(data.location.id)
          $('#formLocationCreate #location_fo').val(data.location.location_fo)
          $('#formLocationCreate #location_na').val(data.location.location_na)
          fillCityLocation(data.cities, data.location, data.destricts);
          $('#formLocationCreate #team_member').val(data.location.team_member)
          $('#formLocationCreate #team_member').selectpicker('refresh');
      }

      function fillCityLocation(cities, location, destricts) {
          $.each(cities, function (index, value) {
              if (index == location.city_id) {
                  $("#city_id").append('<option selected value=' + index + '>' + value + '</option>');

              } else {
                  $("#city_id").append('<option value=' + index + '>' + value + '</option>');

              }
          });
          $('#formLocationCreate #city_id').val(location.city_id)
          $('#formLocationCreate #city_id').selectpicker('refresh');
          fillDestrictLocation(location, destricts);

      }

      function fillDestrictLocation(location, destricts) {

          $.each(destricts, function (index, value) {
              if (index == location.destrict_) {
                  $("#destrict_").append('<option selected value=' + index + '>' + value + '</option>');

              } else {
                  $("#destrict_").append('<option value=' + index + '>' + value + '</option>');

              }
          });
          $('#formLocationCreate #destrict_').val(location.destrict_)
          $('#formLocationCreate #destrict_').selectpicker('refresh');
      }

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


      
      
      
      
      
      
      
      
      
      

      
      
      
      
      
      
      
      
      
      

      


      $(document).on('click', '#activitySetting', function (e) {
          e.preventDefault();
          $('#modalActivitySetting').modal('show');
      });


      $(document).on('submit', '#addActivitySetting', function (e) {
          e.preventDefault();

          var url = $(this).attr('action');
          var data_ = $(this).serialize();
          $.ajax({
              url: url,
              type: 'post',
              data: data_,
              beforeSend: function () {
                  $('#addActivitySetting #submitActivitySetting .loader').show();
                  $('#addActivitySetting #submitActivitySetting').prop("disabled", true);
              },
              success: function (data) {

                  if (data.status == true) {
                      $('#addActivitySetting #submitActivitySetting .loader').hide();
                      $('#addActivitySetting #submitActivitySetting').prop("disabled", false);
                      $('#activity_achievements .collapse-group').append(data.html);
                      myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                  }
              },
              error: function (data) {
              }
          });


      });


      $(document).on('click', '#achievementTypeSearch', function (e) {
          e.preventDefault();
          var url = '<?php echo e(route("activity.activityAchievementType")); ?>';
          var data_ = $('#addActivitySetting').serialize();
          $.ajax({
              url: url,
              type: 'post',
              data: data_,
              beforeSend: function () {
                  $('#addActivitySetting #div-search .loader').show();
                  $('#addActivitySetting #achievementTypeSearch').prop("disabled", true);
              },
              success: function (data) {
                  if (data.status == true) {
                      $('#addActivitySetting #div-search .loader').hide();
                      $('#addActivitySetting #achievementTypeSearch').prop("disabled", false);

                      $('#addActivitySetting table tbody tr').remove();
                      $('#addActivitySetting table tbody').append(data.html);
                  }
              },
              error: function (data) {
              }
          });


      })

      $(document).on('click', '#achievementTypeAll', function (e) {
          e.preventDefault();
          var url = '<?php echo e(route("activity.achievementTypeAll")); ?>';
          var data_ = $('#addActivitySetting').serialize();
          $.ajax({
              url: url,
              type: 'post',
              data: data_,
              beforeSend: function () {
                  $('#addActivitySetting #div-search .loader').show();
                  $('#addActivitySetting #achievementTypeAll').prop("disabled", true);
              },
              success: function (data) {
                  if (data.status == true) {
                      $('#addActivitySetting #div-search .loader').hide();
                      $('#addActivitySetting #achievementTypeAll').prop("disabled", false);

                      $('#addActivitySetting table tbody tr').remove();
                      $('#addActivitySetting table tbody').append(data.html);
                  }
              },
              error: function (data) {
              }
          });


      })

      // //////////////////////////////////////////////////////////////////////////
      // beneficicary *************

      /*******************when project change in form sub activity  */


      $(document).on('click', '#AddBeneficiary', function (e) {
          e.preventDefault();
          cleanFormAddBeneficiary();
          //  getCityByActivity();
      });

      function cleanFormAddBeneficiary() {
          $('#formSearchBeneficiary #city_id').val('');
          $('#formSearchBeneficiary #city_id').selectpicker('refresh');
          $('#formSearchBeneficiary #destrict_').val('');
          $('#formSearchBeneficiary #destrict_').selectpicker('refresh');
          $('#formSearchBeneficiary #search').val('');
          $('#formSearchBeneficiary #beneficiary_type').val('');
          $('#formSearchBeneficiary #beneficiary_type').selectpicker('refresh');
          $('#addActualBeneficiarySelected').attr('hidden', 'hidden');
          $('#result_search_actual .card-body').html('')
          $('#result_search_actual .card-body').perfectScrollbar();
          $('#addActualBeneficiarySelected .loader').css('display', 'none');
      }

      function getCityByActivity() {
          var activity_id = $('#formSearchBeneficiary #activity_id').val();
          $url = '<?php echo e(route("activity.getCityByActivity")); ?>' + '/' + activity_id;

          $.ajax({
              url: $url,
              dataTypes: 'json',
              type: 'get',
              beforeSend: function () {
                  $("#formSearchBeneficiary #city_id option").remove();
                  $("#formSearchBeneficiary #city_id ").append("<option  style='height: 37px;' value></option>");
                  $('#formSearchBeneficiary #city_id').selectpicker('refresh');
                  $("#formAchievementSearchBeneficiary #city_id option").remove();
                  $("#formAchievementSearchBeneficiary #city_id ").append("<option  style='height: 37px;' value></option>");
                  $('#formAchievementSearchBeneficiary #city_id').selectpicker('refresh');
              },
              success: function (data) {
                  if (data.status == true) {
                      selectCity_(data.cities);
                  }

                  $('#formSearchBeneficiary #city_id').selectpicker('refresh');
                  $('#formAchievementSearchBeneficiary #city_id').selectpicker('refresh');
              },
              error: function () {
              }
          });
      };

      function selectCity_(data) {
          $.each(data, function (index, value) {
              $("#formSearchBeneficiary #city_id").append('<option value=' + index + '>' + value + '</option>');
              $("#formAchievementSearchBeneficiary #city_id").append('<option value=' + index + '>' + value + '</option>');
          });
      }


      $(document).on('change', '#formSearchBeneficiary #city_id', function (e) {
          e.preventDefault();
          var city_id = $(this).val();
          var activity_id = $('#formSearchBeneficiary #activity_id').val();
          $url = '<?php echo e(route("activity.getDistanceByCityId")); ?>' + '/' + activity_id + '/' + city_id;

          $.ajax({
              url: $url,
              dataTypes: 'json',
              type: 'get',
              beforeSend: function () {
                  $("#formSearchBeneficiary #destrict_ option").remove();
                  $("#formSearchBeneficiary #destrict_ ").append("<option  style='height: 37px;' value></option>");
                  $('#formSearchBeneficiary #destrict_').selectpicker('refresh');
              },
              success: function (data) {
                  if (data.status == true) {
                      selectDestrice(data.district);
                  }

                  $('#formSearchBeneficiary #destrict_').selectpicker('refresh');
              },
              error: function () {
              }
          });
      });

      function selectDestrice(data) {
          $("#formSearchBeneficiary #destrict_ option").remove();
          $("#formSearchBeneficiary #destrict_").append('<option value="" ></option>');
          $.each(data, function (index, value) {
              $("#formSearchBeneficiary #destrict_").append('<option value=' + index + '>' + value + '</option>');
          });
      }


      $(document).on('submit', '#formSearchBeneficiary', function (e) {
          e.preventDefault();
          var data = $(this).serialize();
          var url_ = $(this).attr('action');
          ;
          $.ajax({
              url: url_,
              dataTypes: 'html',
              data: data,
              type: 'post',
              beforeSend: function () {
                  $('#addActualBeneficiarySelected').attr('hidden', 'hidden');
                  $('#result_search_actual .card-body').empty()
                  $('.loader').css('display', 'block');
              },
              success: function (data) {
                  if (data.status == true) {
                      if (data.beneficiariesAllVw_count == 0) {
                          $('#result_search_actual .card-body').html(data.dataNotFound);
                          $('.loader').css('display', 'none');

                      } else {
                          $('#addActualBeneficiarySelected').removeAttr('hidden');
                          $('#result_search_actual .card-body').html(data.html);
                          $('#result_search_actual .card-body').perfectScrollbar();
                          $('.loader').css('display', 'none');
                      }

                  } else {
                      $('.loader').css('display', 'none');
                      $('#addActualBeneficiarySelected').attr('hidden', 'hidden');
                  }
              },
              error: function () {
                  $('.loader').css('display', 'none');
                  $('#addActualBeneficiarySelected').attr('hidden', 'hidden');
              }
          })
      });
      $(document).on('click', '#addActualBeneficiarySelected', function (e) {
          e.preventDefault();

          var beneficiary_ids = [];
          $("#result_search_actual input:checkbox[name='id_type[]']:checked").each(function () {
              beneficiary_ids.push($(this).val());
          });
          var activity_id = $("#formSearchBeneficiary #activity_id").val();
          var city_id = $("#formSearchBeneficiary #city_id").val();
          var destrict_ = $("#formSearchBeneficiary #destrict_").val();
          var data = 'beneficiary_ids=' + beneficiary_ids + '&activity_id=' + activity_id + '&city_id=' + city_id + '&destrict_=' + destrict_;
          var url_ = '<?php echo e(route('activity.addBeneficiarySelected')); ?>';

          $.ajax({
              url: url_,
              dataTypes: 'json',
              data: data,
              type: 'post',
              beforeSend: function () {
                  $('#addActualBeneficiarySelected .loader').css('display', 'block');
              },
              success: function (data) {
                  if (data.status == true) {
                      $('#addActualBeneficiarySelected').attr('hidden', 'hidden');
                      $('#result_search_actual .card-body').html('')
                      $('#result_search_actual .card-body').perfectScrollbar();
                      $('#addActualBeneficiarySelected .loader').css('display', 'none');
                      $('#BeneficiaryTable').html('');
                      $('#BeneficiaryTable').html(data.html);
                      DataTableCall('#BeneficiaryTable table', 6);
                      $('#actual_beneficiary_list .card-body').perfectScrollbar();
                      $('#modalBeneficiary').modal('hide')

                  } else {
                      $('#addActualBeneficiarySelected .loader').css('display', 'none');

                  }
                  myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

              },
              error: function () {
              }
          })
      });

      $(document).on('click', '.btnDeleteActivityBeneficiary', function (e) {
          e.preventDefault();
          $this = $(this);
          swal({
              text: '<?php echo e($btnDeleteBeneficiaries['text']); ?>',
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

      // ------------ achievement  tabe


      $(document).on('click', '.addBeneficiaryToAchievement', function (e) {
          e.preventDefault();
          cleanFormAddBeneficiaryToAchievement();
          var achievement_type = $(this).attr('data-achievement_type');
          $('#formAchievementSearchBeneficiary #achievement_type').val(achievement_type);
          //  getCityByActivity();
      });

      function cleanFormAddBeneficiaryToAchievement() {
          $('#formAchievementSearchBeneficiary #achievement_type').val('');
          $('#formAchievementSearchBeneficiary #city_id').val('');
          $('#formAchievementSearchBeneficiary #city_id').selectpicker('refresh');
          $('#formAchievementSearchBeneficiary #destrict_').val('');
          $('#formAchievementSearchBeneficiary #destrict_').selectpicker('refresh');
          $('#formAchievementSearchBeneficiary #search').val('');
          $('#formAchievementSearchBeneficiary #beneficiary_type').val('');
          $('#formAchievementSearchBeneficiary #beneficiary_type').selectpicker('refresh');
          $('#formAchievementSearchBeneficiary #addABeneficiarySelected').attr('hidden', 'hidden');
          $('#modalAchievementBeneficiary #addABeneficiarySelected .loader').css('display', 'block');
          $('#modalAchievementBeneficiary  #result_search_a_b .card-body').html('')
          $('#modalAchievementBeneficiary #result_search_a_b .card-body').perfectScrollbar();
      }


      $(document).on('change', '#formAchievementSearchBeneficiary #city_id', function (e) {
          e.preventDefault();
          var city_id = $(this).val();
          var activity_id = $('#formAchievementSearchBeneficiary #activity_id').val();
          $url = '<?php echo e(route("activity.getDistanceByCityId")); ?>' + '/' + activity_id + '/' + city_id;

          $.ajax({
              url: $url,
              dataTypes: 'json',
              type: 'get',
              beforeSend: function () {
                  $("#formAchievementSearchBeneficiary #destrict_ option").remove();
                  $("#formAchievementSearchBeneficiary #destrict_ ").append("<option  style='height: 37px;' value></option>");
                  $('#formAchievementSearchBeneficiary #destrict_').selectpicker('refresh');
              },
              success: function (data) {
                  if (data.status == true) {
                      selectDestriceAchievementSearchBeneficiary(data.district);
                  }

                  $('#formAchievementSearchBeneficiary #destrict_').selectpicker('refresh');
              },
              error: function () {
              }
          });
      });

      function selectDestriceAchievementSearchBeneficiary(data) {
          $("#formAchievementSearchBeneficiary #destrict_ option").remove();
          $("#formAchievementSearchBeneficiary #destrict_").append('<option value="" ></option>');
          $.each(data, function (index, value) {
              $("#formAchievementSearchBeneficiary #destrict_").append('<option value=' + index + '>' + value + '</option>');
          });
      }


      $(document).on('submit', '#formAchievementSearchBeneficiary', function (e) {
          e.preventDefault();
          var achievement_type = $(this).attr('data-achievement_type');
          // var activity_id = $('#formActivityMainAdd #id').val();
          // if (activity_id === undefined) {
          //     activity_id = $('#formSubActivity #id').val();
          // }
          var data = $(this).serialize();
          var url_ = $(this).attr('action');
          $.ajax({
              url: url_,
              dataTypes: 'html',
              data: data,
              type: 'post',
              beforeSend: function () {
                  $('#modalAchievementBeneficiary #addABeneficiarySelected').attr('hidden', 'hidden');
                  $('#modalAchievementBeneficiary #addABeneficiarySelected .loader').css('display', 'block');
                  $('#formAchievementSearchBeneficiary .loader').css('display', 'block');
                  $('#modalAchievementBeneficiary  #result_search_a_b .card-body').html('')
              },
              success: function (data) {
                  if (data.status == true) {
                      if (data.beneficiariesAllVw_count == 0) {
                          $('#modalAchievementBeneficiary #result_search_a_b .card-body').html(data.dataNotFound);

                      } else {
                          $('#modalAchievementBeneficiary #addABeneficiarySelected').removeAttr('hidden');
                          $('#modalAchievementBeneficiary #result_search_a_b .card-body').html(data.html);
                          $('#modalAchievementBeneficiary #result_search_a_b .card-body').perfectScrollbar();
                      }
                      $('#formAchievementSearchBeneficiary .loader').css('display', 'none');


                  } else {
                      $('#formAchievementSearchBeneficiary .loader').css('display', 'none');
                  }
              },
              error: function () {
                  $('#formAchievementSearchBeneficiary .loader').css('display', 'none');
                  ;
              }
          })
      });


      
      
      
      
      
      
      

      

      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      

      
      

      
      
      
      
      
      

      


      $(document).on('submit', '#formStoreBeneficiary', function (e) {
          e.preventDefault();
          var achievement_type = $('#formStoreBeneficiary [name="achievement_type_id"]').val();
          var data = $(this).serialize();
          var url_ = $(this).attr('action');
          var activity_id = $('#formActivityMainAdd #id').val();
          if (activity_id === undefined) {
              activity_id = $('#formSubActivity #id').val();
          }
          console.log(achievement_type);
          var data_ = data + '&activity_id=' + activity_id;
          $.ajax({
              url: url_,
              dataTypes: 'html',
              data: data_,
              type: 'post',
              beforeSend: function () {
                  $('#modalAchievementBeneficiary #addABeneficiarySelected').prop("disabled", true);
                  $('#modalAchievementBeneficiary #addABeneficiarySelected .loader').css('display', 'block');
              },
              success: function (data) {
                  if (data.status == true) {
                      $('#modalAchievementBeneficiary #addABeneficiarySelected').prop("disabled", false);
                      $('#modalAchievementBeneficiary #addABeneficiarySelected .loader').css('display', 'none');
                      $('#modalAchievementBeneficiary').modal('hide');
                      console.log(achievement_type, data.html);
                      $('#achievementBeneficiaryTable_' + achievement_type).html(data.html);
                      $('.achievement_date').datetimepicker({
                          format: 'DD/MM/YYYY'
                      });

                  } else {
                      $('#modalAchievementBeneficiary #addABeneficiarySelected').prop("disabled", false);
                      $('#modalAchievementBeneficiary #addABeneficiarySelected .loader').css('display', 'none');
                  }
                  myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
              },
              error: function () {
                  $('.loader').css('display', 'none');
                  $('#addActualBeneficiarySelected').attr('hidden', 'hidden');
              }
          })
      });


      $(document).on('submit', '.storeValueAchievementBeneficiary', function (e) {
          e.preventDefault();
          $this = $(this);
          var data_ = $(this).serialize();
          var url_ = $(this).attr('action');
          $.ajax({
              url: url_,
              dataTypes: 'json',
              data: data_,
              type: 'post',
              beforeSend: function () {
                  $($this).find('#addActivityBeneficiariesValueBtn').prop("disabled", true);
                  $($this).find('#addActivityBeneficiariesValueBtn .loader').css('display', 'block');
              },
              success: function (data) {
                  if (data.status == true) {
                      $($this).find('#addActivityBeneficiariesValueBtn').prop("disabled", false);
                      $($this).find('#addActivityBeneficiariesValueBtn .loader').css('display', 'none');
                  }
                  myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
              },
              error: function () {
                  $($this).find('#addActivityBeneficiariesValueBtn').prop("disabled", false);
                  $($this).find('#addActivityBeneficiariesValueBtn .loader').css('display', 'none');
              }
          })
      });

      $(document).on('click', '.achievement_beneficiary_remove', function (e) {
          e.preventDefault();
          var url_delete = $(this).attr('href');
          $this__ = $(this);

          swal({
              text: '<?php echo e($messageDeleteActivityLocation['text']); ?>',
              confirmButtonClass: 'btn btn-success  btn-sm',
              cancelButtonClass: 'btn btn-danger  btn-sm',
              buttonsStyling: false,
              showCancelButton: true
          }).then(result => {
              if (result == true) {
                  // var project_id = $('#formProjectMain #id').val();

                  $.ajax({
                      url: url_delete,
                      type: 'delete',
                      beforeSend: function () {

                      },
                      success: function (data) {
                          if (data.status == true) {
                              console.log(data.status);
                              myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                              $($this__).closest('tr').css('background', 'red').delay(1000).hide(1000);

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

      $(".open-button").on("click", function () {
          $(this).closest('.collapse-group').find('.collapse').collapse('show');
      });

      $(".close-button").on("click", function () {
          $(this).closest('.collapse-group').find('.collapse').collapse('hide');
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

  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
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