@extends('layout.website.app')
@section('title', 'Forget Password')
@section('body')
    <form action="{{ route('password.email') }}" method="post">
        @csrf
        <section class="login footer-padding">
            <div class="container">
                <div class="login-section">
                    <div class="review-form">
                        <h5 class="comment-title">Forget Password</h5>
                        @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
                        <div class="review-inner-form">
                            <div class="review-form-name">
                                <label for="email" class="form-label">Email Address*</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required />
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="login-btn text-center">
                            <button type="submit" class="shop-btn">Send Reset Link</button>
                            <span class="shop-account">Remembered your password? <a href="{{ route('login') }}">Log In</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection
