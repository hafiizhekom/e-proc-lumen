<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Http\Controllers\Controller;

use App\Models\Vendor;
use App\Models\VendorDetail;
use App\Models\VendorDokumen;
use App\Models\VendorTipe;
use App\Models\VendorKategori;



class VendorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request){ 
        app()->path();
        app('path');
        $this->request = $request;
    
    }

    

    public function show(){
        $data = Vendor::with('vendorTipe')->with('user:id,nama_lengkap')->with('vendorKategori')->get();
        return response()->json(['status'=>true, 'data'=>$data]);
    }

    public function showByPemilik($id_pemilik){
        $data = Vendor::where('id_pemilik', $id_pemilik)
        ->with('vendorTipe')
        ->with('vendorKategori')
        ->first();
        
        $dataDetails = VendorDetail::where('id_vendor', $data->id)->first();
        $dataDetails->nib = url('storage/uploads/user_files/nib/'.$dataDetails->nib);
        $dataDetails->akta_perusahaan = url('storage/uploads/user_files/akta_perusahaan/'.$dataDetails->akta_perusahaan);
        $dataDetails->npwp_perusahaan = url('storage/uploads/user_files/npwp_perusahaan/'.$dataDetails->npwp_perusahaan);
        $dataDetails->siup = url('storage/uploads/user_files/siup/'.$dataDetails->siup);
        $dataDetails->tdp = url('storage/uploads/user_files/tdp/'.$dataDetails->tdp);
        $data->vendor_details = $dataDetails;

        $dataDokumens = VendorDokumen::where('id_vendor', $data->id)->get();
        foreach ($dataDokumens as $key => $value) {
            $value->file_dokumen = url('storage/uploads/user_files/additional/'.$value->file_dokumen);
        }
        $data->vendor_dokumens = $dataDokumens;


        if($data){
            
            return response()->json(['status'=>true, 'data'=>$data]);
        }else{
            return response()->json(['status'=>false, 'message'=>"Can not find data"], 200);
        }
    }

    public function showByID($id){
        $data = Vendor::where('id', $id)
        ->with('vendorTipe')
        ->with('vendorKategori')
        ->first();

        $dataDetails = VendorDetail::where('id_vendor', $data->id)->first();
        $dataDetails->nib = url('storage/uploads/user_files/nib/'.$dataDetails->nib);
        $dataDetails->akta_perusahaan = url('storage/uploads/user_files/akta_perusahaan/'.$dataDetails->akta_perusahaan);
        $dataDetails->npwp_perusahaan = url('storage/uploads/user_files/npwp_perusahaan/'.$dataDetails->npwp_perusahaan);
        $dataDetails->siup = url('storage/uploads/user_files/siup/'.$dataDetails->siup);
        $dataDetails->tdp = url('storage/uploads/user_files/tdp/'.$dataDetails->tdp);
        $data->vendor_details = $dataDetails;

        $dataDokumens = VendorDokumen::where('id_vendor', $data->id)->get();
        foreach ($dataDokumens as $key => $value) {
            $value->file_dokumen = url('storage/uploads/user_files/additional/'.$value->file_dokumen);
        }
        $data->vendor_dokumens = $dataDokumens;


        if($data){
            return response()->json(['status'=>true, 'data'=>$data]);
        }else{
            return response()->json(['status'=>false, 'message'=>"Can not find data"], 200);
        }
    }

    public function store(){
        
        $data = new Vendor;
        $data->nama_perusahaan = $this->request->nama_perusahaan;
        $data->alamat = $this->request->alamat;
        $data->telepon = $this->request->telepon;
        if($this->request->fax){
            $data->fax = $this->request->fax;
        }
        $data->id_kategori = $this->request->id_kategori;
        $data->id_tipe = $this->request->id_tipe;
        $data->id_pemilik = $this->request->id_pemilik;

        if($data->save()){
            return response()->json(['status'=>true, 'message'=>"Success Add Vendor",'data'=>['id' => $data->id]], 200);
        }else{
            return response()->json(['status'=>false, 'message'=>"Fail Add Vendor"], 200);
        }
    }

    public function storeDetail(){
        

        $data = new VendorDetail;
        $data->id_vendor = $this->request->id_vendor;

        if($nameFile = $this->uploadDokumenVendor($this->request, 'nib')){  
            $data->nib = $nameFile;
        }
        
        if($nameFile = $this->uploadDokumenVendor($this->request, 'akta_perusahaan')){  
            $data->akta_perusahaan = $nameFile;
        }

        if($nameFile = $this->uploadDokumenVendor($this->request, 'npwp_perusahaan')){  
            $data->npwp_perusahaan = $nameFile;
        }

        if($nameFile = $this->uploadDokumenVendor($this->request, 'siup')){  
            $data->siup = $nameFile;
        }

        if($nameFile = $this->uploadDokumenVendor($this->request, 'tdp')){  
            $data->tdp = $nameFile;
        }
        
        if($data->save()){
            return response()->json(
                [
                    'status'=>true, 
                    'message'=>"Success Add Vendor Detail", 
                    'data'=>[
                        'id' => $data->id
                        ]
                    ], 
                    200
                );
        }else{
            return response()->json(['status'=>false, 'message'=>"Fail Add Vendor Detail"], 200);
        }
    }

    public function storeDokumen(){
        

        $data = new VendorDokumen;
        $data->id_vendor = $this->request->id_vendor;
        $data->nama_dokumen = $this->request->nama_dokumen;

        if($nameFile = $this->uploadDokumenVendor($this->request, "file_dokumen", true)){  
            $data->file_dokumen = $nameFile;
        }
        
        if($data->save()){
            return response()->json(
                [
                    'status'=>true, 
                    'message'=>"Success Add Vendor Dokumen", 
                    'data'=>[
                        'id' => $data->id
                        ]
                    ], 
                    200
                );
        }else{
            return response()->json(['status'=>false, 'message'=>"Fail Add Vendor Dokumen"], 200);
        }
    }

    public function showDokumenByID($id){
        $data = VendorDokumen::where('id', $id)
        ->with('vendor')
        ->first();

        if($data){
            return response()->json(['status'=>true, 'data'=>$data]);
        }else{
            return response()->json(['status'=>false, 'message'=>"Can not find data"], 200);
        }
    }

    public function showKategori(){
        $data = VendorKategori::get();
        if($data){
            return response()->json(['status'=>true, 'data'=>$data]);
        }else{
            return response()->json(['status'=>false, 'message'=>"Can not find data"], 200);
        }
    }

    public function showKategoriByID($id){
        $data = VendorKategori::where('id', $id)
        ->first();

        if($data){
            return response()->json(['status'=>true, 'data'=>$data]);
        }else{
            return response()->json(['status'=>false, 'message'=>"Can not find data"], 200);
        }
    }

    public function storeKategori(){
        $data = new VendorKategori;
        $data->nama_kategori = $this->request->nama_kategori;
        
        if($data->save()){
            return response()->json(
                [
                    'status'=>true, 
                    'message'=>"Success Add Vendor Kategori", 
                    'data'=>[
                        'id' => $data->id
                        ]
                    ], 
                    200
                );
        }else{
            return response()->json(['status'=>false, 'message'=>"Fail Add Vendor Kategori"], 200);
        }
    }

    public function showTipe(){
        $data = VendorTipe::get();
        if($data){
            return response()->json(['status'=>true, 'data'=>$data]);
        }else{
            return response()->json(['status'=>false, 'message'=>"Can not find data"], 200);
        }
    }

    public function showTipeByID($id){
        $data = VendorTipe::where('id', $id)
        ->first();

        if($data){
            return response()->json(['status'=>true, 'data'=>$data]);
        }else{
            return response()->json(['status'=>false, 'message'=>"Can not find data"], 200);
        }
    }

    public function storeTipe(){
        $data = new VendorTipe;
        $data->nama_tipe = $this->request->nama_tipe;
        
        if($data->save()){
            return response()->json(
                [
                    'status'=>true, 
                    'message'=>"Success Add Vendor Tipe", 
                    'data'=>[
                        'id' => $data->id
                        ]
                    ], 
                    200
                );
        }else{
            return response()->json(['status'=>false, 'message'=>"Fail Add Vendor Tipe"], 200);
        }
    }
}

