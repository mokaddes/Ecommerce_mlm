<?php

namespace App\Http\Controllers\Back;

use App\{
    Models\User,
    Http\Controllers\Controller
};
use App\Helpers\ImageHelper;
use App\Http\Requests\UserRequest;
use App\Mail\ReferalMail;
use App\Models\Subscriber;
use App\Repositories\Front\UserRepository;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
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
        $this->middleware('auth:admin');

        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('back.user.index',[
            'datas' => User::latest()->get()
        ]);

        // $datas = User::with('referal')
        // ->join('referals', 'users.id', '=', 'referals.user_id')
        // ->get();
        // return view('back.user.index', compact('datas'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        $referal = User::where('own_referal', $user->referal_id)->first();
        $first_ref_paid_amt =  DB::table('referral_bonus')->where('first_ref_id', $user->id)->sum('first_ref_paid_amt');
        $second_ref_paid_amt =  DB::table('referral_bonus')->where('second_ref_id', $user->id)->sum('second_ref_paid_amt');
        return view('back.user.show',compact('user', 'referal', 'second_ref_paid_amt', 'first_ref_paid_amt'));
    }

    public function refer(User $user)
    {
        $referal = User::where('referal_id', $user->own_referal)->get();
        // $users = DB::table('users')->where('referal_id', Auth::user()->own_referal)->get();
        return view('back.user.refer_user',compact('user', 'referal'));
    }


    public function update(UserRequest $request)
    {
        $request->validate([
            'password' => 'min:6|max:16|nullable'
        ]);
        $this->repository->profileUpdate($request);
        return redirect()->back()->withSuccess(__('Profile Updated Successfully.'));

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        ImageHelper::handleDeletedImage($user,'photo','assets/images/');
        $user->delete();
        return redirect()->route('back.user.index')->withSuccess(__('Customer Deleted Successfully.'));
    }


    public function referal()
    {
        $datas = User::with('referal')
        ->join('referals', 'users.id', '=', 'referals.user_id')
        ->where('referals.referal_id', '=', null)
        ->get();
        return view('back.user.referal_request', compact('datas'));
    }

    public function send_referal($id)
    {
        $user = DB::table('referals')->where('id', $id)->first();
        return view('back.user.send_referal',compact('user'));
    }

    public function referal_submit(Request $request)
    {
        // $user_id = $request->user_id;
        $email = $request->referal_email;
        $referal_id = $request->referal_id;
        $data = $request->validate([
            'referal_id' => 'required',

        ]);
        // check is this own id
        $user =  DB::table('users')->where('email', $email)->first();
        if($user->own_referal == $referal_id){
            return redirect()->route('back.user.referal')->with('error', 'This referal ID is own user referal ID');
        }
        $data['updated_by'] = Auth::user()->id;
        $data['updated_at'] = now();

        DB::table('referals')->where('referal_email', $email)->update($data);

        $mails = [
            'title'     => 'Mail For Referal Id',
            'email'     => $email,
            'message'   => 'Your Referal id is: '.$referal_id . ' Please complete your signup process.'
        ];
        Mail::to($email)->send(new ReferalMail($mails));
        return redirect()->route('back.user.referal');
    }

    public function active($id)
    {
        $auth_id =  Auth::id();
        //check referral bonus distribution
        $bonus = DB::table('referral_bonus')->where('registered_user_id', $id)->first();
        if($bonus == null){
            $user = User::where('id', $id)->first();
            $payment_currency = $user->txn_currency;
            $settings = DB::table('settings')->select('first_ref_bonus','second_ref_bonus', 'regi_fee_rm', 'regi_fee_sgd')->where('id',1)->first();
            $first_ref_user = DB::table('users')->where('own_referal', $user->referal_id)->first();
            $second_ref_id = null;
            $second_ref_paid_amt =  null;
            if($first_ref_user){
                $second_ref_user = DB::table('users')->where('own_referal', $first_ref_user->referal_id)->first();
                if($second_ref_user){
                    $second_ref_id = $second_ref_user->id;
                    if($payment_currency == 'SGD'){
                        $second_ref_paid_amt = ($settings->second_ref_bonus/100)*$settings->regi_fee_sgd;
                    }else{
                        $second_ref_paid_amt = ($settings->second_ref_bonus/100)*$settings->regi_fee_rm;
                    }

                }
            }

            // if (isset($first_ref_user)) {
            //     $first_ref_id = $first_ref_user->id;
            // } else {
            //     $first_ref_id = null;
            // }

            $first_ref_id = $first_ref_user->id;


            $payment_currency = $user->txn_currency;

            if($payment_currency == 'SGD'){
                $payment_amount = $settings->regi_fee_sgd;
                $first_ref_paid_amt = ($settings->first_ref_bonus/100)*$settings->regi_fee_sgd;
            }else{
                $payment_amount = $settings->regi_fee_rm;
                $first_ref_paid_amt = ($settings->first_ref_bonus/100)*$settings->regi_fee_rm;
            }



            DB::table('referral_bonus')->insert(['registered_user_id' => $id, 'first_ref_id' => $first_ref_id, 'second_ref_id' => $second_ref_id, 'payment_currency' => $payment_currency, 'payment_amount' => $payment_amount, 'first_ref_paid_amt' => $first_ref_paid_amt, 'second_ref_paid_amt' => $second_ref_paid_amt, 'created_by' => $auth_id, 'created_at' => now()]);
        }

        User::where('id', $id)->update(['status' => 1]);

        return redirect()->back()->with('success', 'User activated');
    }

    public function inactive($id)
    {
        User::where('id', $id)->update(['status' => 0]);

        return redirect()->back()->with('success', 'User deactivated');
    }
}
