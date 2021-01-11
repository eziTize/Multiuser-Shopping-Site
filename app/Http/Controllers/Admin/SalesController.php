<?php

namespace App\Http\Controllers\Admin;

use App\Seller;
use App\Admin;
use App\Order;
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
    public function index(Request $request){

         if($request->get('seller_id'))
        {

            $data = RefOrder::where('seller_id', $request->get('seller_id'))->paginate(8); //search

        } 

        else{

            $data = RefOrder::orderBy('created_at', 'desc')->paginate(8); //normal
        }


        $data = [
            'data' => $data,
            'order' => Order::get(),
            'seller' => Seller::get(),
            'link' => env('admin').'/sales/'
        ];

        return View('admin.sales.index',$data);
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
