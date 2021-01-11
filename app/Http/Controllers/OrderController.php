<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Cart;
use App\Order;
use App\Seller;
use PaytmWallet;
use App\Product;
use App\Category;
use App\OrderProduct;
use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\Order as OrderResource;
use Illuminate\Support\Facades\Cookie;


class OrderController extends Controller
{

  public function checkout(Request $request){

        $user_id = auth('api')->user()->id;
        $product = Product::get();

        $carts = Cart::where('user_id', $user_id)->where('quantity', '>', '0')->get();
        $cart_total = 0;
        $ref_total = 0;

        foreach( $carts as $cart){

            $s_product = $product->find($cart->product_id);
            $total = ($s_product->price) * ($cart->quantity);
            $category = Category::where('name', $s_product->category_name)->firstOrFail();

            $r_total = $total * ($category->ref_pct / 100);

            $ref_total = $r_total + $ref_total;
            $cart_total =  $cart_total + $total;

        }

        //Create Order
        $order = new Order;
        $order->user_id = $user_id;
        $order->address = $request->input('address');
        $order->ph_no = $request->input('ph_no');
        $order->email = $request->input('email');
        $order->amount = $cart_total;
        $order->ref_amt = $ref_total;
        $order->status = 'Pending';
        $order->type = 'Online';
        if(Cookie::get('ac_referral')){
            $order->ref_id = Cookie::get('ac_referral');
          }
        $order->save();


        // Create Order Products for Each Order
        foreach( $carts as $cart){

            $o_products = OrderProduct::Create(array(

                                    'order_id' => $order->id,
                                    'product_id'  => $cart->product_id,
                                    'quantity' => $cart->quantity,
                                    
                        ));
        }

      // Store Cookie
       setcookie('ac_store_user_id', $user_id, time() + (300), "/");
       setcookie('ac_store_amount', $order->amount, time() + (300), "/");
      // setcookie('ac_store_ref_amt', $order->ref_amt, time() + (300), "/");
       setcookie('ac_store_email', $order->email, time() + (300), "/");
       setcookie('ac_store_ph_no', $order->ph_no, time() + (300), "/");
       setcookie('ac_store_order_id', $order->id, time() + (86400), "/");
       setcookie('ac_store_order_id', $order->id, time() + (86400), "/");

       Mail::send(new OrderPlaced($order));

       Cart::where('user_id', $user_id)->where('quantity', '>', '0')->delete();
       return response()->json($order);

    }

        public function cod(Request $request){

        $user_id = auth('api')->user()->id;
        $product = Product::get();

        $carts = Cart::where('user_id', $user_id)->where('quantity', '>', '0')->get();
        $cart_total = 0;
        $ref_total = 0;

        foreach( $carts as $cart){

            $s_product = $product->find($cart->product_id);
            $total = ($s_product->price) * ($cart->quantity);
            $category = Category::where('name', $s_product->category_name)->firstOrFail();

            $r_total = $total * ($category->ref_pct / 100);

            $ref_total = $r_total + $ref_total;
            $cart_total =  $cart_total + $total;

        }

        //Create Order
        $order = new Order;
        $order->user_id = $user_id;
        $order->transaction_id = 'N/A';
        $order->address = $request->input('address');
        $order->ph_no = $request->input('ph_no');
        $order->email = $request->input('email');
        $order->amount = $cart_total;
        $order->ref_amt = $ref_total;
        $order->type = 'COD';
        $order->status = 'Pending';
        if(Cookie::get('ac_referral')){
            $order->ref_id = Cookie::get('ac_referral');
          }
        $order->save();


        // Create Order Products for Each Order
        foreach( $carts as $cart){

            $o_products = OrderProduct::Create(array(

                                    'order_id' => $order->id,
                                    'product_id'  => $cart->product_id,
                                    'quantity' => $cart->quantity,
                                    
                        ));

        }

       Mail::send(new OrderPlaced($order));
       
       Cart::where('user_id', $user_id)->where('quantity', '>', '0')->delete();
       return response()->json($order);

    }

    public function Index(){

        $user_id = auth('api')->user()->id;
        $orders = Order::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        //return response()->json($data = ["data" => $orders]);
        return OrderResource::collection($orders);
    }
   

}
