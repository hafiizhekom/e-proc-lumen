<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class Controller extends BaseController
{
    protected function jwt($user) {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id."-".$user->nama_lengkap."-".$user->email, // Subject of the token
            'iat' => time(), // Time when JWT was issued. 
            'exp' => time() + 60*60*8 // Expiration time
        ];
        
        // As you can see we are passing `JWT_SECRET` as the second parameter that will 
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    } 

    protected function uploadDokumenVendor($request, $dokumen, $dokumenAdditional=FALSE){
        if ($this->request->hasFile($dokumen)) {
            if ($this->request->file($dokumen)->isValid()) {
            $ekstensionFile = last(explode(".",$this->request->file($dokumen)->getClientOriginalName()));
            $encryptedName =  md5($dokumen."-".$this->request->id_vendor);
            $nameFile = $encryptedName.".".$ekstensionFile;

            if($dokumenAdditional){
                $pathFile = 'public' . DIRECTORY_SEPARATOR. 'storage' . DIRECTORY_SEPARATOR. 'uploads' . DIRECTORY_SEPARATOR . 'user_files' . DIRECTORY_SEPARATOR . "additional" . DIRECTORY_SEPARATOR;
            }else{
                $pathFile = 'public' . DIRECTORY_SEPARATOR. 'storage' . DIRECTORY_SEPARATOR. 'uploads' . DIRECTORY_SEPARATOR . 'user_files' . DIRECTORY_SEPARATOR . $dokumen . DIRECTORY_SEPARATOR;
            }
            
            $destinationpathFile = base_path($pathFile);
            if($this->request->file($dokumen)->move($destinationpathFile, $nameFile)){
                return $nameFile;
            }
            }
        }

        return false;
    }
}
