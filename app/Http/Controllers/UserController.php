<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

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
        $this->middleware('auth');
        $this->request = $request;
    }


    public function show(){
        
        
        $user = User::all();

        return response()->json($user);
    }

    public function show2(){

        $user = Auth::user();


        return response()->json(['data' => [ 'success' => true, 'user' => $user ]], 200);
    }

    public function show3(){

        $user = Auth::user();


        return response()->json(['data' => [ 'success' => true, 'user' => $user ]], 200);
    }
}
