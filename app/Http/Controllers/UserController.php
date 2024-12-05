<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserJenisKelamin;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    { 
        //
        //$this->middleware('auth');
        $this->request = $request;
    
    } 

    public function show(){
        $userAuth = $this->request->user()->user;
        $data = User::get();
        return response()->json(['status'=>true, 'data'=>$data]);
    }

    public function showCurrent(){
        $userAuth = $this->request->user()->user;
        $data = User::where('email',$userAuth->email)->with('userJenisKelamin')->first();
        return response()->json(['status'=>true, 'data'=>$data]);
    }

    public function showByID($id){
        $data = User::where('id',$id)->with('vendors')->with('userJenisKelamin')->first();
        return response()->json(['status'=>true, 'data'=>$data]);
    }

    public function showJenisKelamin(){
        $data = UserJenisKelamin::get();
        return response()->json(['status'=>true, 'data'=>$data]);
    }

    
}
