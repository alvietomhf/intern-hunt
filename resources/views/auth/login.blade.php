@extends('layouts.auth')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="row flexbox-container">
                <div class="col-xl-8 col-11 d-flex justify-content-center">
                    <div class="card bg-authentication rounded-0 mb-0">
                        <div class="row m-0">
                            <div class="col-lg-6 col-12 p-0">
                                <div class="card rounded-0 mb-0 px-2">
                                    <div class="card-header pb-1">
                                        <div class="card-title">
                                            <h4 class="mb-0">Login</h4>
                                        </div>
                                    </div>
                                    <p class="px-2">Selamat datang kembali, silahkan login ke akun anda.</p>
                                    <div class="card-content">
                                        <div class="card-body pt-1">
                                            <form action="{{ route('login') }}" method="POST">
                                                @csrf
                                                <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                    <input
                                                    oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                                    oninput="this.setCustomValidity('')"
                                                    type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                    @error('username')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <label for="username">Username</label>
                                                </fieldset>

                                                <fieldset class="form-label-group position-relative has-icon-left">
                                                    <input
                                                    oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                                    oninput="this.setCustomValidity('')"
                                                    type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required autocomplete="current-password">
                                                    <div class="form-control-position">
                                                        <i class="feather icon-lock"></i>
                                                    </div>
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <label for="password">Password</label>
                                                </fieldset>
                                                <div class="form-group d-flex justify-content-end align-items-center">
                                                    <div class="text-left"><a href="{{ route('password.request') }}" class="card-link">Forgot Password?</a></div>
                                                </div>
                                                <a href="{{ route('register') }}" class="btn btn-outline-primary float-left btn-inline mb-50">Sign Up</a>
                                                <button type="submit" class="btn btn-primary float-right btn-inline">Login</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="login-footer">
                                        <div class="divider">
                                            <div class="divider-text">Copyright &copy; 2021</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                <img src="{{ asset('assets/images/pages/login.png') }}" alt="branding logo">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
@endsection
