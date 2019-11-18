<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Validator;
use Closure;

class TenderMiddleware
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
            'nama_tender' => 'required|string|max:100',
            'lokasi'=>'required|string|max:50',
            'id_tahap'=> 'required|integer',
            'nilai_pagu'=> 'required|integer',
            'nilai_hps'=> 'required|integer',
            'id_kualifikasi_usaha'=> 'required|integer',
        ]);

        if ($validator->fails()) {
            return response(['status'=>false, 'message'=>$validator->errors()->all()], 400);
        }
        
        return $next($request);
    }
}
