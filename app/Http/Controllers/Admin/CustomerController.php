<?php

namespace App\Http\Controllers\Admin;


use Auth;
use Redirect;
use App\Admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /*
    |------------------------------------------------------------------
    |   Customer List Page
    |------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        
        //Display Paginated with orderby
        $customers = User::orderBy('created_at', 'desc')->paginate(8);
        $query = $request->input('cust_email');

    
         if($request->get('cust_email'))
        {

            $data = User::where('email', 'like', "%$query%")->paginate(8); //search

        }

        else{

            $data = User::orderBy('created_at', 'desc')->paginate(8); //normal
        }


        $data = [
            'data' => $data,
            'link' => env('admin').'/customers/'
        ];

        return View('admin.customers.index',$data);

    }
}
