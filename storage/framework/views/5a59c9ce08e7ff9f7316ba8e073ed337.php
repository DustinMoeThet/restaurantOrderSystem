<?php $__env->startSection('title', 'Category List'); ?>
<?php $__env->startSection('content'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Customer List</h2>
                            </div>
                        </div>
                    </div>
                    <?php if(session('deleteSuccess')): ?>
                        <div class="col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?php echo e(session('deleteSuccess')); ?>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="text-end row">
                        <div class="col-4 my-3 ml-auto">
                            <form action="<?php echo e(route('admin#userList')); ?>" method="get">
                                <?php echo csrf_field(); ?>
                                <div class="input-group rounded">
                                    <input name="key" value="<?php echo e(request('key')); ?>" type="search"
                                        class="form-control rounded" placeholder="Search" aria-label="Search"
                                        aria-describedby="search-addon" />
                                    <span class="input-group-text border-0" id="search-addon">
                                        <button type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="tr-shadow my-1">
                                        <td class=" col-2">
                                            <?php if(Auth::user()->image == null): ?>
                                                <img src="<?php echo e(asset('image/defaultUser.jpg')); ?>" alt="">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('storage/' . Auth::user()->image)); ?>" alt="">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($item->name); ?></td>
                                        <td><?php echo e($item->email); ?></td>
                                        <td><?php echo e($item->phone); ?></td>
                                        <td>
                                                <div class="table-data-feature mb-3">
                                                    <a href="<?php echo e(route('admin#userChangeRole', $item->id)); ?>">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Change Role to Admin">
                                                            <i class="fa-solid fa-rotate"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class=" mt-3">
                            <?php echo e($user->links()); ?>

                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PizzaOrderProject\pizza_order_system\resources\views/admin/account/userList.blade.php ENDPATH**/ ?>