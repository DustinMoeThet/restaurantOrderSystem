@extends('user.layouts.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid" style="height: 400px">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
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
                        @foreach ($data as $item)
                            <tr>
                                <td class="align-middle">
                                    <p id="productPrice" class=" d-inline">{{ $item->created_at->format('F-j-Y') }}</p>
                                </td>
                                <td class="align-middle">
                                    <p id="productPrice" class=" d-inline">{{ $item->order_code }}</p>
                                </td>
                                <td class="align-middle">
                                    <p id="productPrice" class=" d-inline">{{ $item->total_price }}</p>
                                </td>
                                <td class="align-middle">
                                    @if ($item->status == 0)
                                        {{ 'Pending' }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class=" mt-3">{{$data->links()}}</p>
            </div>
            {{-- @if ($cartList->count() == 0)
                <div class="alert alert-warning" role="alert">
                    There is no product in cart <i class="fa-regular fa-face-frown"></i>
                </div>
            @endif --}}
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <div>
                                {{-- <h6 class=" d-inline" id="allTotal" all>{{ $totalPrice }}</h6> --}}
                                <h6 class="d-inline"></h6>
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
                            {{-- <h5 id="finalTotal">{{ $totalPrice + 3000 }}</h5> --}}
                        </div>
                        <button id="orderBtn" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To
                            Checkout</button>
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
@endsection
