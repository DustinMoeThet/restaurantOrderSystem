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
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add product
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">

                        </div>
                    </div>
                    <div class="text-end row">
                        <div class="col-4 my-3 ml-auto">
                            <form action="{{route('product#list')}}" method="get">
                                @csrf
                                <div class="input-group rounded">
                                    <input name="key" value="{{request('key')}}" type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                    <span class="input-group-text border-0" id="search-addon">
                                    <button type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    </span>
                                  </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <h3> Total - {{$products->total()}}</h3>
                        </div>
                    </div>
                    @if (session('deleteSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{session('deleteSuccess')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                    </div>
                    @endif
                    @if (count($products)!= 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>View Count</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                <tr class="tr-shadow my-1">
                                    <td class="col-2">
                                        <div style="position: relative; width: 100%; padding-bottom: 100%; overflow: hidden;">
                                            <img src="{{ asset('storage/'.$item->image) }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;" class="img-fluid" alt="Image description">
                                        </div>
                                    </td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->category_name}}</td>
                                    <td>{{$item->view_count}}</td>
                                    <td>{{$item->created_at->format('j-F-Y')}}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{route('product#detailPage',$item->product_id)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fa-sharp fa-regular fa-eye"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('product#editPage',$item->product_id)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('product#delete',$item->product_id)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class=" mt-3">
                            {{$products->links()}}
                        </div>
                    </div>
                    @elseif($searchKey && count($products)==0)
                    <h3 class="text-secondary text-center mt-5">There is no matched products</h3>
                    @else
                    <h3 class="text-secondary text-center mt-5">There is no products here</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
