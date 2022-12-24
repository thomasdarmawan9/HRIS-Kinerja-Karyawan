@extends('auth.layouts.app')
@section('content')


        <div class="container-fluid ps-md-0">
      <div class="row g-0">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
        <div class="col-md-8 col-lg-6 login-right">
          <div class="login d-flex align-items-center py-5">
            <div class="container">
              <div class="row">
                <div class="col-md-9 col-lg-8 mx-auto">
                  <center>
                    <h2 class="login-heading mb-4 font-weight-bold">Masuk</h2>
                  </center>

                  <!-- Sign In Form -->
                  <form method="POST" action="{{ route('admin.auth.loginAdmin') }}" >
                  @csrf
                    <div class="form-floating pt-4 pb-4" data-validate="email is required">
                    @if ($errors->has('email'))
                        <span class="is-invalid">{{ $errors->first('email') }}</span>
                    @endif
                      <label for="floatingInput">Email address</label>
                      <br />
                      <input
                        name="email"
                        type="email"
                        class="form-control"
                        id="floatingInput"
                        placeholder="name@example.com"
                        style="height: 8vh"
                        value="{{ old('email') }}"
                      />
                    </div>
                    <div class="form-floating pt-4 pb-4" data-validate="Password is required">
                      <label for="floatingPassword">Password</label>
                      <br />
                      <input
                        name="password"
                        type="password"
                        class="form-control"
                        id="floatingPassword"
                        placeholder="Password"
                        style="height: 8vh"
                      />
                    </div>
                    <br />
                    <div class="d-grid">
                      <button
                        class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2 w-100"
                        type="submit"
                        style="height: 8vh; background: #7b97d5; color: white"
                      >
                      {{ __('Login') }}
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(../assets/login/images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Sign In
					</span>
                </div>

                <form method="POST" action="{{ route('admin.auth.loginAdmin') }}" class="login100-form validate-form">
                    @csrf
                    @if ($errors->has('email'))
                        <span class="is-invalid">{{ $errors->first('email') }}</span>
                    @endif
                    <div class="wrap-input100 validate-input m-b-26" data-validate="email is required">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="text" name="email" placeholder="Enter email"
                               value="{{ old('email') }}">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Enter password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-30">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox"
                                   name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="label-checkbox100" for="ckb1">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <div>
                            @if (Route::has('password.request'))
                                <a class="" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
    <style>
        .is-invalid {
            color: red;
        }
    </style>
@endsection
