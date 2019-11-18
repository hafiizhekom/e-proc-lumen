<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Validator;
use Closure;

class VendorMiddleware
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
            'nama_perusahaan' => 'required|string|max:100',
            'alamat' => 'required|string|max:100',
            'telepon'=>'required|string|regex:/[0-9]/|max:15',
            'fax'=>'string|regex:/[0-9]/|max:15',
            'id_kategori'=>'required|integer',
            'id_tipe'=>'required|integer',
            'id_pemilik'=>'required|integer'

        ]);

        if ($validator->fails()) {
            return response(['status'=>false, 'message'=>$validator->errors()->all()], 400);
        }
        
        return $next($request);
    }
}
