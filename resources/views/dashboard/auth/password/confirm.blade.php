@extends('layout.dashboard.auth')
@section('title')
{{ __('auth.confirm otp') }}
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
              <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                <div class="card-header border-0 pb-0">
                  <div class="card-title text-center">
                    <img src="{{ asset('asset/dashboard') }}/images/logo/logo-dark.png" alt="branding logo">
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>{{ __('auth.codeSend') }}.</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <form action="{{ route('dashboard.password.verify-otp') }}" method="post" class="form-horizontal"  novalidate>
                        @csrf
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="text"  name="code" class="form-control form-control-lg input-lg" id="user-code"
                        placeholder="{{ __('passwords.code') }}" required>
                        @error('code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-control-position">
                          <i class="ft-mail"></i>
                        </div>
                      </fieldset>
                      <button type="submit" class="btn btn-outline-info btn-lg btn-block"><i class="ft-unlock"></i> {{ __('passwords.send') }}</button>
                      <br>
                      <div style="display: flex ; justify-content: space-around;">

                        <a href="{{ route('dashboard.password.email.sendotpAgain',$email) }}">{{ __('auth.Send Otp Again') }}</a>
                        <a href="{{route('dashboard.login') }}">{{ __('auth.back') }}⬅</a>
                      </div>
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