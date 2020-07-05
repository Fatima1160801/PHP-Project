<?php $__env->startSection('content'); ?>

    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">person_add
                </i>
            </div>
            <h4 class="card-title">add user</h4>

        </div>

        <?php echo Form::open(['route' => 'permission.user.store' ,'action'=>'post' ,'id'=>'formAdd']); ?>

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

            <div class="row">
                <?php echo Form::label('user_name', 'User Name ', ['class' => 'col-sm-2 col-form-label']); ?>

                <div class="col-sm-7">
                    <div class="form-group">
                        <?php echo Form::text('user_name', '' ,['class'=>'form-control','placeholder'=>' ','required'=>'true']); ?>

                    </div>
                </div>
            </div>


            <div class="row">
                <?php echo Form::label('user_full_name', '  Full User Name', ['class' => 'col-sm-2 col-form-label']); ?>

                <div class="col-sm-7">
                    <div class="form-group">
                        <?php echo Form::text('user_full_name', '' ,['class'=>'form-control','placeholder'=>'  ','required'=>'true']); ?>

                    </div>
                </div>
            </div>


            <div class="row">
                <?php echo Form::label('job_title', 'Job Title', ['class' => 'col-sm-2 col-form-label']); ?>

                <div class="col-sm-7">
                    <div class="form-group">
                        <?php echo Form::text('job_title', '' ,['class'=>'form-control','placeholder'=>'  ','required'=>'true']); ?>

                    </div>
                </div>
            </div>


            <div class="row">
                <?php echo Form::label('email', 'Email', ['class' => 'col-sm-2 col-form-label']); ?>

                <div class="col-sm-7">
                    <div class="form-group">
                        <?php echo Form::email('email', '' ,['class'=>'form-control noArabic','placeholder'=>'  ','required'=>'true','email'=>'true']); ?>

                    </div>
                </div>
            </div>

                <div class="row">
                    <label for="staff_id" class="col-md-2 col-form-label">User Type</label>
                    <div class="col-md-7">
                        <div class='form-group has-default bmd-form-group'>
                            <select class='form-control  selectpicker' name='user_type' data-style='btn btn-link'
                                    id='user_type'>
                                <option style='height: 37px;' value></option>
                                <option style='height: 37px;' value="1">Admin</option>
                                <option style='height: 37px;' value="2">Project Manager or Coordinator</option>
                                <option style='height: 37px;' value="3">Casual User</option>
                            </select>
                        </div>
                    </div>
                </div>

            <div class="row">
                <label for="staff_id" class="col-md-2 col-form-label">Staff Name</label>
                <div class="col-md-7">
                    <div class='form-group has-default bmd-form-group'>
                        <select class='form-control  selectpicker' data-live-search="true" name='staff_id' data-style='btn btn-link'
                                id='staff_id'>
                            <option style='height: 37px;' value></option>
                            <?php if($staff): ?>
                                <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value='<?php echo e($key); ?>'><?php echo e($value); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>

        <div class="row">
            <?php echo Form::label('password', 'Password', ['class' => 'col-sm-2 col-form-label']); ?>

            <div class="col-sm-7">
                <div class="form-group">
                    <?php echo Form::password('password',['class'=>'form-control','placeholder'=>'  ','required'=>'true']); ?>

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


        <div class="row">
            <?php echo Form::label('notes', 'Notes', ['class' => 'col-sm-2 col-form-label']); ?>

            <div class="col-sm-7">
                <div class="form-group">
                    <?php echo Form::textarea('notes', '' ,['class'=>'form-control','placeholder'=>'  ']); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="ml-auto mr-auto">
            <a class="btn btn-default  " href="<?php echo e(route('permission.user.index')); ?>">Back</a>
            <?php echo Form::submit('Save',['class'=>'btn btn-next   btn-rose' ,'id'=>'formAddSubmit']); ?>

        </div>

    </div>


    <?php echo Form::close(); ?>

    </div>




<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

    <script>


        $(document).ready(function () {
            active_nev_link('user');

            funValidateForm();
            $('.selectpicker').selectpicker();

        });

        $(document).on('submit', '#formAdd', function (e) {
            if (!is_valid_form($(this))) {
                return false
            }
        })

    </script>
    

    


    
    
    
    
    
    
    
    
    
    
    

    
    

    
    
    

    


    

    
    

    
    


    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    

    
    
    
    


    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <!-- Forms Validations Plugin -->
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-selectpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/jquery.validate.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts._layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>