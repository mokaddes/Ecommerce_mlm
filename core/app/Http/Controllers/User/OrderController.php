<?php

namespace App\Http\Controllers\User;

use App\{
    Models\Order,
    Models\TrackOrder,
    Http\Controllers\Controller
};

use DB;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Constructor Method.
     *
     * Setting Authentication
     *
     */

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(Request $request)
    {
        $id = Auth::user()->id;
        $orders = Order::whereUserId($id)->latest('id')->get();
        $is_child_orders = 0;
        $child = 'NO';
        $grand_child = 'NO';
        $user = DB::table('users')->where('id', $id)->first();

        if($request->user){
            $own_referal = Auth::user()->own_referal;
            // check child or grandchild
            $user = DB::table('users')->where('id', $request->user)->first();

            if($own_referal == $user->referal_id){

                $child = 'YES';
                $is_child_orders = 1;
                $orders = Order::whereUserId($request->user)->latest('id')->get();

            }else{
                $parent = DB::table('users')->where('own_referal', $user->referal_id)->first();

                if($own_referal == $parent->referal_id){
                    $grand_child = 'YES';
                    $is_child_orders = 1;
                    $orders = Order::whereUserId($request->user)->latest('id')->get();
                }

            }
            if($is_child_orders == 0){
                abort(404);
            }

        }

        // dd($user);
        return view('user.order.index',compact('orders', 'is_child_orders','user'));
    }


    public function details($id)
    {
        $user = Auth::user();
        $order = Order::findOrfail($id);
        $cart = json_decode($order->cart, true);
        return view('user.order.invoice',compact('user','order','cart'));
    }

    public function printOrder($id)
    {
        $user = Auth::user();
        $order = Order::findOrfail($id);
        $cart = json_decode($order->cart, true);
        return view('user.order.print',compact('user','order','cart'));
    }
}
