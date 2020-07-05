<?php $__env->startSection('content'); ?>


    <div class="col-md-12 col-12 mr-auto ml-auto">
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        

        <div style="background-color: #e91e63;cursor: pointer;color: #ffffff;" data-toggle="collapse"
             href="#collapseProject" role="button" aria-expanded="true" aria-controls="collapseExample2" class="">
            <div style="padding:10px"><h5 style="margin-bottom:1px">Project Info</h5></div>
        </div>
        <div class="collapse show" id="collapseProject">
            <div class="card">
                <div class="card-body">
                    <div class="row project_info_show">
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item">Reference No:<span><?php echo e($project->reference_no); ?></span></li>
                                <li class="list-group-item">Planned Start
                                    Date:<span><?php echo e(date('d M, Y',strtotime($project->plan_start_date))); ?></span></li>
                                <li class="list-group-item">Planned End
                                    Date:<span><?php echo e(date('d M, Y',strtotime($project->plan_end_date))); ?></span>
                                </li>
                                <?php $donors = $project->donors; ?>
                                <?php if($donors): ?>
                                    <?php if($donors->count()>0): ?>
                                        <?php if($donors_ = $donors->where('type',0)): ?>
                                            <?php if($donors_->count()>0): ?>
                                                <li class="list-group-item">
                                                    Donors :
                                                    <ul class="list-group">
                                                        <?php $__currentLoopData = $donors_; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$donor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                            <li class="list-group-item">  <?php echo e($index+1); ?>

                                                                - <?php echo e($donor->{'donor_name_'.lang_character()}); ?> </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </li>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if($partners =$donors->where('type',1)): ?>
                                            <?php if($partners->count()>0): ?>
                                                <li class="list-group-item">
                                                    Partners :
                                                    <ul class="list-group">
                                                        <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$donor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                            <li class="list-group-item">  <?php echo e($index+1); ?>

                                                                - <?php echo e($donor->{'donor_name_'.lang_character()}); ?> </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </li>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <li class="list-group-item">
                                    Institution Role
                                    :<span><?php echo e(Auth::user()->lang_id == 1 ? $project->category->category_name_na : $project->category->category_name_fo); ?></span>
                                </li>
                                <li class="list-group-item"> project
                                    budget:<span><?php echo e($project->currency ?$project->currency->currency_symbol :""); ?>

                                        <?php echo e($project->plan_budget); ?>

                                            <small><?php echo e($project->currency?$project->currency->currency_name_na :""); ?></small>
                                        </span>
                                </li>
                                <li class="list-group-item">Status:
                                    <?php if($project->is_hidden == 0): ?>
                                        <span class="badge-success badge">ongoing </span>
                                    <?php elseif($project->is_hidden == 1): ?>
                                        <span class="badge-danger badge">closed</span>
                                    <?php endif; ?>
                                </li>
                                <li class="list-group-item">
                                    <div class="w_user">
                                        <a href="<?php echo e(route('project.staff.edit',$project->manager_id)); ?>">
                                            <img class="rounded-circle"
                                                 src="<?php echo e(!empty($project->manager->avatar_) ? asset('images/user/photo/').'/'.$project->manager->avatar_ : asset('assets/img/placeholder.png')); ?>"
                                                 alt="">
                                            <div class="wid-u-info">
                                                <h5 style="color: #333333;font-weight: 500;"><?php echo e($project->manager ? $project->manager->{'staff_name_'.lang_character()} : ' '); ?></h5>
                                                <span class="badge-info badge">Project Manager</span>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                            </ul>


                        </div>
                        <div class="col-md-6">
                            <ul class="list-group">


                                <li class="list-group-item">Project
                                    Name:<span><?php echo e($project->{'project_name_'.lang_character()}); ?></span>
                                </li>
                                <li class="list-group-item">Project
                                    Description:<span><?php echo e(Auth::user()->lang_id == 1 ? $project->project_desc_na : $project->project_desc_fo); ?></span>
                                </li>
                                <br>
                                <li class="list-group-item">Institution contribution:
                                    <span style="width: 70%;">

                                            <?php echo e($project->currency ? $project->currency->currency_symbol :""); ?>

                                        <?php echo e($project->institution_contribution); ?>

                                            <small><?php echo e($project->currency?$project->currency->currency_name_na :""); ?></small>
                                    </span>
                                </li>
                                <li class="list-group-item">Donor contribution:
                                    <span style="width: 70%;">

                                            <?php echo e($project->currency ?$project->currency->currency_symbol :""); ?>

                                        <?php echo e($project->donor_contribution); ?>

                                            <small><?php echo e($project->currency?$project->currency->currency_name_na :""); ?></small>
                                    </span>
                                </li>
                                <li class="list-group-item">Other external contributions:
                                    <span style="width: 70%;">
                                              <?php echo e($project->currency ?$project->currency->currency_symbol :""); ?>

                                        <?php echo e($project->other_external_contributions); ?>

                                            <small><?php echo e($project->currency?$project->currency->currency_name_na :""); ?></small>

                                    </span>
                                </li>
                                <li class="list-group-item">Beneficiaries Types:

                                    <?php if(!empty($project_benf_types) && $project_benf_types != null): ?>

                                        <?php $__currentLoopData = $project_benf_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge-success badge">
                                                          <?php echo e($b->{'beneficieris_types_name_'.lang_character()}); ?>

                                                     </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php endif; ?>


                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <br> <!-- projectStaffs -->
        <div style="background-color: #e91e63;cursor: pointer;color: #ffffff;" data-toggle="collapse"
             href="#collapseProjectStaffs" role="button" aria-expanded="true" aria-controls="collapseExample2" class="">
            <div style="padding:10px"><h5 style="margin-bottom:1px">Project Staffs</h5></div>
        </div>
        <div class="collapse show" id="collapseProjectStaffs">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <?php echo $projectStaffs; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br> <!-- projectStaffs -->


        <br> <!-- projectStaffs -->
        <div style="background-color: #e91e63;cursor: pointer;color: #ffffff;" data-toggle="collapse"
             href="#collapseProjectStaffs" role="button" aria-expanded="true" aria-controls="collapseExample2" class="">
            <div style="padding:10px"><h5 style="margin-bottom:1px"> Activities </h5></div>
        </div>
        <div class="collapse show" id="collapseProjectStaffs">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>main activity name</th>
                                    <th> team</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($activities): ?>
                                    <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php echo e($activity->{'activity_name_'.lang_character()}); ?>

                                            </td>
                                            <td>
                                                <?php $staffs=  \App\Models\Activity\ActivityStaffVW::getStaffByActivity($activity->id);  ?>
                                                <?php if(count($staffs)>0): ?>

                                                    <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <span class="badge-dark badge">
                                                                  <?php echo e($staff->{'staff_name_'.lang_character()}); ?>

                                                            </span>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </td>
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
        <br> <!-- projectStaffs -->

    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <script>
        $(function () {

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

    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>
    <!-- Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>