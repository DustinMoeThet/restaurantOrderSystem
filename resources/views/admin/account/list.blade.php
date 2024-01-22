@extends('admin.layouts.master')
@section('title', 'Category List')
@section('content')
@parent
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin List</h2>
                            </div>
                        </div>
                    </div>
                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ session('deleteSuccess') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="text-end row">
                        <div class="col-4 my-3 ml-auto">
                            <form action="{{ route('admin#list') }}" method="get">
                                @csrf
                                <div class="input-group rounded">
                                    <input name="key" value="{{ request('key') }}" type="search"
                                        class="form-control rounded" placeholder="Search" aria-label="Search"
                                        aria-describedby="search-addon" />
                                    <span class="input-group-text border-0" id="search-addon">
                                        <button type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Admin Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $item)
                                    <tr class="tr-shadow my-1">
                                        <td class=" col-2">
                                            @if (Auth::user()->image == null)
                                                <img src="{{ asset('image/defaultUser.jpg') }}" alt="">
                                            @else
                                                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>
                                            @if (Auth::user()->id == 1 && Auth::user()->id != $item->id)
                                                <div class="table-data-feature mb-3">
                                                    <a href="{{ route('admin#changeRole', $item->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Change Role">
                                                            <i class="fa-solid fa-rotate"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('admin#delete', $item->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class=" mt-3">
                            {{ $admin->links() }}
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
