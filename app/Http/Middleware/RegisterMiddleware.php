<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Validator;
use Closure;

class RegisterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
           
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:user|max:15',
            'nama_lengkap' => 'required|string|max:100',
            'email'=>'required|email|unique:user|max:50',
            'password' => [
                'required',
                'string',
                'min:10',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'password_confirm' => 'required|same:password',
            'jenis_kelamin'=>'required|in:Wanita,Pria',
            'tanggal_lahir'=>'required|date_format:Y-m-d|before:today',
            'no_handphone'=>'required|string|regex:/[0-9]/|max:15',
            'alamat'=>'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response(['status'=>false, 'message'=>$validator->errors()->all()], 400);
        }
        
        return $next($request);
    }
}
