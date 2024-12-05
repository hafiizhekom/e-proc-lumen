<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
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
        
        $user = User::where('email',$this->request->input('email'))
        ->where('password', md5($this->request->input('password')));

        if($user->count()>0){   
            $token = $this->jwt($user->first());
            return response()->json(['status'=>true, 'message'=>"Success Login", 'token'=>$token], 200);
        }else{
            return response()->json(['status'=>false, 'message'=>"Fail Login"], 200);
        }
    }

    public function register(){

        $user = new User;

        $user->nama_lengkap = $this->request->nama_lengkap;
        $user->email = $this->request->email;
        $user->password = md5($this->request->password);
        $user->id_jenis_kelamin = $this->request->id_jenis_kelamin;
        $user->tanggal_lahir = $this->request->tanggal_lahir;
        $user->no_handphone = $this->request->no_handphone;
        $user->alamat = $this->request->alamat;

        if($user->save()){
            return response()->json(['status'=>true, 'message'=>"Success Register"], 200);
        }else{
            return response()->json(['status'=>false, 'message'=>"Fail Register"], 200);
        }
    }
}
