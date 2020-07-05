<?php
  $att_path = str_replace('server.php','',$_SERVER['PHP_SELF']);
 ?>

<button data-href="<?php echo e(route('attachments.create')); ?>" id="btnFileModal" class="btn btn-sm btn-primary btn-round btn-fab"
        data-toggle="tooltip" data-placement="top"
        title="<?php echo e($labels['add_file'] ?? 'add_file'); ?>"
>
    <i class="material-icons">add</i></button>
<br><br>

<div class="material-datatables">
    <table class="table" id="attachments-table">
        <thead>
        <tr>
            <th>#</th>
            <th>
                <?php echo e($labels['file'] ?? 'file'); ?>

            </th>
            <th>
                <?php echo e($labels['attachment_types']??'attachment_types'); ?>

            </th>
            <th>
                <?php echo e($labels['description'] ?? 'description'); ?>

            </th>
            <th>
                <?php echo e($labels['actions'] ?? 'actions'); ?>

            </th>
        </tr>
        </thead>
        <tbody id="attachments-list">
        <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index+1); ?></td>
                <td><a href="<?php echo e($att_path); ?>attach/<?php echo e($attachment->file_path); ?>" download><?php echo e($attachment->file_path); ?></a></td>
                <td><?php echo e($attachment->attachmentType ? $attachment->attachmentType->{'attachment_type_'.lang_character()} :''); ?></td>

                <td><?php echo e($attachment->file_desc); ?></td>
                <td>
                    <a href="<?php echo e($att_path); ?>attach/<?php echo e($attachment->file_path); ?>" rel="tooltip" download class="btn btn-sm btn-info btn-round btn-fab"
                       rel="tooltip" data-original-title="" title="Download"
                       data-placement="top" id="">
                        <i class="material-icons">cloud_download</i>
                    </a>
                    <button type="button" data-href="<?php echo e(route('attachments.edit',$attachment->id)); ?>" rel="tooltip" class="btn btn-sm btn-success btn-round btn-fab btnAttachEdit"
                       rel="tooltip" data-original-title="" title="<?php echo e($labels['edit'] ?? 'edit'); ?>"
                       data-placement="top" id="">

                        <i class="material-icons">edit</i>
                    </button>
                    <button type="button" href="<?php echo e(route('attachments.delete',$attachment->id)); ?>" rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnAttachDelete"
                       rel="tooltip" data-original-title="" title="<?php echo e($labels['delete'] ?? 'delete'); ?>"
                       data-placement="top" id="">
                        <i class="material-icons">delete</i>
                    </button>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</div>



