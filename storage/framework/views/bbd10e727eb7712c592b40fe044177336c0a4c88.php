

<?php echo Form::open(['route' => 'tasks_comments.store' ,'action'=>'post'   ,'novalidate'=>'novalidate','id'=>'formAddComment']); ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<div id="taskCommentsModalForm">
    <?php echo $html; ?>

</div>

<div class="col-md-12">
    <div class="card-footer ml-auto mr-auto">
        <div class="ml-auto mr-auto" style="margin-left:13px !important;">
            <button type="submit" class="btn btn-next btn-rose pull-left" style="left: 138px;">
                <div class="loader pull-left" style="display: none;"></div>

                <?php echo e($labels['send_comment']??'send_comment'); ?>


            </button>
        </div>
    </div>
</div>


<?php echo Form::close(); ?>


<ul class="timeline timeline-simple">
    <?php $__currentLoopData = $task_comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $task_comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="timeline-inverted">
            <div class="timeline-badge">
                <img src="<?php echo e(asset('images/user/photo/'.$task_comment->avatar_)); ?>" style="border-radius: 100%" width="53" height="53">
            </div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                    <a href="<?php echo e(route('project.staff.show',$task_comment->staff_id)); ?>"><?php echo e(Auth::user()->lang_id == 1 ? $task_comment->staff_name_na : $task_comment->staff_name_fo); ?></a>
                </div>
                <div class="dropdown pull-right" style="bottom: 40px;">
                    <button type="button" data-href="<?php echo e(route('tasks_comments.edit',$task_comment->id)); ?>"
                            class="btn btn-sm btn-success btn-round btn-fab btnEditTaskComment"  data-toggle="tooltip" data-placement="top"
                            title="  <?php echo e($labels['edit']??'edit'); ?>    ">
                        <i class="material-icons">edit</i>
                    </button>


                    <button type="button" data-href="<?php echo e(route('tasks_comments.delete',$task_comment->id )); ?>"
                            rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnCommentTaskDelete" data-toggle="tooltip"
                            data-placement="top"  title=" <?php echo e($labels['delete']??'delete'); ?>">
                        <i class="material-icons">delete</i>
                    </button>
                </div>
                <div class="timeline-body">
                    <p><?php echo e($task_comment->comment_desc); ?></p>
                </div>
                <h6 class="pull-right">
                    <i class="fa fa-clock-o"></i> <?php echo e(date('d/m/Y H:i A',strtotime($task_comment->comment_date))); ?>

                </h6>

            </div>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</ul>


