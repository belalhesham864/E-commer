@extends('layout.website.app')
@section('title', 'Login')
@section('body')
    <form action="{{ route('login.store') }}" method="post">
        @csrf
        <section class="login footer-padding">
            <div class="container">
                <div class="login-section">
                    <div class="review-form">
                        <h5 class="comment-title">Log In</h5>
                        <div class="review-inner-form">
                            <div class="review-form-name">
                                <label for="email" class="form-label">Email Address**</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
                                @error('email')
                      <div class="text-danger">{{ $message }}</div>

                                @enderror
                            </div>
                            <div class="review-form-name">
                                <label for="password" class="form-label">Password*</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="password" />
                                @error('password')
                      <div class="text-danger">{{ $message }}</div>

                                @enderror
                            </div>
                            <div class="review-form-name checkbox">
                                <div class="checkbox-item">
                                    <input type="checkbox" name="remember" />
                                    <span class="address"> Remember Me</span>
                                </div>
                                <div class="forget-pass">
                                    <a href="{{ route('password.forget') }}">

                                        <p>Forgot password?</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="login-btn text-center">
                            <button type="submit" class="shop-btn">Log In</button>
                            <span class="shop-account">Dont't have an account ?<a href="{{ route('register') }}">Sign Up
                                    Free</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection
