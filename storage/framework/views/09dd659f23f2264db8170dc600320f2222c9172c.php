
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
    <?php $__currentLoopData = $beneficiariesAllVw; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $beneficiary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr align="center">
            <td>
              <div class="form-check" style="padding: 3px;margin: 1px;">
                    <label class="form-check-label"  style="padding: 0px;margin: 0px">
                        <input class="form-check-input" type="checkbox" value="<?php echo e($beneficiary->id_type); ?>"
                               name="id_type[]"  style="padding: 0px;margin: 0px">
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


