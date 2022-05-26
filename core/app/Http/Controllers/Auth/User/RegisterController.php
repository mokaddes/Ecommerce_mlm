<?php

namespace App\Http\Controllers\Auth\User;


use App\{
    Http\Requests\UserRequest,
    Http\Controllers\Controller,
    Repositories\Front\UserRepository
};
use App\Mail\ReferalMail;
use App\Models\Category;
use App\Models\Item;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\{
    Http\Request,
};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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
    // dd(Session::all());
    }


    public function register(Request $request)
    {
            if (Auth::user()) {
                return redirect()->route('user.choose.product');
            } else {
                $request->validate([
                    'email' => 'required|email|unique:users,email',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'password' => 'required',
                ]);
                $max_id = DB::table('users')->max('own_referal');
                if($max_id){
                    $max_id = $max_id+1;
                }else{
                    $max_id = 1000;
                }

                $id = DB::table('users')->insertGetId([
                    'email'         => $request->email,
                    'first_name'    => $request->first_name,
                    'last_name'     => $request->last_name,
                    'password'      => Hash::make($request->password),
                    'phone'         => $request->phone,
                    'own_referal'   => $max_id,
                    'created_at'    => now(),
                ]);

                Session::put('register',$id);
                Session::flash('success',__('Account Register Successfully please login'));
                return redirect()->route('user.choose.product');
            }


    }

    public function signup_product(Request $request)
    {

        $id = Session::get('register');
        if ($request->signup_product) {
            $signup_product_arr       = $request->signup_product;
            $data['signup_product']   = implode(', ', $signup_product_arr);
        } else {
            $data['signup_product'] = null;
        }
        // $data['signup_product'] = $request->signup_product;
        Session::put('choose',$request->signup_product);
        if (Auth::user()) {
            DB::table('users')->where('id', Auth::user()->id)->update($data);
            if ($request->signup_product) {
                return redirect()->route('user.shipping.address');
            }else{
                return redirect()->back()->with('warning', 'Please Select a product');
            }
        } else {
            DB::table('users')->where('id', $id)->update($data);
            if ($request->signup_product) {
                return redirect()->route('user.shipping.address');
            }else{
                return redirect()->back()->with('warning', 'Please Select a product');
            }
        }

    }
    public function shippingStore(Request $request)
    {

        $id = Session::get('register');
        Session::put('shipping_address',$request->all());

        $data = request()->except(['_token']);
        if (Auth::user()) {
            DB::table('users')->where('id', Auth::user()->id)->update($data);
            return redirect()->route('user.referal');
            // dd($save, Auth::user()->id);
        }elseif (empty(Auth::user()) && Session::has('register')) {
            DB::table('users')->where('id', $id)->update($data);
            return redirect()->route('user.referal');
        }else{
            return redirect()->back()->with('warning', 'You are not an authenticate user. Please login or register.');
        }

    }

    public function referal(Request $request)
    {
        if (Auth::user()) {
            $referal = DB::table('referals')->where('user_id', Auth::user()->id)->get();
        }

        if (isset($referal)) {
            $request->validate([
                'referal_id' => 'required|exists:referals,referal_id',
            ]);
        } else {
            $request->validate([
                'referal_id' => 'required|exists:users,own_referal',
            ]);
        }




        $id = Session::get('register');
        $data['referal_id'] = $request->referal_id;
        Session::put('referal',$request->referal_id);
        if (Auth::user()) {
            DB::table('users')->where('id', Auth::user()->id)->update($data);
            return redirect()->route('user.payment');
            // dd($save, Auth::user()->id);
        }elseif (empty(Auth::user()) && Session::has('register')) {
            DB::table('users')->where('id', $id)->update($data);
            return redirect()->route('user.payment');
        }else{
            return redirect()->back()->with('warning', 'You are not an authenticate user. Please login or register.');
        }

    }
    public function referal_mail(Request $request)
    {
        $id = Session::get('register');

        $data = $request->validate([
            'referal_email' => 'required|unique:referals',
        ]);



        $email =$request->referal_email;
        $message = $request->referal_message;
        $mails = [
            'title'     => 'Mail For Referal Id',
            'email'     => $email,
            'message'   => $message,
        ];
        $data['created_at'] = now();
        if (empty(Auth::user()) && Session::has('register')) {
            $data['user_id'] = $id;
            $data['created_by'] = $id;
            DB::table('referals')->insert($data);
            Mail::to('admin@gmail.com')->send(new ReferalMail($mails));

            return redirect()->route('user.login');
            // dd($data);
        }elseif (Auth::user()) {
            $data['user_id'] = Auth::user()->id;
            $data['created_by'] = Auth::user()->id;
            DB::table('referals')->insert($data);
            // Mail::to('admin@gmail.com')->send(new ReferalMail($mails));

            return redirect()->route('user.login');
        }
        else {
            return redirect()->back()->with('warning', 'You are not an authenticate user. Please login or register.');
        }

        // dd($email);

    }


    public function user_payment(Request $request)
    {
        $request->validate([
            'txn_id' => 'required',
        ]);

        $id = Session::get('register');
        $data['txn_id'] = $request->txn_id;
        $image = $request->file('txn_pic');
        if ($image) {
            $image_name = hexdec(uniqid()). '.' .strtolower($image->getClientOriginalExtension());
            $upload_path    = 'media/user_payment/';
            $image_url = $upload_path.$image_name;
            $image->move($upload_path, $image_name);
            $data['txn_pic'] = $image_url;
        }
        Session::put('txn',$request->txn_id);
        DB::table('users')->where('id', $id)->update($data);
        Session::forget('register');
        Session::forget('choose');
        Session::forget('referal');
        return redirect()->route('user.login');

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


    public function showProduct(Request $request)
    {

        $products = Item::with('category')->where('signup_choose', 1)->where('item_type', 'digital')->limit(3)->get();

         return view('user.auth.register.choose_product', compact('products'));
    }

    public function showReferer()
    {
        return view('user.auth.register.referal_id');
    }

    public function showPayment()
    {
        $payment = DB::table('payment_settings')->whereId(27)->first();
        $qrcode = \QrCode::size(100)->generate(strip_tags($payment->text));
        return view('user.auth.register.payment', compact('qrcode'));
    }

    public function ShippintAddress()
    {
        return view('user.auth.register.shipping_address');
    }







}
