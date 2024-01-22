@extends('admin.layouts.master')
@section('title', 'Category List')
@section('content')
@parent
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Password</h3>
                            </div>
                            <hr>
                            @if (session('updateSuccess'))
                                <div class="col-4 offset-8">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ session('updateSuccess') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-3 offset-1 h-100">
                                    <div class="image">
                                        @if (Auth::user()->image == null)
                                            <img src="{{ asset('image/defaultUser.jpg') }}" alt=""
                                                class=" shadow-sm">
                                        @else
                                        <img src="{{asset('storage/'.Auth::user()->image)}}" alt="">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-7 offset-1">
                                    <form action="">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <h4>{{ Auth::user()->name }}</h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <h4>{{ Auth::user()->email }}</h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <h4>{{ Auth::user()->address }}</h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <h4>{{ Auth::user()->phone }}</h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <h4>{{ Auth::user()->role }}</h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Joined Date</label>
                                            <h4>{{ Auth::user()->created_at->format('j F Y') }}</h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Last Updated Date</label>
                                            <h4>{{ Auth::user()->updated_at->format('j F Y') }}</h4>
                                        </div>
                                        <div class="form-group ">
                                            <a href="{{ route('admin#edit') }}">
                                                <button type="button" class="btn bg-dark text-white text-end"><i
                                                        class="fa-regular fa-pen-to-square me-2"></i> Edit Profile</button>
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
@endsection
