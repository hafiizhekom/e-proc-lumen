<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Validator;
use Closure;

class BidTenderTahapMiddleware
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
            'id_tender'=> 'required|integer',
            'id_tahap'=> 'required|integer',
            'waktu_mulai'=> 'required|date|after:tomorrow',
            'waktu_selesai'=> 'required|date|after:waktu_mulai'
        ]);

        if ($validator->fails()) {
            return response(['status'=>false, 'message'=>$validator->errors()->all()], 400);
        }
        
        return $next($request);
    }
}
