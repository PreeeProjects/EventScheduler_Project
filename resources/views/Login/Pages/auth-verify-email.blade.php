@extends('Login.Components.main-layout')
@section('section')


    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="{{ asset('/assets/compiled/svg/logo.svg') }}" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Email Verification Required</h1>
                    <p>
                        Please verify your email address by clicking the link we sent to your email.
                        If you didn’t receive the email, click the button below to resend it.
                    </p>

                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('verification-send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-4">Resend Verification Email</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                </div>
            </div>
        </div>
    </div>


@endsection
