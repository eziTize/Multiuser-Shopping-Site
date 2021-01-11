<?php

namespace App\Http\Controllers\Seller;

use Auth;
use App\User;
use App\Order;
use App\Seller;
use App\RefOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    /*
    |------------------------------------------------------------------
    |   Sales List Page
    |------------------------------------------------------------------
    */
    public function index(){


        $seller_id = Auth::guard('seller')->user()->id;

        $data = [
            'data' => RefOrder::where('seller_id', $seller_id)->orderBy('created_at', 'desc')->paginate(8), //normal
            'order' => Order::get(),
            'customer' => User::get(),
            'link' => env('admin').'/sales/'
        ];

        return View('seller.sales.index',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Seller Data Delete Permanently
    |------------------------------------------------------------------
    
    public function destroy($id){
        $data = Seller::find($id);
        $data->delete();

        return Redirect(env('admin').'/seller')->with('message','Seller Deleted Successfully.');
    }
   */

}
