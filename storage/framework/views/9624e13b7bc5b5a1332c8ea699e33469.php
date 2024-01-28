<?php $__env->startSection('title', 'Category List'); ?>
<?php $__env->startSection('content'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="<?php echo e(route('category#list')); ?>"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Password</h3>
                            </div>
                            <hr>
                            <?php if(session('updateSuccess')): ?>
                                <div class="col-4 offset-8">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <?php echo e(session('updateSuccess')); ?>

                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-3 offset-1 h-100">
                                    <div class="image">
                                        <?php if(Auth::user()->image == null): ?>
                                            <img src="<?php echo e(asset('image/defaultUser.jpg')); ?>" alt=""
                                                class=" shadow-sm">
                                        <?php else: ?>
                                        <img src="<?php echo e(asset('storage/'.Auth::user()->image)); ?>" alt="">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-7 offset-1">
                                    <form action="">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <h4><?php echo e(Auth::user()->name); ?></h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <h4><?php echo e(Auth::user()->email); ?></h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <h4><?php echo e(Auth::user()->address); ?></h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <h4><?php echo e(Auth::user()->phone); ?></h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <h4><?php echo e(Auth::user()->role); ?></h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Joined Date</label>
                                            <h4><?php echo e(Auth::user()->created_at->format('j F Y')); ?></h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Last Updated Date</label>
                                            <h4><?php echo e(Auth::user()->updated_at->format('j F Y')); ?></h4>
                                        </div>
                                        <div class="form-group ">
                                            <a href="<?php echo e(route('admin#edit')); ?>">
                                                <button type="button" class="btn bg-dark text-white text-end"><i
                                                        class="fa-regular fa-pen-to-square me-2"></i> Edit Profile</button>
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PizzaOrderProject\pizza_order_system\resources\views/admin/account/details.blade.php ENDPATH**/ ?>