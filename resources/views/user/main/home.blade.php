
@extends('user.layouts.master')
@section('content')
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
                            <input type="checkbox" class="-input" checked id="price-all">
                            <label class="mt-2" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal text-dark">{{ $category->count() }}</span>
                        </div>
                        <hr>
                        @foreach ($category as $item)
                            <div class="custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <button class="btn btn-dark btn-block filter_product" value="{{ $item->id }}">
                                    <label class="text-white" for="price-all">{{ $item->name }}</label>
                                </button>
                            </div>
                        @endforeach

                    </form>
                </div>
                <!-- Price End -->
                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                @if ($cart->count() == 0)
                                    <a href="{{ route('user#cartList') }}" class="btn px-0 ml-3 bg-dark p-2 rounded">
                                        <i class="fas fa-shopping-cart text-primary"></i>
                                        <span class="badge text-secondary border border-secondary rounded-circle"
                                            style="padding-bottom: 2px;">{{ $cart->count() }}</span>
                                    </a>
                                @else
                                    <a href="{{ route('user#cartList') }}" class="btn px-0 ml-3 bg-dark p-2 rounded">
                                        <i class="fa-solid fa-cart-shopping fa-beat text-primary"></i>
                                        <span class="badge text-secondary border border-secondary rounded-circle"
                                            style="padding-bottom: 2px;">{{ $cart->count() }}</span>
                                    </a>
                                @endif


                                <a href="{{ route('user#history') }}" class="btn px-0 ml-3 bg-dark p-2 rounded">
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
                    @if (session('updateSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('updateSuccess') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class=" row" id="dataList">
                        @foreach ($product as $item)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden"
                                        style="position: relative; width: 100%; padding-bottom: 100%; overflow: hidden;">
                                        <img style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                                            class="img-fluid w-100" src="{{ asset('storage/' . $item->image) }}"
                                            alt="">
                                        <div class="product-action">
                                            {{-- <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a> --}}
                                            <a class="btn btn-outline-dark btn-square"
                                                href="{{ route('user#productDetail', $item->product_id) }}"><i
                                                    class="fa-solid fa-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">{{ $item->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{ $item->price }} kyats</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('jsSource')
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
                                            class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}"
                                            alt="">
                                        <div class="product-action">
                                            {{-- <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a> --}}
                                            <a class="btn btn-outline-dark btn-square" href="{{ route('user#productDetail', $item->product_id) }}"><i
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
                                            class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}"
                                            alt="">
                                        <div class="product-action">
                                            {{-- <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a> --}}
                                            <a class="btn btn-outline-dark btn-square" href="{{ route('user#productDetail', $item->product_id) }}"><i
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
                                            class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}"
                                            alt="">
                                        <div class="product-action">
                                            {{-- <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a> --}}
                                            <a class="btn btn-outline-dark btn-square" href="{{ route('user#productDetail', $item->product_id) }}"><i
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
@endsection
