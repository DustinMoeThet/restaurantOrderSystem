<?php $__env->startSection('content'); ?>
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class=" d-flex align-items-center justify-content-between mb-3">
                            <label class="mt-2 text-center" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal text-dark"><?php echo e($category->count()); ?></span>
                        </div>
                        <hr>
                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <button class="btn btn-dark btn-block filter_product" value="<?php echo e($item->id); ?>">
                                    <label class="text-white" for="price-all"><?php echo e($item->name); ?></label>
                                </button>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <?php if($cart->count() == 0): ?>
                                    <a href="<?php echo e(route('user#cartList')); ?>" class="btn px-0 ml-3 bg-dark p-2 rounded">
                                        <i class="fas fa-shopping-cart text-primary"></i>
                                        <span class="badge text-secondary border border-secondary rounded-circle"
                                            style="padding-bottom: 2px;"><?php echo e($cart->count()); ?></span>
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('user#cartList')); ?>" class="btn px-0 ml-3 bg-dark p-2 rounded">
                                        <i class="fa-solid fa-cart-shopping fa-beat text-primary"></i>
                                        <span class="badge text-secondary border border-secondary rounded-circle"
                                            style="padding-bottom: 2px;"><?php echo e($cart->count()); ?></span>
                                    </a>
                                <?php endif; ?>


                                <a href="<?php echo e(route('user#history')); ?>" class="btn px-0 ml-3 bg-dark p-2 rounded">
                                    <i class="fa-solid fa-clock-rotate-left text-white"></i><span class=" text-white">
                                        History</span>
                                </a>
                            </div>
                            <div class="ml-2">
                                <select name="sorting" id="sortingOption" class=" form-control rounded bg-dark text-white">
                                    <option value="">Choose Option..</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Desscending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php if(session('updateSuccess')): ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?php echo e(session('updateSuccess')); ?>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <div class=" row" id="dataList">
                        <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden"
                                        style="position: relative; width: 100%; padding-bottom: 100%; overflow: hidden;">
                                        <img style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                                            class="img-fluid w-100" src="<?php echo e(asset('storage/' . $item->image)); ?>"
                                            alt="">
                                        <div class="product-action">
                                            
                                            <a class="btn btn-outline-dark btn-square"
                                                href="<?php echo e(route('user#productDetail', $item->product_id)); ?>"><i
                                                    class="fa-solid fa-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href=""><?php echo e($item->name); ?></a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5><?php echo e($item->price); ?> kyats</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsSource'); ?>
    <script>
        $(document).ready(function() {
            /* $.ajax({
                 type: "get",
                 url: "http://localhost:8000/user/ajax/product/list",
                 dataType: "json",
                 success: function (response) {
                     console.log(response);
                 }
             });*/
            $('.filter_product').click(function(event) {
                event.preventDefault();
                $filter = $(this).val();
                console.log($filter);
                $.ajax({
                    type: "get",
                    url: "http://localhost:8000/user/ajax/product/filter/" + $filter,
                    //                                       ^^^^^^^^^^^^^^^^^
                    data: "data",
                    dataType: "json",
                    success: function(response) {
                        $listFilter = '';
                        for ($i = 0; $i < response.length; $i++) {
                            $listFilter += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden"
                                        style="position: relative; width: 100%; padding-bottom: 100%; overflow: hidden;">
                                        <img style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                                            class="img-fluid w-100" src="<?php echo e(asset('storage/${response[$i].image}')); ?>"
                                            alt="">
                                        <div class="product-action">
                                            
                                            <a class="btn btn-outline-dark btn-square" href="<?php echo e(route('user#productDetail', $item->product_id)); ?>"><i
                                                    class="fa-solid fa-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href=""> ${response[$i].name} </a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price} kyats</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        }
                        $('#dataList').html($listFilter);
                    },
                });
            });
            $('#sortingOption').change(function() {
                $eventOption = $('#sortingOption').val();
                if ($eventOption == 'asc') {
                    $.ajax({
                        type: "get",
                        url: "http://localhost:8000/user/ajax/product/list",
                        data: {
                            'status': 'asc'
                        },
                        dataType: "json",
                        success: function(response) {
                            // console.log(response);
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                // console.log(`${response[$i].name}`);
                                $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden"
                                        style="position: relative; width: 100%; padding-bottom: 100%; overflow: hidden;">
                                        <img style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                                            class="img-fluid w-100" src="<?php echo e(asset('storage/${response[$i].image}')); ?>"
                                            alt="">
                                        <div class="product-action">
                                            
                                            <a class="btn btn-outline-dark btn-square" href="<?php echo e(route('user#productDetail', $item->product_id)); ?>"><i
                                                    class="fa-solid fa-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href=""> ${response[$i].name} </a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price} kyats</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            }
                            $('#dataList').html($list);
                        }
                    });
                } else if ($eventOption == 'desc') {
                    $.ajax({
                        type: "get",
                        url: "http://localhost:8000/user/ajax/product/list",
                        data: {
                            'status': 'desc'
                        },
                        dataType: "json",
                        success: function(response) {
                            // console.log(response);
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                console.log(`${response[$i].name}`);
                                $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden"
                                        style="position: relative; width: 100%; padding-bottom: 100%; overflow: hidden;">
                                        <img style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                                            class="img-fluid w-100" src="<?php echo e(asset('storage/${response[$i].image}')); ?>"
                                            alt="">
                                        <div class="product-action">
                                            
                                            <a class="btn btn-outline-dark btn-square" href="<?php echo e(route('user#productDetail', $item->product_id)); ?>"><i
                                                    class="fa-solid fa-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href=""> ${response[$i].name} </a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price} kyats</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            }
                            $('#dataList').html($list);
                        }
                    });
                }
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PizzaOrderProject\pizza_order_system\resources\views/user/main/home.blade.php ENDPATH**/ ?>