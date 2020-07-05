<br>
<div class="row" style="margin-bottom: 40px">
    <div class="col-md-12">
        <a href="<?php echo e(route('project.project.donors.create')); ?>" id="AddDonors"
           class="btn btn-sm btn-primary "
           data-toggle="modal" data-target="#modalDonors" rel="tooltip"
           data-original-title="<?php echo e($labels['donor_add'] ?? 'donor_add'); ?>" title="" data-placement="top">
            <i class="material-icons">add</i>
            <?php echo e($labels['donor_add'] ?? 'donor_add'); ?>

        </a>

        <a href="<?php echo e(route('project.project.donors.partner.create')); ?>" id="AddDonors"
           class="btn btn-sm btn-primary "
           data-toggle="modal" data-target="#modalDonors" rel="tooltip"
           data-original-title="<?php echo e($labels['partner_add'] ?? 'partner_add'); ?>" title="" data-placement="top">
            <i class="material-icons">add</i>
            <?php echo e($labels['partner_add'] ?? 'partner_add'); ?>

        </a>
    </div>
</div>
<br>
<input type="hidden" id="flag_reload_index_donor" value="0">

<div class="row">

    <?php if(isset($projectDonor) && $projectDonor->count()<=0): ?>
        <div class="col-md-12" align="center">
                 
         </div>
    <?php endif; ?>


    <?php if($projectDonor != null): ?>
        <div class="col-md-6"  style=" background:#efefef;    text-align: center; ">

            <p style=" font-size: 17px; padding: 10px; "><?php echo e($labels['funders_agreement_with'] ?? 'funders_agreement_with'); ?> </p>

            <div class="row"  style="margin:5px;">

                <?php $__currentLoopData = $projectDonor->where('type',0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $donor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="margin-top: 50px" class="col-md-6" id="donor_<?php echo e($donor->donor_id); ?>">
                        <div class="card card-profile" style="box-shadow: 0 1px 9px 3px rgba(12, 12, 12, 0.14);">
                            <div class="card-avatar">
                                <a href="#pablo">
                                    <?php if($donor->donor->donor_logo): ?>
                                        <img class="img"
                                             src="<?php echo e(asset('images/user/photo').'/'.$donor->donor->donor_logo); ?>"
                                             style="width: 100px;height: 100px">
                                    <?php else: ?>
                                        <img style="width: 100px;height: 100px"
                                             src="<?php echo e(asset('assets/img/placeholder.png')); ?>"/>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="card-body" align="center" style="text-align: center">
                                <h4 class="card-category text-gray">
                                    <h5 class="badge badge-rose" style="font-size: 13px"><?php echo e($donor->share_percent); ?>

                                        %
                                    </h5>
                                </h4>
                                <h6 class="card-category text-gray">
                                    <h5 class="badge badge-primary"
                                        style="font-size: 13px"><?php echo e(round($donor->budget,2) .' '.$currencies); ?></h5>
                                </h6>
                                <?php if($donor->projectDonorsType ): ?>
                                    <h6 class="card-category text-gray">
                                        <h5 class="badge badge-primary">
                                            <?php echo e($donor->projectDonorsType->{'project_donors_type_name_'.lang_character()}); ?>

                                        </h5>
                                    </h6>
                                <?php endif; ?>

                                <h4 class=" text-align-center">
                                    <?php echo e($donor->donor? $donor->donor->{'donor_name_'.lang_character()} :''); ?>

                                </h4>


                                <p class="card-description">
                                </p>

                                <a href="<?php echo e(route('project.project.donors.edit',[$donor->project_id ,$donor->donor_id])); ?>"
                                   rel="tooltip" class="btn btn-sm   btn-round btn-success btn-fab"
                                   data-toggle="modal" data-target="#modalDonors"
                                   rel="tooltip" data-original-title="" title="<?php echo e($labels['edit'] ?? 'edit'); ?>"
                                   data-placement="top" id="EditDonors">
                                    <i class="material-icons">edit</i>
                                </a>

                                <a data-id="<?php echo e($donor->donor_id); ?>"
                                   href="<?php echo e(route('project.project.donors.delete',[$donor->project_id ,$donor->donor_id])); ?>"
                                   id="btnDeleteDonor" rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab"
                                   data-placement="top" title="<?php echo e($labels['delete'] ?? 'delete'); ?>">
                                    <i class="material-icons">delete</i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="col-md-6" style="background: #e9e9e9;text-align: center;" >
            <p style=" font-size: 17px; padding: 10px; "> <?php echo e($labels['partners'] ?? 'partners'); ?> </p>
            <div class="row" style="margin:5px;"  >



                <?php $__currentLoopData = $projectDonor->where('type',1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $donor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="margin-top: 50px" class="col-md-6" id="donor_<?php echo e($donor->donor_id); ?>">
                        <div class="card card-profile" style="box-shadow: 0 1px 9px 3px rgba(12, 12, 12, 0.14);">
                            <div class="card-avatar">
                                <a href="#pablo">
                                    <?php if($donor->donor->donor_logo): ?>
                                        <img class="img"  src="<?php echo e(asset('images/user/photo').'/'.$donor->donor->donor_logo); ?>"
                                             style="width: 100px;height: 100px">
                                    <?php else: ?>
                                        <img style="width: 100px;height: 100px" src="<?php echo e(asset('assets/img/placeholder.png')); ?>"/>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="card-body" align="center" style="text-align: center">
                                <h4 class="card-category text-gray">
                                    <h5 class="badge badge-rose" style="font-size: 13px"><?php echo e($donor->share_percent); ?>

                                        % </h5>
                                </h4>
                                <h6 class="card-category text-gray">
                                    <h5 class="badge badge-primary"
                                        style="font-size: 13px"><?php echo e(round($donor->budget,2) .' '.$currencies); ?></h5>
                                </h6>
                                <?php if($donor->projectDonorsType ): ?>
                                    <h6 class="card-category text-gray">
                                        <h5 class="badge badge-primary">
                                            <?php echo e($donor->projectDonorsType->{'project_donors_type_name_'.lang_character()}); ?>

                                        </h5>
                                    </h6>
                                <?php endif; ?>


                                <h4 class=" text-align-center">
                                    <?php echo e($donor->donor->donor_name_na); ?>

                                </h4>
                                <p class="card-description">
                                </p>

                                <a href="<?php echo e(route('project.project.donors.partner.edit',[$donor->project_id ,$donor->donor_id])); ?>"
                                   rel="tooltip" class="btn btn-sm   btn-round btn-success btn-fab"
                                   data-toggle="modal" data-target="#modalDonors"
                                   rel="tooltip" data-original-title="" title="<?php echo e($labels['edit'] ?? 'edit'); ?>"
                                   data-placement="top" id="EditDonors">
                                    <i class="material-icons">edit</i>
                                </a>

                                <a data-id="<?php echo e($donor->donor_id); ?>"
                                   href="<?php echo e(route('project.project.donors.delete',[$donor->project_id ,$donor->donor_id])); ?>"
                                   id="btnDeleteDonor" rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab"
                                   data-placement="top" title="<?php echo e($labels['delete'] ?? 'delete'); ?>">
                                    <i class="material-icons">delete</i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

    <?php endif; ?>

</div>







