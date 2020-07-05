<?php $__env->startSection('content'); ?>



    <form class="form-horizontal form" method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo e(csrf_field()); ?>



        <div class="card card-login card-hidden">
            <div class="card-header card-header-rose text-center">
                <h4 class="card-title" style="color: #fff">Login</h4>
            </div>
            <div class="card-body">
                <p class="card-description text-center">

                    <img style="max-width: 80px;max-height: 80px; margin-top: 9px " src="<?php echo e(asset('images/user/photo/'.\App\Models\Setting\Setting::organization_logo())); ?>">
                <p align="center" style="    font-weight: bold;">Project Management System</p>

                    <?php if($errors->has('user_status_id')): ?>
                        <span class="help-block">
                             <strong><?php echo e($errors->first('user_status_id')); ?></strong>
                        </span>
                    <?php endif; ?>
                </p>

                <span class="bmd-form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">email</i>
                      </span>
                    </div>
                    <input value="<?php echo e(old('email')); ?>" name="email" id="email" type="text" required autofocus
                           class="form-control" placeholder="Email or User Name">
                      <?php if($errors->has('email')): ?>
                          <span class="help-block">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                          </span>
                      <?php endif; ?>
                  </div>
                </span>

                <span class="bmd-form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">lock_outline</i>
                      </span>
                    </div>
                    <input type="password" id="password" name="password" required class="form-control"
                           placeholder="Password...">
                      <?php if($errors->has('password')): ?>
                          <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                      <?php endif; ?>
                  </div>
                </span>

                <span class="bmd-form-group">
                    <div class="form-check">
                        <label class="form-check-label">

                            <input class="form-check-input" type="checkbox"
                                   name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember
                                    Me
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                </span>
            </div>

            <div class="card-footer justify-content-center login-submit-class">
                <button type="submit" class="btn btn-rose btn-link btn-lg">
                    Login
                </button>
            </div>
            <div class="card-footer justify-content-center login-submit-class">
                <a href="<?php echo e(route('password.request')); ?>" class="btn btn-rose btn-link btn-lg">
                    Forgot Your Password?
                </a>
            </div>

        </div>
    </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts._layout_login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>