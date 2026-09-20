@extends('layout.website.app')
@section('title','Register')
@push('css')
<style>
    .account-section .review-form {
        height: auto !important;
    }
</style>
@endpush

@section('body')
<form action="{{ route('register.store') }}" method="post">
@csrf
<section class="login account footer-padding">
    <div class="container">
        <div class="login-section account-section">
            <div class="review-form">

                <h5 class="comment-title">Create Account</h5>

                <div class="account-inner-form">
                    <div class="review-form-name">
                        <label for="name" class="form-label">Name*</label>
                        <input type="text" id="name" class="form-control" name="name" placeholder="Name">
                    </div>
                    @error('name')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="account-inner-form">
                    <div class="review-form-name">
                        <label for="email" class="form-label">Email*</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="user@gmail.com">
                             @error('email')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="review-form-name">
                        <label for="phone" class="form-label">Phone*</label>
                        <input type="number" id="phone" name="phone" class="form-control" placeholder="+201*********">
                             @error('phone')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>

                <div class="review-form-name">
                    @livewire('general.drop-down-country-dependented')
                </div>

                <div class="review-form-name">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                         @error('password')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="review-form-name">
                    <label for="password_confirmation" class="form-label">Password Conifrmation</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                         @error('password_confirmation')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="review-form-name checkbox">
                    <div class="checkbox-item">
                        <input type="checkbox">
                        <p class="remember">
                            I agree all terms and condition in <span class="inner-text">ShopUs.</span>
                        </p>
                    </div>
                </div>

                <div class="login-btn text-center">
                    <button type="submit" class="shop-btn">Create an Account</button>
                    <span class="shop-account">Already have an account ? <a href="{{ route('login') }}">Log In</a></span>
                </div>



            </div>
            </div>
            </div>



</section>
</form>
@endsection

