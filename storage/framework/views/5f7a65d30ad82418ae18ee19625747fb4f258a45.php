<?php if(isset($attachment) && $attachment != null): ?>
  <input type="hidden" name="attachment_id" value="<?php echo e($attachment->id); ?>">
<?php endif; ?>
  <?php
  $att_path1 = str_replace('server.php','',$_SERVER['PHP_SELF']);
  $str = '';
  if(isset($attachment) && $attachment != null){
        $appendedFile = [
            "name" => $attachment->file_path,
	        "type" => $attachment->file_type,
	        "size" => filesize('public/attach/' . $attachment->file_path),
	        "file" => 'public/attach/'.$attachment->file_path,
	        "data" => [
	            "url" => $att_path1.'attach/'.$attachment->file_path
	        ]
        ];
     $str = 'data-fileuploader-files='.json_encode($appendedFile).'';
  }else{
     $str = '';
  }
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
                    <select required class='form-control selectpicker' data-live-search="true" name='attachment_type_id' id='attachment_type_id'
                            data-style='btn btn-link'>
                        <option style='height: 37px;' value></option>
                        <?php if($attachment_types): ?>
                            <?php $__currentLoopData = $attachment_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option  <?php if(isset($attachment)): ?> selected <?php endif; ?> value="<?php echo e($key); ?>"><?php echo e($c); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
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
                    <input  class='form-control' id='desc' name='desc' type='text' value="<?php echo e((isset($attachment) && $attachment != null) ? $attachment->file_desc : ''); ?>" >
                </div>
            </div>
        </div>
    </div>
</div>

