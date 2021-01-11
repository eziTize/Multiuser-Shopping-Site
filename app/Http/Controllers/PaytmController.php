<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Order;
use PaytmWallet;
use App\Product;
use App\User;
use App\Cart;
use App\OrderProduct;
use Auth;
use App\Seller;
use App\RefOrder;



class PaytmController extends Controller
{
    /*
    |------------------------------------------------------------------
    |   Make A Transaction
    |------------------------------------------------------------------
    */

    public function order()
    {

       $uid = rand(11,999);


       $order = Order::findOrFail($_COOKIE["ac_store_order_id"]);
       $order->transaction_id = uniqid().$uid.$_COOKIE["ac_store_user_id"];
       $order->save();

        //Paytm Order
        $payment = PaytmWallet::with('receive');
        $payment->prepare([
          'order' => $order->transaction_id,
          'user' => $_COOKIE["ac_store_user_id"],
          'mobile_number' => $_COOKIE["ac_store_ph_no"],
          'email' => $_COOKIE["ac_store_email"],
          'amount' => $_COOKIE["ac_store_amount"],
          'callback_url' => env('PAYTM_CALLBACK_URL'),
        ]);

       //Remove Cookie
       setcookie('ac_store_user_id','', time() - 3600, "/");
       setcookie('ac_store_amount', '', time() - 3600, "/");
       setcookie('ac_store_email', '', time() - 3600, "/");
       setcookie('ac_store_ph_no', '', time() - 3600, "/");
       //setcookie('ac_store_order_id', '', time() - 3600, "/");

        return $payment->receive();
    }

    /*
    |------------------------------------------------------------------
    |   Payment Callback
    |------------------------------------------------------------------
    */

    public function paymentCallback(Request $request)
    {

    	if(!isset($_COOKIE["ac_store_order_id"])){

    		return View('Failed');
    	}


    	$order = Order::findOrFail($_COOKIE["ac_store_order_id"]);

        $transaction = PaytmWallet::with('receive');
        
        $response = $transaction->response(); // To get raw response as array
        //Check out response parameters sent by paytm here -> http://paywithpaytm.com/developer/paytm_api_doc?target=interpreting-response-sent-by-paytm
        
        if($transaction->isSuccessful()){

		       $order->status = "Successful";
		       $order->save();

          setcookie('ac_store_order_id', '', time() - 172800, "/");


           if($order->ref_id){
           $ref_id = $order->ref_id;
           $seller = Seller::where('ref_id', $ref_id)->first();

           $r_order = new RefOrder;
           $r_order->seller_id = $seller->id;
           $r_order->order_id =  $order->id;
           $r_order->pr_earned = $order->ref_amt;
           $r_order->save();

           $seller->r_earnings = $seller->r_earnings + $r_order->pr_earned;
           $seller->save();

           //setcookie('ac_referral', '', time() - 172800, "/");

           }

           
         return View('Successful');


         //return response()->json('Successful'); 

        }else if($transaction->isFailed()){

        $order->status = "Failed";
		    $order->save();
		    setcookie('ac_store_order_id', '', time() - 172800, "/");


		    return View('Failed');

         //return response()->json('Failed'); 

        }else if($transaction->isOpen()){


        $order->status = "Pending";
		    $order->save();
		    setcookie('ac_store_order_id', '', time() - 172800, "/");

		    return View('Pending');
            
         //return response()->json('Open'); 

        }

        $transaction->getResponseMessage(); //Get Response Message If Available
        //get important parameters via public methods
        $transaction->getOrderId(); // Get order id
        $transaction->getTransactionId(); // Get transaction id

    }    
}
