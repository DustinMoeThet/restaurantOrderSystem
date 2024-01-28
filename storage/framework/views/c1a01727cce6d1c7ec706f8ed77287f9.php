<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>





    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title><?php echo $__env->yieldContent('title'); ?></title>

    <!-- Fontfaces CSS-->
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/font-face.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/fontawesome-all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/material-design-iconic-font.min.css')); ?>">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo e(asset('admin/vendor/bootstrap-4.1/bootstrap.min.css')); ?>">


    <!-- Vendor CSS-->
    <link rel="stylesheet" href="<?php echo e(asset('admin/vendor/animsition/animsition.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/vendor/wow/animate.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/vendor/css-hamburgers/hamburgers.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/vendor/slick/slick.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/vendor/select2/select2.min.css')); ?>">


    <link href="<?php echo e(asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet')); ?>" media="all">

    <!-- Main CSS-->
    <link href="<?php echo e(asset('admin/css/theme.css')); ?>" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content mb-5">
                        <div class="login-logo">
                            <a href="#">
                                <img src="admin/images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="<?php echo e(asset('admin/vendor/jquery-3.2.1.min.js')); ?>"></script>
    <!-- Bootstrap JS-->
    <script src="<?php echo e(asset('admin/vendor/bootstrap-4.1/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/bootstrap-4.1/bootstrap.min.js')); ?>"></script>
    <!-- Vendor JS       -->
    <script src="<?php echo e(asset('admin/vendor/slick/slick.min.js')); ?>">
    </script>
    <script src="<?php echo e(asset('admin/vendor/wow/wow.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/animsition/animsition.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')); ?>">
    </script>
    <script src="<?php echo e(asset('admin/vendor/counter-up/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/counter-up/jquery.counterup.min.js')); ?>">
    </script>
    <script src="<?php echo e(asset('admin/vendor/circle-progress/circle-progress.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/chartjs/Chart.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/select2/select2.min.js')); ?>">
    </script>

    <!-- Main JS-->
    <script src="<?php echo e(asset('admin/js/main.js')); ?>"></script>

</body>

</html>
<!-- end document-->
<?php /**PATH C:\xampp\htdocs\PizzaOrderProject\pizza_order_system\resources\views/layout/master.blade.php ENDPATH**/ ?>