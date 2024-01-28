<?php $__env->startSection('content'); ?>
    <!-- Cart Start -->
    <div class="container-fluid" style="height: 400px">
        <div class="row px-xl-5">
            <div class=" table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="align-middle">
                                    <p id="productPrice" class=" d-inline"><?php echo e($item->created_at->format('F-j-Y')); ?></p>
                                </td>
                                <td class="align-middle">
                                    <p id="productPrice" class=" d-inline"><?php echo e($item->order_code); ?></p>
                                </td>
                                <td class="align-middle">
                                    <p id="productPrice" class=" d-inline"><?php echo e($item->total_price); ?></p>
                                </td>
                                <td class="align-middle">
                                    <?php if($item->status == 0): ?>
                                        <?php echo e('Pending'); ?>

                                    <?php elseif($item->status == 1): ?>
                                        <?php echo e('Accepted'); ?>

                                    <?php else: ?>
                                        <?php echo e('Rejected'); ?>

                                    <?php endif; ?>


                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <p class=" mt-3"><?php echo e($data->links()); ?></p>
            </div>
            
        </div>
    </div>
    <!-- Cart End -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('jsSource'); ?>
    <script src="<?php echo e(asset('js/cart.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $('#orderBtn').click(function() {
                var orderCode = new Date().getTime();
                // $orderList = [];
                $('.table tbody tr').each(function() {
                    // Get the values from each cell in the row
                    var productId = $(this).find('.productId').val();
                    var userId = $(this).find('.userId').val();
                    var quantity = parseInt($(this).find('.form-control#qty').val());
                    var total = parseFloat($(this).find('.d-inline#total').text());

                    // Create an object with the extracted values
                    $orderList = {
                        product_id: productId,
                        user_id: userId,
                        qty: quantity,
                        total: total,
                        order_code: orderCode
                    };
                    console.log(typeof($orderList));
                    $.ajax({
                        type: "get",
                        url: "http://localhost:8000/user/ajax/product/order",
                        data: $orderList,
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                        }
                    });
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PizzaOrderProject\pizza_order_system\resources\views/user/main/history.blade.php ENDPATH**/ ?>