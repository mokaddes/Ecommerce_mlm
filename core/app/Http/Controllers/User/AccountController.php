<?php

namespace App\Http\Controllers\User;

use App\{
    Http\Requests\UserRequest,
    Http\Controllers\Controller,
    Repositories\Front\UserRepository
};
use App\Helpers\ImageHelper;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
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
        $this->middleware('auth');

        $this->repository = $repository;
    }

    public function index()
    {
        $id = Auth::user()->id;

        return view('user.dashboard.dashboard',[
            'allorders' => Order::whereUserId($id)->count(),
            'pending' => Order::whereUserId($id)->whereOrderStatus('pending')->count(),
            'progress' => Order::whereUserId($id)->whereOrderStatus('In Progress')->count(),
            'delivered' => Order::whereUserId($id)->whereOrderStatus('Delivered')->count(),
            'canceled' => Order::whereUserId($id)->whereOrderStatus('Canceled')->count(),
            'referal' => DB::table('referals')->whereUserId($id)->first(),
            'users' => DB::table('users')->where('referal_id', Auth::user()->own_referal)->count(),
            'first_ref_earnings' => DB::table('referral_bonus')->where('first_ref_id',$id)->sum('first_ref_paid_amt'),
            'second_ref_earnings' => DB::table('referral_bonus')->where('second_ref_id',$id)->sum('second_ref_paid_amt'),



        ]);

    }


    public function profile()
    {
        $user = Auth::user();
        $check_newsletter = Subscriber::where('email',$user->email)->exists();
        return view('user.dashboard.index',[
            'user' => $user,
            'check_newsletter' => $check_newsletter,
        ]);
    }



    public function profileUpdate(UserRequest $request)
    {   $this->repository->profileUpdate($request);
        Session::flash('success',__('Profile Updated Successfully.'));
        return redirect()->back();
    }

    public function addresses()
    {
        $user = Auth::user();
        return view('user.dashboard.address',[
            'user' => $user
        ]);
    }

    public function billingSubmit(Request $request)
    {

        $request->validate([
            'bill_address1' => 'required|max:100',
            'bill_address2' => 'nullable|max:100',
            'bill_zip'      => 'nullable|max:100',
            'bill_city'      => 'required|max:100',
            'bill_company'   => 'nullable|max:100',
            'bill_country'   => 'required|max:100',
        ]);
        $user =  Auth::user();
        $input = $request->all();
        $user->update($input);
        Session::flash('success',__('Address update successfully'));
        return back();
    }

    public function shippingSubmit(Request $request)
    {
        $request->validate([
            'ship_address1' => 'required|max:100',
            'ship_address2' => 'nullable|max:100',
            'ship_zip'      => 'nullable|max:100',
            'ship_city'      => 'required|max:100',
            'ship_company'   => 'nullable|max:100',
            'ship_country'   => 'required|max:100',
        ]);
        $user =  Auth::user();
        $input = $request->all();
        $user->update($input);
        Session::flash('success',__('Address update successfully'));
        return back();
    }


    public function removeAccount()
    {
        $user = User::where('id',Auth::user()->id)->first();
        ImageHelper::handleDeletedImage($user,'photo','assets/images/');
        $user->delete();
        Session::flash('success',__('Your account successfully remove'));
        return redirect(route('front.index'));
    }

    public function referal_manage()
    {
        $users = DB::table('users')->where('referal_id', Auth::user()->own_referal)->get();
        return view('user.dashboard.referal_manage', compact('users'));
    }


}
