@extends('user.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        <hr>
                        <form action="{{route('user#changePassword')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" value="" name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid   @enderror @if(session('notMatch')) is-invalid @endif" aria-required="true" aria-invalid="false" placeholder="Old Password">
                                @error('oldPassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                @if(session('notMatch'))
                                <div class="invalid-feedback">
                                    {{session('notMatch')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">New Password</label>
                                <input id="cc-pament" value="" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid   @enderror" aria-required="true" aria-invalid="false" placeholder="New Password">
                                @error('newPassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                <input id="cc-pament" value="" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid   @enderror" aria-required="true" aria-invalid="false" placeholder="Confirm Password">
                                @error('confirmPassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                    <span id="payment-button-amount">Change Password</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
