<div class="col-md-6 pull-left">

<h6 style="text-transform: capitalize;font-weight: bold;" class="pull-left mr-5">Status : <span style="text-transform: capitalize;font-weight:normal;color:<?php echo e($color); ?>;" id="title-app-rej"><?php echo e($status_text); ?></span></h6>
<?php if($status_id!=1): ?>
<h6 style="text-transform: capitalize;font-weight: bold;" class="pull-left mr-5">By : <span id="title-app-rej-by" style="text-transform: capitalize;font-weight: normal;color:<?php echo e($color); ?>;"><?php echo e($field_name); ?></span></h6>
<?php endif; ?>
<h6 style="text-transform: capitalize;font-weight: bold;" class="pull-left mr-5">Date : <span id="title-app-rej-date" style="text-transform: capitalize;font-weight: normal;color:<?php echo e($color); ?>;"><?php echo e($at); ?></span></h6>
</div>
<div class="col-md-6 pull-right">
    <div class="pull-left col-md-4">
        <h6 style="text-transform: capitalize;font-weight: bold;" >Created By : <span id="title-create-by" style="text-transform: capitalize;font-weight: normal;"><?php echo e($field_name); ?></span></h6>
    </div>
<div class="pull-left col-md-8">
    <?php if($opport_id !=0): ?>
    <a href="<?php echo e(route('opportunity.opportunity.edit',$opport_id ?? 0)); ?>" style="font-size: 12px;color: #3F51B5;" class="pull-left col-md-6" id=""><div class="ripple-container"></div><i class="material-icons">link</i>Opportunity No : <?php echo e($opport_id ?? 0); ?></a>
    <?php endif; ?>
    <?php if($propo_id !=0): ?>
    <a href="<?php echo e(route('proposal.proposal.edit',$propo_id ?? 0)); ?>" style="font-size: 12px;color: #3F51B5;" class="pull-left col-md-6" id=""><div class="ripple-container"></div><i class="material-icons">link</i>Proposal No : <?php echo e($propo_id ?? 0); ?></a>
   <?php endif; ?>
</div>
</div>
<div class="clearfix"></div>
