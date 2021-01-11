<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; 
//use Request;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
//use Illuminate\Support\Facades\Cookie;
use App\Http\Resources\User as UserResource;

class UserController extends Controller 
{
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user();

            $user->is_logged = true;
            $user->save();
            
            return new UserResource([
            'user'=> $user,
            'token' => $user->createToken('Store')-> accessToken, 
            ], $this-> successStatus); 
        } 
        else{ 
            return new UserResource(['error'=>'Unauthorised'], 401); 
        } 
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        
        $user = Validator::make($request->all(), [ 
            'name' => 'required|string|max:255', 
            'email' => 'required|string|email|max:255|unique:users',
            'ph_no' => 'required|numeric|unique:users',
            'password' => 'required|string|min:6', 
            'c_password' => 'required|same:password', 
        ]);
        

        if ($user->fails()) { 
            return response()->json(['error'=>$user->errors()], 401);            
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']); 
        //$user->is_logged = true;

        $user = User::create($input); 
        $user->is_logged = true;


        if(Cookie::get('ac_referral')){

            $user->referrer_id = Cookie::get('ac_referral');
        }
        
        $user->save();

        
    return new UserResource([
        //'user'=> $user,
        'token' => $user->createToken('Store')-> accessToken,
    ], $this-> successStatus); 
    }
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return new UserResource( $user, $this-> successStatus);
    } 

public function update(Request $request)
{

    $user = Auth::user();


    $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id(),
            'ph_no' => 'required|numeric|unique:users,ph_no,'.auth()->id(),
            'password' => 'sometimes|nullable|string|min:6|confirmed',
            //'c_password' => 'same:password',

        ]);

    
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->ph_no = $request->input('ph_no');
    //$user->save();

    if ( ! $request->input('password') == '')
    {
        $user->password = bcrypt($request->input('password'));
        //$user->c_password = bcrypt(Request::input('c_password'));
    }

    $user->save();

    
     return new UserResource( $user, $this-> successStatus);
}


public function logout(Request $request)

{

            $a_token = Auth::user()->token();
            $user = Auth::user();
            
            $a_token->revoke();
            $user->is_logged = false;

            $user->save();

           return new UserResource([
                'is_logged'=> $user->is_logged,
                'name' => $user->name,
            ], $this-> successStatus);

}
   
}