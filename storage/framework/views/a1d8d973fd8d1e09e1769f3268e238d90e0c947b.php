<?php if(sizeof($activityBeneficiariesVm)>0): ?>
  <?php echo Form::open(['route' => 'activity.storeBeneficiary' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formStoreBeneficiary']); ?>


  <input type="hidden" name="achievement_type_id"  value="<?php echo e($achievement_type); ?>">
  <div class="col-md-12" align="center">
    <table class="table table-hover table-bordered">
      <thead>
      <tr align="center">
        <td></td>
        <td>
          <?php echo e($labels['beneficiary_name']??'beneficiary_name'); ?>

        </td>
        <td>
          <?php echo e($labels['idno']??'idno'); ?>

        </td>
      </tr>
      </thead>
      <tbody>
      <?php $__currentLoopData = $activityBeneficiariesVm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $beneficiary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr align="center">
          <td>
            <div class="form-check" style="padding: 3px;margin: 1px;">
              <label class="form-check-label" style="padding: 0px;margin: 0px">
                <input class="form-check-input" type="checkbox" value="<?php echo e($beneficiary->activity_bene_id); ?>"
                       name="beneficiary_id[]" style="padding: 0px;margin: 0px">
                <span class="form-check-sign">
                             <span class="check"></span>
                       </span>
              </label>
            </div>
          </td>
          <td><?php echo e($beneficiary->{'ben_name_'.lang_character()}); ?></td>
          <td><?php echo e($beneficiary->ben_idno); ?></td>
        </tr>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
  </div>
  <div class="col-md-12" align="center">
    <button type="submit"  class="btn btn-sm btn-rose" id="addABeneficiarySelected"
       data-toggle="tooltip" data-placement="top" title="Add">
      <?php echo e($labels['add_selected']??'add_selected'); ?>

      <div class="loader pull-left" style="display: none;"></div>
    </button>
  </div>
  <?php echo Form::close(); ?>

<?php endif; ?>
