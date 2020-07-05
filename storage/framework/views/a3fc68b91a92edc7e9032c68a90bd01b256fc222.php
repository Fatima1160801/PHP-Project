
            <table class="table" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>
                        <?php echo e($labels['staff_name'] ?? 'staff_name'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['start_date'] ?? 'start_date'); ?>

                    </th>
                    <th>
                        <?php echo e($labels['end_date'] ?? 'end_date'); ?>

                    </th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $focalPoint; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$focal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index+1); ?></td>
                        <td><?php echo e($focal->getNameStaff($focal->staff_id)); ?></td>
                        <td><?php echo e(dateFormatSite($focal->start_date)); ?></td>
                        <td><?php echo e(dateFormatSite($focal->end_date)); ?></td>
                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>


