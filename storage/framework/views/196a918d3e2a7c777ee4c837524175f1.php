<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title><?php echo $__env->yieldContent('title'); ?></title>

    <!-- Fontfaces CSS-->
    <link href="<?php echo e(asset('admin/css/font-face.css')); ?>" rel="stylesheet" media="all">
    <link href="<?php echo e(asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css')); ?>" rel="stylesheet" media="all">
    <link href="<?php echo e(asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css')); ?>" rel="stylesheet" media="all">
    <link href="<?php echo e(asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css')); ?>" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="<?php echo e(asset('admin/vendor/bootstrap-4.1/bootstrap.min.css')); ?>" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="<?php echo e(asset('admin/vendor/animsition/animsition.min.css')); ?>" rel="stylesheet" media="all">
    <link href="<?php echo e(asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')); ?>" rel="stylesheet"
        media="all">
    <link href="<?php echo e(asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')); ?>" rel="stylesheet"
        media="all">
    <link href="<?php echo e(asset('admin/vendor/css-hamburgers/hamburgers.min.css')); ?>" rel="stylesheet" media="all">
    <link href="<?php echo e(asset('vendor/slick/slick.css')); ?>" rel="stylesheet" media="all">
    <link href="<?php echo e(asset('admin/vendor/select2/select2.min.css')); ?>" rel="stylesheet" media="all">
    <link href="<?php echo e(asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css')); ?>" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?php echo e(asset('admin/css/theme.css')); ?>" rel="stylesheet" media="all">
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="<?php echo e(asset('admin/images/icon/logo.png')); ?>" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="<?php echo e(route('category#list')); ?>">
                                <i class="fas fa-chart-bar"></i>Category</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('product#list')); ?>">
                                <i class="fa-solid fa-pizza-slice"></i></i>Product</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('admin#userList')); ?>">
                                <i class="fas fa-chart-bar"></i>Customers</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('admin#orderList')); ?>">
                                <?php if($hasPendingOrders): ?>
                                <i class="fa-solid fa-bag-shopping"></i>Orders <i class="fa-solid fa-exclamation fa-fade"></i>
                                <?php else: ?>
                                <i class="fa-solid fa-bag-shopping"></i>Orders
                                <?php endif; ?>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <span class="form-header" action="" method="POST">
                                <h4>Admin Dashboard Panel</h4>
                                
                            </span>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <?php if(Auth::user()->image == null): ?>
                                            <img src="<?php echo e(asset('image/defaultUser.jpg')); ?>" alt="">
                                            <?php else: ?>
                                            <img src="<?php echo e(asset('storage/'.Auth::user()->image)); ?>" alt="">
                                            <?php endif; ?>                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo e(Auth::user()->name); ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <?php if(Auth::user()->image == null): ?>
                                                    <img src="<?php echo e(asset('image/defaultUser.jpg')); ?>" alt="">
                                                    <?php else: ?>
                                                    <img src="<?php echo e(asset('storage/'.Auth::user()->image)); ?>" alt="">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo e(Auth::user()->name); ?></a>
                                                    </h5>
                                                    <span class="email"><?php echo e(Auth::user()->email); ?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="<?php echo e(route('admin#details')); ?>">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="<?php echo e(route('admin#list')); ?>">
                                                        <i class="fa-solid fa-people-group"></i>Admin List</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="<?php echo e(route('admin#changePasswordPage')); ?>">
                                                        <i class="fa-solid fa-key"></i>Change Password</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer my-3">
                                                <form action="<?php echo e(route('logout')); ?>" method="post"
                                                    class="d-flex justify-content-center">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn bg-dark text-white col-10">
                                                        <i class="zmdi zmdi-power"></i>Logout
                                                    </button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->


            <?php echo $__env->yieldContent('content'); ?>

            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="<?php echo e(asset('admin/vendor/jquery-3.2.1.min.js')); ?>"></script>
    <!-- Bootstrap JS-->
    <script src="<?php echo e(asset('admin/vendor/bootstrap-4.1/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/bootstrap-4.1/bootstrap.min.js')); ?>"></script>
    <!-- Vendor JS       -->
    <script src="<?php echo e(asset('admin/vendor/slick/slick.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/wow/wow.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/animsition/animsition.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/counter-up/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/counter-up/jquery.counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/circle-progress/circle-progress.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/chartjs/Chart.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/select2/select2.min.js')); ?>"></script>

    <!-- Main JS-->
    <script src="<?php echo e(asset('admin/js/main.js')); ?>"></script>

    
    <script src="https://kit.fontawesome.com/880be0e8e4.js" crossorigin="anonymous"></script>
</body>
<?php echo $__env->yieldContent('jsSource'); ?>
</html>
<!-- end document-->
<?php /**PATH C:\xampp\htdocs\PizzaOrderProject\pizza_order_system\resources\views/admin/layouts/master.blade.php ENDPATH**/ ?>