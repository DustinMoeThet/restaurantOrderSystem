@extends('admin.layouts.master')
@section('title', 'Category List')
@section('content')
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
                                <h3 class="text-center title-2">Product Edit</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#update',$product->product_id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="image col-4">

                                        <img src="{{asset('storage/'.$product->image)}}" alt="">
                                        <div class="mt-4">
                                            <label for="myFile">Upload Product Image</label>
                                            <input type="file" name="image" id="myFile" class="form-control" accept="image/*">
                                        </div>
                                        <div class=" mt-3">
                                            <input type="submit" value="Update" class="form-control btn btn-secondary">
                                        </div>
                                    </div>
                                    <div class=" col-6 offset-1">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" value="{{ old('name', $product->name) }}"
                                                name="productName" type="text"
                                                class="form-control @error('productName') is-invalid   @enderror"
                                                placeholder="Enter Name">
                                            @error('productName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="category" class="control-label mb-1">Category</label>
                                            <select name="productCategory" id="category" class="form-control @error('productCategory') is-invalid @enderror">
                                                @foreach ($categories as $item)
                                                <option value="{{$item->id}}"@if ($item->id == $product->category_id)selected @endif>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('productCategory')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" value="{{ old('price', $product->price) }}"
                                                name="price" type="number"
                                                class="form-control @error('price') is-invalid   @enderror"
                                                placeholder="Enter Name">
                                            @error('price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="productDescription" class="form-control @error('productDescription') is-invalid   @enderror" id="" cols="30"
                                                rows="5">{{ old('address', $product->description) }}
                                        </textarea>
                                            @error('productDescription')
                                                <div class="invalid-feedback">
                                                    {{$message}}
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
    <!-- END MAIN CONTENT-->
@endsection
