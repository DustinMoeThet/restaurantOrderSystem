@extends('user.layouts.master')
@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <a href="{{ route('user#home') }}" class="mb-5"><i
                        class="fa-solid fa-arrow-left text-decoration-none text-dark m-3"> back</i></a>
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/' . $product->image) }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $product->name }}</h3>
                    <div class="d-flex mb-3">
                        {{-- <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div> --}}
                        <small class="pt-1">{{ $product->view_count }} <i class="fa-solid fa-eye"></i></small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $product->price }} Kyat</h3>
                    <p class="mb-4">{{ $product->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1"
                                id="orderCount">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary px-3" id="addCartBtn"><i
                                class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also
                Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    {{-- @foreach ($productList as $item)
                        <input type="hidden" name="" id="userId" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="" id="productId" value="{{ $product->product_id }}">
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <div style="position: relative; width: 100%; padding-bottom: 100%; overflow: hidden;">
                                    <img src="{{ asset('storage/' . $item->image) }}"
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                                        class="img-fluid" alt="Image description">
                                </div>
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $item->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $item->price }} Kyat</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <h6>{{ $item->view_count }}</h6>
                                </div>
                            </div>
                        </div>
                    @endforeach --}}
                        @foreach ($productList as $item)
                        <input type="hidden" name="" id="userId" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="" id="productId" value="{{ $product->product_id }}">
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <div style="position: relative; width: 100%; padding-bottom: 100%; overflow: hidden;">
                                    <img src="{{ asset('storage/' . $item->image) }}"
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                                        class="img-fluid" alt="Image description">
                                </div>
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="{{route('user#productDetail',$item->product_id)}}"><i
                                            class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $item->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $item->price }} Kyat</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('jsSource')
    <script>
        $(document).ready(function() {

            $.ajax({
                type: "get",
                url: "http://localhost:8000/user/ajax/increase/viewCount",
                data: {
                    product_id: $('#productId').val()
                },
                dataType: "json",
                success: function(response) {

                }
            });

            $('#addCartBtn').click(function() {

                $source = {
                    'userId': $('#userId').val(),
                    'productId': $('#productId').val(),
                    'count': $('#orderCount').val()
                }
                $.ajax({
                    type: "get",
                    url: "http://localhost:8000/user/ajax/product/addToCart",
                    data: $source,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        window.location.href = "http://localhost:8000/user/homePage"
                    }
                });

            });
        })
    </script>
@endsection
