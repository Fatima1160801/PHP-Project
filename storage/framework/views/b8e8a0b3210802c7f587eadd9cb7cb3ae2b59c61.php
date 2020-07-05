<h4>
    <?php echo e($labels['lessons_index'] ?? 'lessons_index'); ?>

</h4>



<a href="#" rel="tooltip" class="btn btn-sm btn-primary btn-round btn-fab" data-toggle="modal" data-target="#modalLessons"
   data-original-titaddlocationle="" title="<?php echo e($labels['lessons_add'] ?? 'lessons_add'); ?>" data-placement="top" id="AddLessons">
    <i class="material-icons">add</i>
</a>

<table class="table">
    <thead>
    <tr>
        <th>
            <?php echo e($labels['lessons_type_id'] ?? 'lessons_type_id'); ?>

        </th>
        <th>
            <?php echo e($labels['related_to_id'] ?? 'related_to_id'); ?>

        </th>
        <th>
            <?php echo e($labels['description'] ?? 'description'); ?>

        </th>
        <th>
            <?php echo e($labels['recommendation'] ?? 'recommendation'); ?>

        </th>
        <th>
            <?php echo e($labels['actions']??'actions'); ?>

        </th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($lesson->type ? $lesson->type->{'activity_lessons_type_name_'.lang_character()} : ''); ?></td>
            <td><?php echo e($lesson->related ? $lesson->related->{'activity_lessons_related_name_'.lang_character()} : ''); ?></td>
            <td><?php echo e($lesson->description); ?></td>
            <td><?php echo e($lesson->recommendation); ?></td>
            <td>


                <a href="<?php echo e(route('activity.lessons.edit',$lesson->id)); ?>" rel="tooltip"
                   class="btn btn-sm btn-primary btn-round btn-fab" data-toggle="modal" data-target="#modalLessons"
                   data-original-titaddlocationle="" title="<?php echo e($labels['edit']??'edit'); ?>" data-placement="top" id="btnEditActivityLessons">
                    <i class="material-icons">edit</i>
                </a>


                <a  href="<?php echo e(route('activity.lessons.delete',$lesson->id)); ?>" rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab" data-toggle="tooltip"
                            data-placement="top" title="<?php echo e($labels['remove']??'remove'); ?>" id="btnDeleteActivityLessons">
                        <i class="material-icons">delete</i>
                </a>
            </td>
        </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<div class="col-md-12">

    <a href="#" class="btn btn-previous btn-default btn-sm pull-left" id="previous-staff-tab">
        <?php echo e($labels['previous']??'previous'); ?>

    </a>


    <a href="#" class="btn btn-next btn-default  btn-sm pull-right " id="next-attachments-tab">
        <?php echo e($labels['next']??'next'); ?>

    </a>

</div>


