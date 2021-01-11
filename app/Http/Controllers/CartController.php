<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\User;
use App\OrderProduct;
use App\Order;
use App\Http\Resources\Cart as CartResource;
use Auth;
use Illuminate\Http\Request;


class CartController extends Controller
{
    /*
    |------------------------------------------------------------------
    |   Cart List Page
    |------------------------------------------------------------------
    */
    public function index()
    {
        $user_id = auth('api')->user()->id;

        $carts = Cart::where('user_id', $user_id)->where('quantity', '>', '0')->get();

        return CartResource::collection($carts);

    }


    /*
    |------------------------------------------------------------------
    |   Cart Count
    |------------------------------------------------------------------
    */
    public function count_and_total()
    {
        $user_id = auth('api')->user()->id;
        $product = Product::get();

        $carts = Cart::where('user_id', $user_id)->where('quantity', '>', '0')->get();
        $count = Cart::where('user_id', $user_id)->where('quantity', '>', '0')->sum('quantity');
        $cart_total = 0;
        $dlv_fee = 0;

        foreach( $carts as $cart){

            $total = ($product->find($cart->product_id)->price) * ($cart->quantity);
            $cart_total =  $cart_total + $total;

        }

        if($cart_total < 400.00 && $cart_total > 0.00){
            $dlv_fee = 70.00;
        }

        $data = [
            'cart_count' => $count,
            'cart_total' => number_format($cart_total, 2),
            'dlv_fee' => number_format($dlv_fee, 2)
        ];

        return response()->json($data);

    }


    /*
    |------------------------------------------------------------------
    |   Add to cart
    |------------------------------------------------------------------
    */
    public function add_to_cart(Request $request, $id)
    {

        $user_id = auth('api')->user()->id;
        $product = Product::findOrFail($id);

        if(Cart::where('user_id',$user_id)->where('product_id', $product->id)->count() > 0){

                $data = Cart::where('user_id', $user_id)->where('product_id', $product->id)->first();
                $data->quantity = $data->quantity + 1;
                $data->save();
        }

        else{
                $data = new Cart;
                $data->user_id = $user_id;
                $data->product_id = $product->id;
                $data->save();
        }
        

        return response()->json($data);

    }


    /*
    |------------------------------------------------------------------
    |   Remove from cart
    |------------------------------------------------------------------
    */

    public function remove_from_cart($id)
    {

        $user_id = auth('api')->user()->id;
        $data = Cart::findOrFail($id);

       if($data->user_id == $user_id){

        
         if($data->delete()){

            return response()->json($data);

        }
      }

      else{

            return response()->json(['error'=>'Unauthorised'], 401);

      }
  
    }


     /*
    |------------------------------------------------------------------
    |   Increase Qunatity in Cart
    |------------------------------------------------------------------
    */

    public function incr_qty(Request $request, $id)
    {


        $user_id = auth('api')->user()->id;

        $data = Cart::findOrFail($id);

        if($data->user_id == $user_id){
        
        $data->quantity = $data->quantity + 1;;
        $data->save();

        return response()->json($data);

        }

        else{

            return response()->json(['error'=>'Unauthorised'], 401);
        }


    }


    /*
    |------------------------------------------------------------------
    |   Decrease Qunatity in Cart
    |------------------------------------------------------------------
    */


    public function decr_qty(Request $request, $id)
    {

        $user_id = auth('api')->user()->id;
        $data = Cart::findOrFail($id);

        if($data->user_id == $user_id){


            if($data->quantity == 1){

            $data->quantity = 0;
            $data->save();
          }
        
            elseif($data->quantity > 1){

            $data->quantity = $data->quantity - 1;
            $data->save();

          }

        return response()->json($data);

      }

    else{

            return response()->json(['error'=>'Unauthorised'], 401);


        }
        
    
    }


}
