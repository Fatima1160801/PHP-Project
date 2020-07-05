<?php if(sizeof($activityAchievementBeneficiariesVW)>0): ?>
  <?php echo Form::open(['route' => 'activity.storeValueAchievementBeneficiary' ,'novalidate'=>'novalidate','action'=>'post' ,'class'=>'storeValueAchievementBeneficiary']); ?>


  <input type="hidden" name="c_achivement_type_id" value="<?php echo e($c_achivement_type_id); ?>">
  <input type="hidden" name="activity_id" value="<?php echo e($activity_id); ?>">
  <div class="table-responsive">
    <table class="table table-bordered  ">
      <thead  class=" text-primary">
      <tr align="center">
        <td>#</td>
        <td>
          <?php echo e($labels['beneficiary_name']??'beneficiary_name'); ?>w
        </td>
        <td>
          <?php echo e($labels['beneficiary_type']??'beneficiary_type'); ?>

        </td>
        <td>
          <?php echo e($labels['governorate']??'governorate'); ?>

        </td>
        <td>
          <?php echo e($labels['location']??'location'); ?>

        </td>

        <?php if(sizeof($attachmentTypeMetrics)>0): ?>
          <?php $__currentLoopData = $attachmentTypeMetrics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metrics): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td>
              <?php echo e($metrics->{'ach_type_metric_'.lang_character1()}); ?>

              / <?php echo e($metrics->unit->{'unit_name_'.lang_character1()}); ?>

            </td>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <td>
          <?php echo e($labels['actual_budget_value']??'actual_budget_value'); ?>

        </td>

        <td>
          <?php echo e($labels['actual_contribution_value']??'actual_contribution_value'); ?>

        </td>
        <td>
          <?php echo e($labels['achivement_date']??'achivement_date'); ?>

        </td>
        <td>
          <?php echo e($labels['action']??'action'); ?>


        </td>

      </tr>
      </thead>
      <tbody>
      <?php $__currentLoopData = $activityAchievementBeneficiariesVW; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$beneficiary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr align="center">
          <td><?php echo e($index+1); ?></td>
          <td> <?php echo e($beneficiary->{'ben_name_'.lang_character()}); ?> </td>
          <td><?php echo e($beneficiary->{'beneficieris_types_name_'.lang_character()}); ?></td>
          <td><?php echo e($beneficiary->{'city_name_'.lang_character1()}); ?></td>
          <td><?php echo e($beneficiary->{'district_name_'.lang_character1()}); ?></td>

          <?php if(sizeof($attachmentTypeMetrics)>0): ?>
            <?php $__currentLoopData = $attachmentTypeMetrics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metrics): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <td>
                <?php
                  $metrics_value ="";
                    $activityAchievemetBeneficiaryDTS_= $activityAchievemetBeneficiaryDTS->where('beneficiary_id', $beneficiary->activity_beneficiaries_id)
                             ->where('c_achivement_type_metric_id',$metrics->id)->first();
                              if($activityAchievemetBeneficiaryDTS_){
                             $metrics_value =$activityAchievemetBeneficiaryDTS_->metric_value;
                             }

                ?>
                <input type="text" style="width: 100px !important;"  class="form-control  check-is-number "
                       name="metrics[<?php echo e($beneficiary->activity_beneficiaries_id); ?>][<?php echo e($metrics->id); ?>]"
                       value="<?php echo e($metrics_value); ?>">
              </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>

          <td>
            <input type="text" style="width: 100px !important;"  class="form-control  check-is-number input-currency-gf"
                     name="actualBudget[<?php echo e($beneficiary->activity_beneficiaries_id); ?>]"
                     value="<?php echo e(number_currency_format($beneficiary->actual_budget_value)); ?>"></td>
          <td><input type="text" style="width: 100px !important;" class="form-control  check-is-number input-currency-gf"
                     name="actualContribution[<?php echo e($beneficiary->activity_beneficiaries_id); ?>]"
                     value="<?php echo e(number_currency_format($beneficiary->actual_contribution_value)); ?>"></td>
          <td>
           <div  x-style="position:relative;">
            <input type="text" style="width: 100px !important;"
                     class="form-control achievement_date"
                     name="achievement_date[<?php echo e($beneficiary->activity_beneficiaries_id); ?>]"
                     value="<?php echo e(dateFormatSite($beneficiary->achivement_date)); ?>">
           </div></td>
          <td>
            <a href="<?php echo e(route('activity.achievement_beneficiary_remove',[$activity_id,$c_achivement_type_id,$beneficiary->activity_beneficiaries_id])); ?>" class="btn btn-danger btn-round btn-sm btn-fab achievement_beneficiary_remove">
              <i class="fa fa-remove"></i>
            </a>
          </td>
        </tr>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
   </div>

  <div class="col-md-12">
    <button btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right"
            id="addActivityBeneficiariesValueBtn">
      <?php echo e($labels['save'] ??'save'); ?>

      <div class="loader pull-left" style="display: none;"></div>
    </button>
  </div>


  <?php echo Form::close(); ?>


<?php endif; ?>
