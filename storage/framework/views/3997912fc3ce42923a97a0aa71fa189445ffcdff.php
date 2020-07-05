<table class="table table-bordered table-hover" >
    <thead>
    <tr  align="center">
        <th>#</th>
        <th> <?php echo e($labels['beneficiary_name']??'beneficiary_name'); ?></th>
        <th><?php echo e($labels['idno']??'idno'); ?></th>
        <th><?php echo e($labels['action']??'action'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $actuallyTargetedBeneficiaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$beneficiary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <tr  align="center">
            <td><?php echo e($index+1); ?></td>
            <td><?php echo e($beneficiary->{'ben_name_'.lang_character()}); ?></td>
            <td><?php echo e($beneficiary->ben_idno); ?></td>
            <td  >
                <a   href="<?php echo e(route('project.project.targetedBeneficiaries.actually_beneficiaries.destroy',$beneficiary->id )); ?>"
                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab actually_beneficiaries_destroy"
                        data-placement="top"  title=" <?php echo e($labels['delete'] ?? 'delete'); ?> ">
                    <i class="material-icons">delete</i>
                </a>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
