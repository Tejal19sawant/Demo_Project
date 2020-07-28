@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-8  wrap-login100">
            <div class="card">
                <div class="login100-form-title">{{ __('Admin Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email ID">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input remember_chkbx" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label remember_label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                    @if (Route::has('password.request'))
                                    <label><a class="btn btn-link fogrtpwd-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a></label>
                                     @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0 col-md-12">
                            <div class="col-md-3 offset-md-4">
                                <button type="submit" class="btn btn-primary login_adminbtn">
                                    {{ __('Login') }}
                                </button>

                               
                            </div>
                            <div class="col-md-3 ">
                            <a class="nav-link register_link" href="{{ route('register') }}">{{ __('Register') }}</a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
