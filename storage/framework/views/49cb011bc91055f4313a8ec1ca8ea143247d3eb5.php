<div class="col-md-6 pull-left">
    <h6 style="text-transform: capitalize;font-weight: bold;" class="pull-left mr-5">Status : <span style="text-transform: capitalize;font-weight:normal;color:<?php echo e($color); ?>;" id="title-app-rej"><?php echo e($status_text); ?></span></h6>
    <?php if($status_id!=1): ?>
        <h6 style="text-transform: capitalize;font-weight: bold;" class="pull-left mr-5">By : <span id="title-app-rej-by" style="text-transform: capitalize;font-weight: normal;color:<?php echo e($color); ?>;"><?php echo e($field_name); ?></span></h6>
    <?php endif; ?>
    <h6 style="text-transform: capitalize;font-weight: bold;" class="pull-left mr-5">Date : <span id="title-app-rej-date" style="text-transform: capitalize;font-weight: normal;color:<?php echo e($color); ?>;"><?php echo e($at); ?></span></h6>
</div>

<div class="col-md-4 pull-right">
    <h6 style="text-transform: capitalize;font-weight: bold;" class="pull-left col-md-4">Created By : <span id="title-create-by" style="text-transform: capitalize;font-weight: normal;"><?php echo e($field_name); ?></span></h6>
    <?php if($has_ref==true): ?>
    <?php if($ref_id!=0): ?>
    <?php if($type_ref==1): ?>
        <?php
         $link=  route('concept.concept.edit',$ref_data->id ?? 0);
         $text="Concept No. : ".$ref_data->id;
        ?>
    <?php else: ?>
        <?php
        $link=  route('proposal.proposal.edit',$ref_data->id ?? 0);
        $text="Proposal No. : ".$ref_data->id;
        ?>
    <?php endif; ?>
    <a href="<?php echo e($link ?? ""); ?>" style="font-size: 13px;" class="refer_link pull-left col-md-6" id=""><div class="ripple-container"></div><i class="material-icons">link</i><?php echo e($text ?? ""); ?></a>

    <?php endif; ?>
    <?php endif; ?>
</div>

<div class="clearfix"></div>
