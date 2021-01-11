<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    //

    public function index(Request $request)
    {


    //	if ($request->query('ref') ) {
      //    setcookie('ace_referral', $request->query('ref'), time() + (2000), "/");
      //  }


    	return view('welcome');
    }
}


 