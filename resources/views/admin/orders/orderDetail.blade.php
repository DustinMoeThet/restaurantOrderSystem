@extends('admin.layouts.master')
@section('title', 'Category List')
@section('content')
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
                            {{-- <h3> Total - {{ $products->total() }}</h3> --}}
                        </div>
                    </div>
                    {{-- @if (count($products) != 0) --}}
                    <!-- NEW CARD SECTION -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <h4 class="card-title">Order Actions</h4>
                            <p class="card-text mb-3">Total Amount: {{ $total }}</p>
                            <form action="{{route('order#acceptDeny',$order->first()->order_code)}}" method="post">
                                @csrf
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
                                @foreach ($order as $item)
                                    <tr class="tr-shadow my-1">
                                        <td class=" text-center">{{ $item->name }}</td>
                                        <td class=" text-center">{{ $item->qty }}</td>
                                        <td class=" text-center">{{ $item->created_at->format('j-F-Y') }}</td>
                                        <td class=" text-center">{{ $item->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- @elseif($searchKey && count($products) == 0) --}}
                    {{-- <h3 class="text-secondary text-center mt-5">There is no matched products</h3> --}}
                    {{-- @else
                        <h3 class="text-secondary text-center mt-5">There is no products here</h3>
                    @endif --}}
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
