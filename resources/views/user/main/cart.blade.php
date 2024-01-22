@extends('user.layouts.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $item)
                            <tr>
                                <td class="align-middle">{{ $item->product_name }}
                                    <input type="hidden" name="productId" class="productId" value="{{ $item->product_id }}">
                                    <input type="hidden" name="userId" class="userId" value="{{ $item->user_id }}">
                                </td>
                                <td class="align-middle">
                                    <p id="productPrice" class=" d-inline">{{ $item->product_price }}</p> Kyat
                                </td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" id="qty"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $item->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <p class="d-inline" id="total">{{ $item->product_price * $item->qty }}</p> Kyat
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('user#cartListDelete', $item->cart_id) }}">
                                        <button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($cartList->count() == 0)
                <div class="alert alert-warning" role="alert">
                    There is no product in cart <i class="fa-regular fa-face-frown"></i>
                </div>
            @endif
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <div>
                                <h6 class=" d-inline" id="allTotal" all>{{ $totalPrice }}</h6>
                                <h6 class="d-inline">Kyat</h6>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 Kyat</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalTotal">{{ $totalPrice + 3000 }}</h5>
                        </div>

                        <button id="orderBtn" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To
                            Checkout
                        </button>
                        <a href="{{route('user#cartDelete')}}" class="text-decoration-none">
                            <button id="clearBtn" class="btn btn-block btn-danger font-weight-bold my-3 py-3">Clear Cart
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('jsSource')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        $(document).ready(function() {
    // Function to check if there are products in the cart
    function hasProductsInCart() {
        // Check if there are any rows in the table
        return $('.table tbody tr').length > 0;
    }

    // Function to disable or enable the order button based on cart content
    function updateOrderButtonState() {
        $('#orderBtn').prop('disabled', !hasProductsInCart());
    }

    // Initial check and update when the page loads
    updateOrderButtonState();

    // Click event for the order button
    $('#orderBtn').click(function() {
        // Check if there are products in the cart
        if (hasProductsInCart()) {
            var orderCode = new Date().getTime();
            orderCode = orderCode.toString().substring(4, 13);

            var orderList = [];

            $('.table tbody tr').each(function() {
                var productId = $(this).find('.productId').val();
                var userId = $(this).find('.userId').val();
                var quantity = parseInt($(this).find('.form-control#qty').val());
                var total = parseFloat($(this).find('.d-inline#total').text());

                var item = {
                    product_id: productId,
                    user_id: userId,
                    qty: quantity,
                    total: total,
                    order_code: orderCode
                };
                orderList.push(item);
            });

            // Convert orderList to query string
            var queryString = $.param({
                orderList: orderList
            });

            // Send the entire orderList array in a single AJAX GET request
            $.ajax({
                type: "get",
                url: "http://localhost:8000/user/ajax/product/order?" + queryString,
                dataType: "json",
                success: function(response) {
                    console.log(response);

                    // Check if the response contains a message indicating success
                    if (response && response.message === 'Order saved successfully') {
                        // Redirect to the home page
                        window.location.href = "{{ route('user#home') }}";
                    } else {
                        // Handle other cases if needed
                        console.log("Order not saved successfully");
                    }
                }
            });
        }
    });

    $('#clearBtn').click(function(){
        console.log('')
    })
});

    </script>
@endsection
