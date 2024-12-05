<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Validator;
use Closure;

class TenderDetailMiddleware
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
            'id_tender' => 'required|integer',
            'id_metode_pengadaan' => 'required|integer',
            'id_metode_dokumen' => 'required|integer',
            'id_metode_kualifikasi' => 'required|integer',
            'id_metode_evaluasi' => 'required|integer',
            'id_cara_pembayaran' => 'required|integer',
            'syarat_kualifikasi' => 'string',
            'keterangan' => 'string',
            'id_kebutuhan' => 'integer',
        ]);

        if ($validator->fails()) {
            return response(['status'=>false, 'message'=>$validator->errors()->all()], 400);
        }
        
        return $next($request);
    }
}
