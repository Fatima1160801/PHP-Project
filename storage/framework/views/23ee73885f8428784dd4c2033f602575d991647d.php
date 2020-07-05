<a href="<?php echo e(route('project.donors.contact.create')); ?>" rel="tooltip" class="btn btn-sm btn-primary btn-round btn-fab"
   data-toggle="modal" data-target="#modalDonorContact"
   rel="tooltip" data-original-title="" title="
<?php echo e($labels['add']??'add'); ?>"
   data-placement="top" id="addDonorContact">
    <i class="material-icons">add</i>
</a>

<?php if($donors != null): ?>
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>
            <?php echo e($labels['name_english']??'name_english'); ?>

        </th>
        <th>
            <?php echo e($labels['name_arabic']??'name_arabic'); ?>

        </th>
        <th>
            <?php echo e($labels['contacts_mobile']??'contacts_mobile'); ?>

        </th>
        <th>
         <?php echo e($labels['contact_job_title']??'contact_job_title'); ?>

        </th>
        <th>
            <?php echo e($labels['actions']??'actions'); ?>

        </th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $donors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$donor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($index+1); ?></td>
            <td><?php echo e($donor->contact_person_na); ?></td>
            <td><?php echo e($donor->contact_person_fo); ?></td>
            <td><?php echo e($donor->contact_mobile); ?></td>
            <td><?php echo e($donor->contact_job_title); ?></td>
            <td>
                <a href="<?php echo e(route('project.donors.contact.edit',$donor->id)); ?>"
                   rel="tooltip" class="btn btn-sm btn-success btn-round btn-fab"
                   data-toggle="modal" data-target="#modalDonorContactEdit"
                   rel="tooltip" data-original-title="" title="<?php echo e($labels['edit']??'edit'); ?>"
                   data-placement="top" id="EditDonorContact">
                    <i class="material-icons">edit</i>
                </a>


                <a href="<?php echo e(route('project.donors.contact.delete',$donor->id)); ?>" class="btn btn-danger btn-round btn-fab btn-sm" id="btnDeleteContact"
                data-tooltip="tooltip" data-placement="right" title="<?php echo e($labels['delete']??'delete'); ?>">
                <i class="material-icons">delete</i>
                </a>
            </td>
        </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php endif; ?>



