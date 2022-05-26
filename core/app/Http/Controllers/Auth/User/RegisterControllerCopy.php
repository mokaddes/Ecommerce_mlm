<?php

namespace App\Http\Controllers\Auth\User;


use App\{
    Http\Requests\UserRequest,
    Http\Controllers\Controller,
    Repositories\Front\UserRepository
};
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{

    /**
     * Constructor Method.
     *
     * Setting Authentication
     *
     * @param  \App\Repositories\Back\UserRepository $repository
     *
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;

        $setting = Setting::first();
        if($setting->recaptcha == 1){
            Config::set('captcha.sitekey', $setting->google_recaptcha_site_key);
            Config::set('captcha.secret', $setting->google_recaptcha_secret_key);
        }
    }


    public function showForm()
    {
      return view('user.auth.register');
    }


    public function register(UserRequest $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email'
        ]);
        $this->repository->register($request);
        Session::flash('success',__('Account Register Successfully please login'));
        return redirect()->route('user.choose.product');

    }



    public function verify($token)
    {
        $user = User::where('email_token',$token)->first();

        if($user){

            Auth::login($user);

            return redirect(route('user.dashboard'));
        }else{
            return redirect(route('user.login'));
        }
    }


    public function showProduct()
    {
         return view('user.auth.register.choose_product');
    }

    public function showReferer()
    {
        return view('user.auth.register.referal_id');
    }

    public function showPayment()
    {
        return view('user.auth.register.payment');
    }



}
