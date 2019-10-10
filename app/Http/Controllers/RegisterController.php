<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class RegisterController extends Controller
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


    public function register(){

        $user = new User;

        $user->username = $this->request->username;
        $user->nama_lengkap = $this->request->nama_lengkap;
        $user->email = $this->request->email;
        $user->password = md5($this->request->password);
        $user->jenis_kelamin = $this->request->jenis_kelamin;
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
