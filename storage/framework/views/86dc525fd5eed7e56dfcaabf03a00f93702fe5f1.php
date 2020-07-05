<?php
  $att_path1 = str_replace('server.php','',$_SERVER['PHP_SELF']);
  $str = '';
   ?>
<div class="row">
    <div class='col-md-12'>
        <div class='row'>
            <label class='col-md-2 col-form-label' for='attachment'>
                <?php echo e($labels['choose_files'] ?? 'choose_files'); ?>


            </label>
            <div class=' col-md-8'>
                <div class='form-group has-default bmd-form-group'>
                    <input  accept="<?php echo e($accept); ?>" type="file" name="files" <?php echo e($str); ?>>
                    <span style=" background: #f5f6fA; display: block; border-radius: 0px 0px 5px 5px; padding: 0 5px 2px 5px; font-size: 13px; font-weight: 500; color: #575757; ">
                        <?php echo implode(" ,",$attachments_allowed_types);  ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-12'>
        <div class="row">
            <label for="city_id" class="col-md-2 col-form-label">
                <?php echo e($labels['attachment_types'] ?? 'attachment_types'); ?>

            </label>
            <div class="col-md-8">
                <div class='form-group has-default bmd-form-group'>
                    <select required class='form-control selectpicker list-of-types' data-live-search="true" name='attachment_type_id' id='attachment_type_id'
                            data-style='btn btn-link'>
                        <option style='height: 37px;' value></option>
                        <?php if($attachment_types): ?>
                             <?php $__currentLoopData = $attachment_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if($key == $attachment_type_id): ?> selected <?php endif; ?>  value="<?php echo e($key); ?>"><?php echo e($c); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class='col-md-12'>
        <div class='row'>
            <label class='col-md-2 col-form-label' for='title'>
                <?php echo e($labels['title'] ?? 'title'); ?>

            </label>
            <div class=' col-md-8'>
                <div class='form-group has-default bmd-form-group'>
                    <input  class='form-control' id='title' name='title' type='text' value="" >
                </div>
            </div>
        </div>
    </div>

    <div class='col-md-12'>
        <div class='row'>
            <label class='col-md-2 col-form-label' for='desc'>
                <?php echo e($labels['description'] ?? 'description'); ?>

            </label>
            <div class=' col-md-8'>
                <div class='form-group has-default bmd-form-group'>
                    <input  class='form-control' id='desc' name='desc' type='text' value="" >
                </div>
            </div>
        </div>
    </div>
</div>

