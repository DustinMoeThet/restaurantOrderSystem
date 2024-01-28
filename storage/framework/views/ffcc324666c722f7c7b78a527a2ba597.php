<?php $__env->startSection('title', 'Category List'); ?>
<?php $__env->startSection('content'); ?>
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="<?php echo e(route('category#createPage')); ?>">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <h3> Total - <?php echo e($categories->total()); ?></h3>
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
                            <form action="<?php echo e(route('category#list')); ?>" method="get">
                                <?php echo csrf_field(); ?>
                                <div class="input-group rounded">
                                    <input name="key" value="<?php echo e(request('key')); ?>" type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                    <span class="input-group-text border-0" id="search-addon">
                                    <button type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    </span>
                                  </div>
                            </form>
                        </div>
                    </div>

                    <?php if(count($categories)!=0): ?>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="tr-shadow my-1">
                                    <td><?php echo e($item->id); ?></td>
                                    <td><?php echo e($item->name); ?></td>
                                    <td><?php echo e($item->created_at->format('j-F-Y')); ?></td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="<?php echo e(route('category#edit',$item->id)); ?>">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>
                                            <a href="<?php echo e(route('category#delete',$item->id)); ?>">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                        <div class=" mt-3">
                            <?php echo e($categories->links()); ?>

                        </div>
                    </div>
                    <?php else: ?>
                    <h3 class="text-secondary text-center mt-5">There is no category here</h3>
                    <?php endif; ?>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PizzaOrderProject\pizza_order_system\resources\views/admin/category/list.blade.php ENDPATH**/ ?>