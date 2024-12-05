<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Validator;
use Closure;

class VendorDetailMiddleware
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
            'id_vendor' => 'required|integer',
            'nib' => 'required|max:10000|mimes:pdf',
            'akta_perusahaan' => 'required|max:10000|mimes:pdf',
            'npwp_perusahaan' => 'required|max:10000|mimes:pdf',
            'siup' => 'required|max:10000|mimes:pdf',
            'tdp' => 'required|max:10000|mimes:pdf'
        ]);

        if ($validator->fails()) {
            return response(['status'=>false, 'message'=>$validator->errors()->all()], 400);
        }
        
        return $next($request);
    }
}
