@extends('layout.website.app')
@section('title', 'Reset Password')
@section('body')
    <form action="{{ route('password.update') }}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <section class="login footer-padding">
            <div class="container">
                <div class="login-section">
                    <div class="review-form">
                        <h5 class="comment-title">Reset Password</h5>
                        <div class="review-inner-form">
                            <div class="review-form-name">
                                <label for="email" class="form-label">Email Address*</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="{{ $email ?? old('email') }}" required />
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="review-form-name">
                                <label for="password" class="form-label">New Password*</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="New Password" required />
                                @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="review-form-name">
                                <label for="password_confirmation" class="form-label">Confirm Password*</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required />
                            </div>
                        </div>
                        <div class="login-btn text-center">
                            <button type="submit" class="shop-btn">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection
