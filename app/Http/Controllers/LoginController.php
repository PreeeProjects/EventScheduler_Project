<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Mail\MailNotification;
use App\Mail\CustomVerifyEmail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use App\Models\User;


class LoginController extends Controller
{
    public function Logout()
    {
        session()->flush();
        return redirect()->to('/');
    }
    public function RegisterValidation(Request $request)
    {
        $first_name = $request->first_name;
        $middle_name = $request->middle_name;
        $last_name = $request->last_name;
        $full_name = "{$last_name}, {$first_name} {$middle_name}";
        $email = $request->email;
        $username = $request->username;
        $password = $request->password;
        $confirm_password = $request->confirm_password;

        $check_email = User::where('email', $email)->exists();

        if (!$check_email) {
            if ($password === $confirm_password) {
                $user = User::create([
                    'first_name' => $first_name,
                    'middle_name' => $middle_name,
                    'last_name' => $last_name,
                    'full_name' => $full_name,
                    'username' => $username,
                    'email' => $email,
                    'password' => Hash::make($request->password),
                ]);

                // Mail::to($email)->send(new MailNotification(
                //     'Account Approval Request',
                //     'Login.Emails.registered-account-email',
                //     ['name' => $first_name]
                // ));
                Auth::login($user);

                $verificationUrl = URL::temporarySignedRoute(
                    'verification-verify',
                    Carbon::now()->addMinutes(60),
                    ['id' => $user->id, 'hash' => sha1($user->email)]
                );

                Mail::to($user->email)->send(new CustomVerifyEmail($user, $verificationUrl));

                return redirect()->route('verification-notice');
            }
            return view('Login.Pages.register-page');
        }
        echo "Email Already Exists";
        return view('Login.Pages.register-page');
    }

    public function LoginValidation(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $check_user = User::where('email', $email)->first();

        if ($check_user && $check_user->status == '1' && Hash::check($password, $check_user->password)) {
            Session::put([
                'first_name' => $check_user->first_name,
                'full_name' => $check_user->full_name,
                'username' => $check_user->username,
            ]);
            return redirect()->to('dashboard');
        }
        echo 'not okay';
        return redirect()->to('/');
    }

    public function EmailValidation(Request $request)
    {
        $email = $request->email;
        $check_user = User::where('email', $email)->first();

        if ($check_user) {
            if ($check_user->status == '1') {
                $code = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);

                Session::put([
                    'code' => $code,
                    'email' => $check_user->email,

                ]);

                Mail::to($email)->send(new MailNotification(
                    'OTP Authentication',
                    'Login.Emails.otp-authentication',
                    ['name' => $check_user->first_name, 'code' => $code]
                ));
                return view('login.pages.otp-authentication-page');
            } else {
                echo 'Your account is not yet approved.';
                return;
            }
        }
        echo 'no user found';
    }

    public function OTPVerification(Request $request)
    {
        $otp = $request->otp;
        $otp_code = session()->get('code');

        if ($otp === $otp_code) {
            return view('Login.Pages.change-password');
        }
        echo 'OTP Code Invalid';

    }

    public function ChangePasswordValidation(Request $request)
    {
        $new_pass = $request->new_password;
        $confirm_pass = $request->confirm_password;
        $email = session()->get('email');
        if ($new_pass === $confirm_pass) {
            User::where('email', $email)->update([
                'password' => Hash::make($new_pass),
            ]);
            return redirect()->to('/');
        }
        echo "password not match";
    }
}
