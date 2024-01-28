<?php $__env->startSection('title', 'Category List'); ?>
<?php $__env->startSection('content'); ?>
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                    <i class=" fa-solid fa-arrow-left text-dark btn-lg" onclick="history.back()"></i>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Product Details</h3>
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
                                            <img src="<?php echo e(asset('storage/'.$product->image)); ?>" alt=""
                                                class=" img-thumbnail shadow-sm">
                                    </div>
                                </div>
                                <div class="col-7 offset-1">
                                    <form action="">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <h4><?php echo e($product->name); ?></h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <h4><?php echo e($product->price); ?></h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <h4><?php echo e($product->category_name); ?></h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">View Count</label>
                                            <h4><?php echo e($product->view_count); ?></h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Created Date</label>
                                            <h4><?php echo e($product->created_at->format('j F Y')); ?></h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Last Updated Date</label>
                                            <h4><?php echo e($product->updated_at->format('j F Y')); ?></h4>
                                        </div>
                                        <div class="form-group">
                                            <div class="card">
                                                <div class=" card-header">
                                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                                </div>
                                                <div class="card-body container">
                                                    <div class="row">
                                                        <div class="col">
                                                          <p class="">
                                                            <?php echo e(substr($product->description,0,200)); ?><span id="longText" class="collapse" style=""><?php echo e(substr($product->description,200)); ?></span>
                                                          </p>
                                                          <button class="btn btn-dark mt-3" type="button" data-toggle="collapse" data-target="#longText" aria-expanded="false" aria-controls="longText" onclick="showFullText()">
                                                            Toggle Full Text
                                                          </button>
                                                        </div>
                                                      </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <a href="<?php echo e(route('product#editPage',$product->product_id)); ?>">
                                                <button type="button" class="btn bg-dark text-white text-end"><i
                                                        class="fa-regular fa-pen-to-square me-2"></i> Edit Product</button>
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PizzaOrderProject\pizza_order_system\resources\views/admin/product/product_detail.blade.php ENDPATH**/ ?>