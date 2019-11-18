<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Validator;
use Closure;

class TenderCaraPembayaranMiddleware
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
            'nama_cara_pembayaran' => 'required|string|max:50'
        ]);

        if ($validator->fails()) {
            return response(['status'=>false, 'message'=>$validator->errors()->all()], 400);
        }
        
        return $next($request);
    }
}
