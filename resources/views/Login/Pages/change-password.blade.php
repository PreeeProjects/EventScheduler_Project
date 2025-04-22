@extends('Login.Components.main-layout')
@section('section')

    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="./assets/compiled/svg/logo.svg" alt="Logo"></a>
                    </div>
                    <h1 class=" ">Set New Password</h1>
                    <p class="auth-subtitle mb-5">Set your new password</p>

                    <form action="{{ route('change-password') }}" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="New Password"
                                name="new_password">
                            <div class="form-control-icon">
                                <i class="bi bi-lock"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Confirm Password"
                                name="confirm_password">
                            <div class="form-control-icon">
                                <i class="bi bi-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg" type="submit">Update</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Remember your account? <a href="{{ url('/') }}" class="font-bold">Log
                                in</a>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                </div>
            </div>
        </div>
    </div>

@endsection
