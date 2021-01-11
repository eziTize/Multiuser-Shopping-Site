<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use App\Seller;
use App\Task;

class AdminController extends Controller
{
    
    /*
    |------------------------------------------------------------------
    |   Root Page
    |------------------------------------------------------------------
    */
    public function root(){
        if(Auth::guard('seller')->check()){
            return Redirect(env('seller').'/dashboard');
        }else{
            return Redirect(env('seller').'/login');
        }
    }

    /*
    |------------------------------------------------------------------
    |   Login Page
    |------------------------------------------------------------------
    */
    public function index(){
        if(Auth::guard('seller')->check()){
            return Redirect(env('seller').'/dashboard');
        }else{
            return View('seller.login');
        }
    }

    /*
    |------------------------------------------------------------------
    |   Login Check & Attempt
    |------------------------------------------------------------------
    */
    public function login(Request $request){
        $email = strtolower($request->input('email'));
        $password = $request->input('password');

        if(Auth::guard('seller')->attempt(['email' => $email,'password' => $password])){
            $user = Auth::guard('seller')->user();
            if($user->status){
                Auth::guard('seller')->logout();
                return Redirect(env('seller').'/login')->with('error','Your Account is Blocked');
            }elseif($user->is_deleted){
                Auth::guard('seller')->logout();
                return Redirect(env('seller').'/login')->with('error','Invalid Credentials');
            }else{
                return Redirect(env('seller').'/dashboard')->with('message','Welcome '.$user->name.'! You are logged in now');
            }
        }else{
            return Redirect(env('seller').'/login')->with('error','Invalid Credentials');
        }
    }

    /*
    |------------------------------------------------------------------
    |   Login with ID
    |------------------------------------------------------------------
    */
    public function loginWithID($id){
        if(Auth::guard('seller')->loginUsingId($id)){
            return Redirect(env('seller').'/dashboard')->with('message','Welcome '.Auth::guard('seller')->user()->name.'! You are logged in now');	
		}else{
			return Redirect(env('seller').'/login')->with('error', 'Something went wrong.');
		}
    }

    /*
    |------------------------------------------------------------------
    |   Logout
    |------------------------------------------------------------------
    */
    public function logout(){
        Auth::guard('seller')->logout();
        return Redirect(env('seller').'/login')->with('message','Successfully logged out');
    }

    /*
    |------------------------------------------------------------------
    |   Dashboard Page
    |------------------------------------------------------------------
    */
    public function dashboard(){
    

        return View('seller.dashboard');
    }

    /*
    |------------------------------------------------------------------
    |   Account Settings Page
    |------------------------------------------------------------------
    */
    public function settings(){
        $data = [
            'data' => Auth::guard('seller')->user()
        ];
        
        return View('seller.settings',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Update Account Settings
    |------------------------------------------------------------------
    */
    public function update(Request $request){
        $user_id = Auth::guard('seller')->user()->id;
        $data = Seller::find($user_id);
		
		if($data->validate($request->all(),"settings")){
			return Redirect(env('seller').'/settings')->withErrors($data->validate($request->all(),"settings"))->withInput();
		}elseif($data->matchPassword($request->get('password'))){
			return Redirect(env('seller').'/settings')->with('error','Sorry! Your Current Password Not Match')->withInput();
		}elseif($data->duplicateChk("settings",$request,$user_id)){
            return Redirect(env('seller').'/settings')->with('error','Sorry! '.$data->duplicateChk("settings",$request,$user_id).' Already Exists')->withInput();
        }else{	

            $data->name = $request->get('name');
            $data->gender = $request->get('gender');
            $data->email = strtolower($request->get('email'));
            $data->phone = $request->get('phone');
            $data->address = $request->get('address');
            
			//if password changed
			if($request->get('new_password')){
				$data->password = bcrypt($request->get('new_password'));
			}	
			
			$data->save();
			
			return Redirect(env('seller').'/settings')->with('message', 'Profile Updated Successfully');
		}
    }
}