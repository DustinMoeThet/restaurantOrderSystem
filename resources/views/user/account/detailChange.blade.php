@extends('user.layouts.master')

@section('content')
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
                            <h3 class="text-center title-2">Account Profile</h3>
                        </div>
                        <hr>
                        <form action="{{ route('user#detailUpdate') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="image col-4">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('image/defaultUser.jpg') }}" alt=""
                                            class=" shadow-sm col-8 offset-2">
                                    @else
                                    <img src="{{asset('storage/'.Auth::user()->image)}}" class="shadow-sm col-8 offset-2" alt="">
                                    @endif
                                    <div class="mt-4">
                                        <label for="myFile">Upload Profile Picture</label>
                                        <input type="file" name="image" id="myFile" class="form-control" accept="image/*">

                                    </div>
                                    <div class=" mt-3">
                                        <input type="submit" value="Update" class="form-control btn btn-secondary">
                                    </div>
                                </div>
                                <div class=" col-6 offset-1">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" value="{{ old('name', Auth::user()->name) }}"
                                            name="name" type="text"
                                            class="form-control @error('name') is-invalid   @enderror"
                                            placeholder="Enter Name">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" value="{{ old('email', Auth::user()->email) }}"
                                            name="email" type="email"
                                            class="form-control @error('email') is-invalid   @enderror"
                                            placeholder="Enter Email">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Address</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid   @enderror" id="" cols="30"
                                            rows="5">{{ old('address', Auth::user()->address) }}
                                    </textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" value="{{ old('phone', Auth::user()->phone) }}"
                                            name="phone" type="number"
                                            class="form-control @error('phone') is-invalid   @enderror"
                                            placeholder="Enter Phone Number">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
