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
                    <div class="d-flex mb-3">
                        <label for="" class=" mt-2 me-4">Order Status</label>
                        <select name="" id="orderStatus" class=" form-control col-2">
                            <option value="">All</option>
                            <option value="0">Pending</option>
                            <option value="1">Accepted</option>
                            <option value="2">Rejected</option>
                        </select>
                    </div>
                    {{-- @if (count($products) != 0) --}}
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th class=""> User Id</th>
                                    <th class=""> User Name</th>
                                    <th class=""> Order ID</th>
                                    <th class=""> Total</th>
                                    <th class=""> Status</th>
                                    <th class=""> Created Date</th>
                                    <th></th>
                                </tr>



                            </thead>
                            <tbody>
                                @foreach ($order as $item)
                                    <tr class="tr-shadow my-1">
                                        <td class=" text-center">{{ $item->user_id }}</td>
                                        <td class=" text-center">{{ $item->user_name }}</td>
                                        <td class=" text-center">{{ $item->order_code }}</td>
                                        <td class=" text-center">{{ $item->total_price }}</td>
                                        <td class=" text-center">
                                            @if ($item->status == 0)
                                                {{ 'Pending' }}
                                            @elseif ($item->status == 1)
                                                {{ 'Accepted' }}
                                            @else
                                                {{ 'Rejected' }}
                                            @endif
                                        </td>
                                        <td class=" text-center">{{ $item->created_at->format('j-F-Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin#orderDetail', $item->order_code) }}">
                                                <button class="btn btn-warning"><i class="fa-solid fa-circle-info"></i>
                                                    Details</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class=" mt-3">
                            {{ $order->links() }}
                        </div>
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
@section('jsSource')
    <!-- Add this script at the end of your Blade view -->
    <script>
        $(document).ready(function() {
            $('#orderStatus').change(function() {
                var status = $(this).val();

                // Make AJAX request to filter orders based on the selected status
                // Make AJAX request to filter orders based on the selected status
                $.ajax({
                    url: 'http://localhost:8000/order/filter', // Update this route to match your actual route
                    type: 'GET',
                    data: {
                        status: status
                    },
                    success: function(data) {
                        // Clear existing table rows
                        $('tbody').html('');
                        $row='';
                        // Append new rows with filtered orders
                        data.orders.forEach(function(order) {
                            var statusLabel = getStatusLabel(order
                                .status); // Function to get the status label
                            var formattedDate = getFormattedDate(order
                                .created_at); // Function to format the date
                             $row = `
                <tr class="tr-shadow my-1">
                    <td class="text-center">${order.user_id}</td>
                    <td class="text-center">${order.user_name}</td>
                    <td class="text-center">${order.order_code}</td>
                    <td class="text-center">${order.total_price}</td>
                    <td class="text-center">${statusLabel}</td>
                    <td class="text-center">${formattedDate}</td>
                    <td>
                        <a href="{{ url('http://localhost:8000/order/detail/${order.order_code}') }}">
                            <button class="btn btn-warning"><i class="fa-solid fa-circle-info"></i> Details</button>
                        </a>
                    </td>
                </tr>`;

                            $('tbody').append($row);
                        });
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });

            });

            // Function to update the table with filtered orders
            function updateTable(orders) {
                // Clear existing table rows
                $('tbody').html('');

                // Append new rows with filtered orders
                orders.forEach(function(order) {
                    var statusLabel = getStatusLabel(order.status); // Function to get the status label
                    var formattedDate = getFormattedDate(order.created_at); // Function to format the date
                    $row = '';
                    $row += `<tr class="tr-shadow my-1">
            <td class="text-center">${order.user_id}</td>
            <td class="text-center">${order.user_name}</td>
            <td class="text-center">${order.order_code}</td>
            <td class="text-center">${order.total_price}</td>
            <td class="text-center">${statusLabel}</td>
            <td class="text-center">${formattedDate}</td>
        </tr>`;
                    $('tbody').append($row);
                });
            }

            // Function to get the status label
            function getStatusLabel(status) {
                switch (status) {
                    case 0:
                        return 'Pending';
                    case 1:
                        return 'Accepted';
                    case 2:
                        return 'Rejected';
                    default:
                        return 'Unknown';
                }
            }

            // Function to format the date
            function getFormattedDate(dateString) {
                var options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                var formattedDate = new Date(dateString).toLocaleDateString('en-US', options);
                return formattedDate;
            }
        });
    </script>

@endsection
