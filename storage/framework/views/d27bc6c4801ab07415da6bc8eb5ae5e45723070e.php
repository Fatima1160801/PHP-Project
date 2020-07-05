<div class="modal-content ">
    <div class="card card-signup card-plain">
        <div class="modal-header">
            <div class="card-header  text-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>

                <h4 class="card-title">
                    <?php echo e($labels['edit_achievement'] ??'edit_achievement'); ?>

                </h4>
            </div>
        </div>
        <div class="modal-body">
            <?php echo Form::open(['route' => 'project.project.achievement.update' ,'novalidate'=>'novalidate','action'=>'put' ,'id'=>'formEditAchievement' ]); ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php echo $html1; ?>



            <div id="formbyType">
                <?php echo $html2; ?>


            </div>

            <div  id="formbyindicator">
                <?php echo $html3; ?>

            </div>
            <div class="col-md-12">

                <button id="btnStaffEdit" type="submit" class="btn btn-next btn-rose pull-right btn-sm"
                        btn="btnToggleDisabled">
                    <?php echo e($labels['edit'] ?? 'edit'); ?>

                    <div class="loader pull-left" style="display: none;"></div>
                </button>
            </div>


            <?php echo Form::close(); ?>

        </div>
    </div>
</div>






