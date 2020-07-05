<?php $__env->startSection('content'); ?>





    <div class="col-md-12">


        <?php if(session('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>


        <?php echo Form::open(['route' => 'permission.user.storeChangePassword' ,'action'=>'post' ,'id'=>'formAdd']); ?>

        <div class="card ">
            <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                    <h4 class="card-title">
                        <i class="material-icons">lock</i>

                    </h4>
                </div>
            </div>
            <div class="card-body ">

                <div class="row">
                    <?php echo Form::label('old_password', 'Current Password ', ['class' => 'col-sm-2 col-form-label']); ?>

                    <div class="col-sm-7">
                        <div class="form-group">
                            <?php echo Form::password('old_password',['class'=>'form-control','placeholder'=>'  ','required'=>'true']); ?>

                        </div>
                    </div>
                </div>

                <div class="row">

                    <?php echo Form::label('password', 'Password', ['class' => 'col-sm-2 col-form-label']); ?>

                    <div class="col-sm-7">
                        <div class="form-group">
                            <?php echo Form::password('password',['class'=>'form-control','placeholder'=>'  ' ,'required'=>'true']); ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php echo Form::label('password_confirmation', 'Password Confirmation', ['class' => 'col-sm-2 col-form-label']); ?>


                    <div class="col-sm-7">
                        <div class="form-group">
                            <?php echo Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'  ','required'=>'true']); ?>

                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer ml-auto mr-auto">
                <?php echo Form::submit('Save',['class'=>'btn btn-rose' ,'id'=>'formAddSubmit']); ?>

            </div>

            <?php echo Form::close(); ?>


        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>