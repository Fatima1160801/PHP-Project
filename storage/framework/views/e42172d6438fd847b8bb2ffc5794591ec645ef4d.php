<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        PME :: Project Management Evaluation
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/materialicon.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>"/>
    <!-- CSS Files -->
    <link href="<?php echo e(asset('assets/css/material-dashboard.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('css/stylelogin.css')); ?>" rel="stylesheet"/>

    <?php echo $__env->yieldContent('css'); ?>
    <style>
        .loader {
            border: 2px solid #ff4d89;
            border-top: 2px solid #ffffff;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            animation: spin 2s linear infinite;


        }



        /* Safari */
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes  spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }


        input.form-control{width: 50%;}
        label.error {
            padding: 2px 54px;
            font-size: 13px;
            color: red;
        }
    </style>
</head>

<body class="off-canvas-sidebar">

<div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter" filter-color="black"
         style="background-image:url(<?php echo e(asset('/assets/img/login.jpg')); ?>); background-size: cover; background-position: top center;">
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
        <div class="container">
            <div class="col-lg-4 col-md-6 col-sm-6 ml-auto mr-auto">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="copyright float-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                </div>
            </div>
        </footer>
    </div>
</div>

<!--   Core JS Files   -->
<script src="<?php echo e(asset('assets/js/core/jquery.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/core/popper.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/core/bootstrap-material-design.min.js')); ?>" type="text/javascript"></script>

<!-- Forms Validations Plugin -->
<script src="<?php echo e(asset('assets/js/plugins/jquery.validate.min.js')); ?>"></script>
<!-- Plugin for the Perfect Scrollbar -->
<script src="<?php echo e(asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')); ?>"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?php echo e(asset('assets/js/material-dashboard.min.js')); ?>" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="<?php echo e(asset('assets/demo/demo.js')); ?>"></script>

<script>
    $(document).ready(function () {
        demo.checkFullPageBackgroundImage();
        setTimeout(function () {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700);
    });

    function is_valid_form($form) {
        var attr = $form.attr('no-jquery-validate');
        if (typeof attr === typeof undefined || attr === false) {
            var $valid = $form.valid();
            if (!$valid) {
                // $validator.focusInvalid();
                return false;
            }
        }
        return true;
    }


</script>

<?php echo $__env->yieldContent('js'); ?>
</body>

</html>