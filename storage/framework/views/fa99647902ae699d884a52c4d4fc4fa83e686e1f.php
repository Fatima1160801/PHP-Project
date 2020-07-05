<?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><a href="<?php echo e(route('project.project.show',$project->id)); ?>"><?php echo e(Auth::user()->lang_id == 1 ? $project->project_name_na : $project->project_name_fo); ?></a></td>
        <td><a href="<?php echo e(route('project.programs.edit',$project->program->id)); ?>"><?php echo e(Auth::user()->lang_id == 1 ? $project->program->program_name_na : $project->program->program_name_fo); ?></a></td>
        <td>
            <a href="<?php echo e(route('project.staff.edit',$project->manager_id)); ?>">
                <img src="<?php echo e(!empty($project->manager->avatar_) ? asset('images/user/photo/').'/'.$project->manager->avatar_ : asset('assets/img/placeholder.png')); ?>" style="width:40px;height:40px" class="team-staff" data-toggle="tooltip" data-placement="top" title="<?php echo e(Auth::user()->lang_id == 1 ? $project->manager->staff_name_na : $project->manager->staff_name_fo); ?>" data-original-title="Avatar">
            </a>
        </td>
        <td>
            <a href="<?php echo e(route('project.staff.edit',$project->coordinator_id)); ?>">
                <img src="<?php echo e(!empty($project->coordinator->avatar_) ? asset('images/user/photo/').'/'.$project->coordinator->avatar_ : asset('assets/img/placeholder.png')); ?>" style="width:40px;height:40px" class="team-staff" data-toggle="tooltip" data-placement="top" title="<?php echo e(Auth::user()->lang_id == 1 ? $project->coordinator->staff_name_na : $project->coordinator->staff_name_fo); ?>" data-original-title="Avatar">
            </a>
        </td>
        <td><?php echo e(date('d M, Y',strtotime($project->plan_end_date))); ?></td>
        <td><?php echo statusLabel($project->is_hidden); ?></td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>