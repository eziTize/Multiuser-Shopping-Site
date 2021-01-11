<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Redirect;
use App\User;
use App\Admin;
use App\Order;
use App\Seller;
use App\Product;
use App\RefOrder;
use App\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;


class OrderController extends Controller
{
    /*
    |------------------------------------------------------------------
    |   Order List Page
    |------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        
        //Display Paginated with orderby
        $orders = Order::orderBy('created_at', 'desc')->paginate(8);
        $query = $request->input('txn_id');

    
         if($request->get('txn_id'))
        {

            $data = Order::where('transaction_id', $query)->paginate(8); //search

        }

        else{

            $data = Order::orderBy('created_at', 'desc')->paginate(8); //normal
        }


        $data = [
            'data' => $data,
            'user' => User::get(),
            'link' => env('admin').'/orders/'
        ];

        return View('admin.orders.index',$data);

    }


    public function show($id)
    {
        $order = Order::findOrFail($id);
        $order_p = OrderProduct::where('order_id', $order->id)->get();
        $ref = '';
        if($order->ref_id){
            $ref = Seller::where('ref_id', $order->ref_id)->firstOrFail();
        }

        $data = [

            'data' => $order,
            'order_p' => $order_p,
            'products' => Product::get(),
            'ref' => $ref,
            'link' => env('admin').'/orders/'
        ];

        return View('admin.orders.single', $data);

    }


    public function editStatus($id)
    {
        
         $order = Order::findOrFail($id);

         $data = [
            'data' => $order,
            'link' => env('admin').'/orders/'
        ];

         return View('admin.orders.edit',$data);

    }

    public function toggleStatus(Request $request, $id){

        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();


        if($request->input('status') == 'Successful' || $request->input('status') == 'Delivered'){

            if($order->ref_id){
                $seller = Seller::where('ref_id', $order->ref_id)->firstOrFail();
                if($seller) {

                    if(RefOrder::where('order_id', $order->id)->count() == 0){

                       $r_order = new RefOrder;
                       $r_order->seller_id = $seller->id;
                       $r_order->order_id =  $order->id;
                       $r_order->pr_earned = $order->ref_amt;
                       $r_order->save();

                       $seller->r_earnings = $seller->r_earnings + $r_order->pr_earned;
                       $seller->save();
                    }   
                }

            }

        }


     /*   elseif ($request->input('status') == 'Delivered'){

            return Redirect(env('admin').'/orders')->with('message','Order Status Updated.');
        } */


        else{

            if($order->ref_id){
                $seller = Seller::where('ref_id', $order->ref_id)->firstOrFail();
                $r_order = RefOrder::where('seller_id', $seller->id)->where('order_id', $order->id)->first();
                if($r_order) {

                    $seller->r_earnings = $seller->r_earnings - $r_order->pr_earned;
                    $seller->save();
                    $r_order->delete();

                }

            }

        }

        return Redirect(env('admin').'/orders')->with('message','Order Status Updated.');



    }

}
