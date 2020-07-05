<div class="row">


    <a class="btn btn-primary btn-sm" href="<?php echo e(route('project.project.targetedBeneficiaries.create')); ?>"
         data-toggle="modal" data-target="#modalTargetedBeneficiaries"
       data-original-title=""  id="addTargetedBeneficiaries">
        <?php echo e($labels['create_targeted_beneficiaries'] ?? 'create_targeted_beneficiaries'); ?>

    </a>


    <?php if($targetedBeneficiaries != null): ?>

        <table class="table">
            <thead>
            <tr class=" text-primary">
                 <th>
                    <?php echo e($labels['level'] ?? 'level'); ?>

                </th>
                <th>
                    <?php echo e($labels['level_name'] ?? 'level_name'); ?>

                </th>
                <th>
                    <?php echo e($labels['beneficiary_types'] ?? 'beneficiary_types'); ?>

                </th>
                <th>
                    <?php echo e($labels['number_of_beneficiary'] ?? 'number_of_beneficiary'); ?>

                </th>
                <th>
                    <?php echo e($labels['date'] ?? 'date'); ?>

                </th>
                <th>  <?php echo e($labels['actions'] ?? 'action'); ?></th>
            </tr>
            </thead>
            <tbody>


            <?php $__currentLoopData = $targetedBeneficiaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$targetedBeneficiary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                     <td><?php if($targetedBeneficiary->level_type_id == 3): ?> Level III <?php else: ?> Level IV <?php endif; ?> </td>
                    <td><?php echo e($targetedBeneficiary->{'level_name_'.lang_character()}); ?></td>
                    <td><?php echo e($targetedBeneficiary->{'beneficieris_types_name_'.lang_character()}); ?></td>
                    <td><?php echo e($targetedBeneficiary->number_of_beneficiaries); ?></td>
                    <td><?php echo e(dateFormatSite($targetedBeneficiary->date)); ?></td>
                    <td>



                        <a class="btn btn-success btn-sm" href="<?php echo e(route('project.project.targetedBeneficiaries.edit',$targetedBeneficiary->id)); ?>"
                           data-toggle="modal" data-target="#modalTargetedBeneficiaries"
                           data-original-title="" id="editTargetedBeneficiaries">
                            <?php echo e($labels['edit_targeted_beneficiaries'] ?? 'edit_targeted_beneficiaries'); ?>

                        </a>


                        <a href="<?php echo e(route('project.project.targetedBeneficiaries.destroy',$targetedBeneficiary->id )); ?>"
                           id="btnDeleteTargetedBeneficiaries"   class="btn btn-sm btn-danger  "
                           >
                            
                            <?php echo e($labels['delete_targeted_beneficiaries'] ?? 'delete_targeted_beneficiaries'); ?>

                        </a>

                        <a class="btn btn-success btn-sm" href="<?php echo e(route('project.project.targetedBeneficiaries.actually_beneficiaries',$targetedBeneficiary->id)); ?>"
                            data-toggle="modal" data-target="#modalActually_beneficiaries"
                           data-original-title="" id="actually_beneficiaries">
                            <?php echo e($labels['actually_beneficiaries'] ?? 'actually_beneficiaries'); ?>

                        </a>


                    </td>

                </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>


    <?php else: ?>
        <tr align="center">
            <td colspan="4">
                <p>Data Not Found</p>
            </td>
        </tr>
    <?php endif; ?>

</div>


