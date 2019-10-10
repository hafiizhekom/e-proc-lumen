<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        //

        $this->request = $request;
    }


    public function login(){
        
        $user = User::where('username',$this->request->input('username'))
        ->where('password', md5($this->request->input('password')));

        if($user->count()>0){   
            $token = $this->jwt($user->first());
            $user->update(['api_token' => $token]);
            return response()->json(['status'=>true, 'message'=>"Success Login", 'token'=>$token], 200);
        }else{
            return response()->json(['status'=>false, 'message'=>"Fail Login"], 200);
        }
    }
}
