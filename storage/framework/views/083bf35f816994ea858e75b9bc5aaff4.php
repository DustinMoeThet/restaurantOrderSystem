<?php $__env->startSection('title','Login Page'); ?>
<?php $__env->startSection('content'); ?>
<div class="login-form">
    <?php if(session('passwordChangedSuccessful')): ?>
                    <div class="col-12">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?php echo e(session('passwordChangedSuccessful')); ?>

                          </div>
                    </div>
                    <?php endif; ?>
    <form action="<?php echo e(route('login')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
        </div>

        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

    </form>
    <div class="register-link">
        <p>
            Don't you have account?
            <a href="<?php echo e(route('auth#registerPage')); ?>">Sign Up Here</a>
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PizzaOrderProject\pizza_order_system\resources\views/login.blade.php ENDPATH**/ ?>