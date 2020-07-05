<!doctype html>
<html lang="en">
<head>
    <title>PME :: Project Management Evaluation</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

<!--     Fonts and icons     -->


<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/materialicon.css')); ?>"/>
<link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>"/>



<!-- Material Dashboard CSS -->

<link rel="stylesheet" href="<?php echo e(asset('assets/css/material-dashboard.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('fonts/fonts.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
<?php echo $__env->yieldContent('css'); ?>
</head>
<body>

              <?php echo $__env->yieldContent('content'); ?>



<?php echo $__env->yieldContent('js'); ?>



<script>












</script>


<?php echo $__env->yieldContent('script'); ?>

</body>
</html>