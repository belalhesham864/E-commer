@extends('layout.dashboard.auth')
@section('title')
Login
@endsection
@section('content')
 <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <img src="{{asset('asset/dashboard')}}/images/logo/logo-dark.png" alt="branding logo">
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>{{ __('auth.login') }}</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <form action="{{ route('dashboard.login.store') }}" method="POST" class="form-horizontal" action="index.html" novalidate>
                      @csrf
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control input-lg" name="email" id="user-name" placeholder="{{__('auth.Your Email') }}"
                        tabindex="1" required data-validation-required-message="{{__('auth.Please enter your Email.') }}">
                           @error('email')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                        <div class="help-block font-small-3"></div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control input-lg" name="password" id="password" placeholder="{{__('auth.Enter Password') }}"
                        tabindex="2" required data-validation-required-message="{{ __('auth.Please enter valid passwords.') }}">
                       
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                        <div class="help-block font-small-3"></div>
                      </fieldset>
                      <div style="display:flex ; justify-content: center;">

                        {!! NoCaptcha::display() !!}
           
                      </div>
                                   @error('g-recaptcha-response')
                        <span class="help-block" style="color: red;display: flex;justify-content: center">
        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
    </span>
                        @enderror
                      <br>
                      <div class="form-group row">
                        <div class="col-md-6 col-12 text-center text-md-left">
                          <fieldset>
                            <input name="remberme" type="checkbox" id="remember-me" class="chk-remember">
                            <label for="remember-me"> {{ __('auth.Remember Me') }}</label>
                          </fieldset>
                        </div>
                        <div class="col-md-6 col-12 text-center text-md-right"><a href="{{ route('dashboard.password.email') }}" class="card-link">{{ __('auth.Forgot Password') }}?</a></div>
                      </div>
                      <button type="submit" class="btn btn-danger btn-block btn-lg"><i class="ft-unlock"></i> {{ __('auth.login') }}</button>
                    </form>
                  </div>
                </div>
          
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
@endsection