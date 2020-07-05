<?php
  $att_path1 = str_replace('server.php','',$_SERVER['PHP_SELF']);
  $str = '';
   ?>
<div class="row">
    <div class='col-md-12'>
        <div class='row'>
            <label class='col-md-2 col-form-label choose-file-title' for='attachment'>
                <?php echo e($labels['choose_files'] ?? 'choose_files'); ?>


            </label>
            <div class=' col-md-8'>
                <div class='form-group has-default bmd-form-group'>
                    <input  accept="<?php echo e($accept); ?>" type="file" name="files" <?php echo e($str); ?>  data-fileuploader-limit="1">
                    <span style=" background: #f5f6fA; display: block; border-radius: 0px 0px 5px 5px; padding: 0 5px 2px 5px; font-size: 13px; font-weight: 500; color: #575757; ">
                        <?php echo implode(" ,",$attachments_allowed_types);  ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <input  type="hidden" name="attachment_type_id" value="<?php echo e($attachment_type_id); ?>">


    
        
            
                
            
            
                
                    
                            
                        
                        
                             
                                
                            
                        
                    
                
            
        
    

    <div class='col-md-12'>
        <div class='row'>
            <label class='col-md-2 col-form-label' for='title'>
                <?php echo e($labels['title'] ?? 'Title'); ?>

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
                <?php echo e($labels['description'] ?? 'Description'); ?>

            </label>
            <div class=' col-md-8'>
                <div class='form-group has-default bmd-form-group'>
                    <input  class='form-control' id='desc' name='desc' type='text' value="" >
                </div>
            </div>
        </div>
    </div>
</div>

