<?php $__env->startSection('content'); ?>



    <form id="login" class="form-horizontal form" method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo e(csrf_field()); ?>



        <div class="card card-login card-hidden">
            <div class="card-header card-header-rose text-center">
                <h4 class="card-title" style="color: #fff">Login</h4>
            </div>
            <div class="card-body">
                <p class="card-description text-center">

                    <img style="max-width: 80px;max-height: 80px; margin-top: 9px "
                         src="<?php echo e(asset('images/user/photo/'.\App\Models\Setting\Setting::organization_logo())); ?>">
                <p align="center" style="    font-weight: bold;">Project Management System</p>

                
                <span id="user_status_id" class="help-block" disabled="none" style="display: block;text-align: center;">
                        <strong></strong>
                             
                        </span>
                
                </p>

                <span class="bmd-form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">email</i>
                      </span>
                    </div>
                    <input value="<?php echo e(old('email')); ?>" name="email" id="email" type="email" required autofocus
                           class="form-control" placeholder="Email or User Name">
                      
                          <span id="error-email" class="help-block" disabled="none">
                              <strong></strong>
                                
                          </span>
                      
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
                <div class="loader   " style="display: none; "></div>
            </div>
            <div class="card-footer justify-content-center login-submit-class">
                <a href="<?php echo e(route('password.request')); ?>" class="btn btn-rose btn-link btn-lg">
                    Forgot Your Password?
                </a>
            </div>

        </div>
    </form>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <!-- Forms Validations Plugin -->
    <script src="<?php echo e(asset('assets/js/plugins/jquery.validate.min.js')); ?>"></script>
    <script>

        // $(document).on('change','input.valid,input.error', function (e) {
        //     $(this).removeAttr('style')
        // });
        $(document).on('submit', '#login', function (e) {
            e.preventDefault();

            $('#error-email strong').text('');
            $('#user_status_id strong').text('');
            $('#user_status_id').hide()
            $('#error-email').hide();

            if (!is_valid_form($(this))) {
                // $('label.error').remove();
                // $('.error').css('border-bottom','2px solid red')
                return false;
            }

            var data = $(this).serialize();
            var url_ = $(this).attr('action');


            $.ajax({
                url: url_,
                type: 'post',
                data: data,
                cache: false,
                dataType: 'json',
                beforeSend: function () {
                    $('.loader').show();
                },
                success: function (data) {

                    if (data.status == true) {
                        window.location.replace('<?php echo e(route('home')); ?>');
                    } else {
                        console.log(data)
                        $('#user_status_id strong').text(data.user_status_id);
                        $('#user_status_id').show();
                        console.log(data.user_status_id)
                    }
                    $('.loader').hide();
                },
                error: function (errors) {
                    var error = errors.responseJSON.errors.email[0];
                    $('#error-email strong').text(error);
                    $('#error-email').show();
                    $('.loader').hide();

                }
            });

        });

    </script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts._layout_login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>