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
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">

                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-5">
                            
                        </div>
                    </div>
                    
                    <!-- NEW CARD SECTION -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <h4 class="card-title">Order Actions</h4>
                            <p class="card-text mb-3">Total Amount: <?php echo e($total); ?></p>
                            <form action="<?php echo e(route('order#acceptDeny',$order->first()->order_code)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <button value="accept" name="desicion" class="btn btn-success me-3">Accept</button>
                                <button value="reject" name="desicion" class="btn btn-danger">Reject</button>
                            </form>
                        </div>
                    </div>
                    <!-- END NEW CARD SECTION -->
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center"> Ordered Date</th>
                                    <th class="text-center">Total</th>
                                </tr>



                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="tr-shadow my-1">
                                        <td class=" text-center"><?php echo e($item->name); ?></td>
                                        <td class=" text-center"><?php echo e($item->qty); ?></td>
                                        <td class=" text-center"><?php echo e($item->created_at->format('j-F-Y')); ?></td>
                                        <td class=" text-center"><?php echo e($item->total); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    
                    
                    
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PizzaOrderProject\pizza_order_system\resources\views/admin/orders/orderDetail.blade.php ENDPATH**/ ?>