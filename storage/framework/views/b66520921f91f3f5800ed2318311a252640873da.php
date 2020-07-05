<?php $__env->startSection('content'); ?>
    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">person</i>
            </div>
            <h4 class="card-title">My Profile</h4>
        </div>
        <?php echo Form::open(['route' => 'permission.user.updateMyProfile' ,'method' => 'post','enctype'=>'multipart/form-data' ,'id'=>'formAdd']); ?>


        <div class="card-body ">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php echo Form::hidden('id',$user->id ,['id'=>'id']); ?>

            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <?php echo Form::label('user_name', 'User Name ', ['class' => 'col-sm-2 col-form-label']); ?>

                        <div class="col-sm-7">
                            <div class="form-group">
                                <?php echo Form::text('user_name', $user->user_name ,['class'=>'form-control','placeholder'=>'  ' ,'disabled'=>'true']); ?>

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <?php echo Form::label('user_full_name', ' Full Name', ['class' => 'col-sm-2 col-form-label']); ?>

                        <div class="col-sm-7">
                            <div class="form-group">
                                <?php echo Form::text('user_full_name', $user->user_full_name ,['class'=>'form-control','placeholder'=>'  ','disabled'=>'true']); ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php echo Form::label('email', 'email', ['class' => 'col-sm-2 col-form-label']); ?>

                        <div class="col-sm-7">
                            <div class="form-group">
                                <?php echo Form::text('email', $user->email ,['class'=>'form-control','placeholder'=>'  ','disabled'=>'true']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php echo Form::label('job_title', 'Job Title', ['class' => 'col-sm-2 col-form-label']); ?>

                        <div class="col-sm-7">
                            <div class="form-group">
                                <?php echo Form::text('job_title', $user->job_title ,['class'=>'form-control','placeholder'=>'  ','disabled'=>'true']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php echo Form::label('notes', 'Notes', ['class' => 'col-sm-2 col-form-label']); ?>

                        <div class="col-sm-7">
                            <div class="form-group">
                                <?php echo Form::textarea('notes', $user->notes ,['class'=>'form-control','placeholder'=>'  ','disabled'=>'true']); ?>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="col-md-12">
                        <h4 class="title"></h4>
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new thumbnail img-circle">
                                <?php if($user->user_photo): ?>
                                    <img width="100" height="100" src="<?php echo e(asset('images/user/photo/').'/'.$user->user_photo); ?>" alt="...">

                                <?php else: ?>
                                    <img src="<?php echo e(asset('assets/img/placeholder.png')); ?>"/>

                                <?php endif; ?>
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                            <div>
                  
                    
                    
                      
                  
                                <br>
                                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                   data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        
            
        


        <?php echo Form::close(); ?>

    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>