<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Tender;
use App\Models\Vendor;
use App\Models\TenderTahap;
use App\Models\BidTenderTahap;
use App\Models\BidTenderVendor;


class TenderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    { 
        app()->path();
        app('path');
        $this->request = $request;
    
    }

    // $data = BidTenderVendor::with('tender')->where('id_tender',2)
    // ->with('vendor')
    // ->with('bidTenderTahap')->get();

    public function show(){
        $data = Tender::
        with('tenderKualifikasi')
        ->with('vendorKategori')
        ->with('vendorTipe')
        ->with('tenderTahap')
        ->with('tenderKualifikasi')
        ->get();
        if($data){
            return response()->json(['status'=>true, 'data'=>$data]);
        }else{
            return response()->json(['status'=>true, 'message'=>"Can not find data", 'data'=>[]], 200);
        }
    }

    public function showByUser($id_user){
        $vendor = Vendor::where('id_pemilik', $id_user)->first();
        if($vendor){
            $bid = BidTenderVendor::where('id_vendor', $vendor->id)->first();    
            if($bid){
                $data = Tender::
                with('tenderKualifikasi')
                ->with('vendorKategori')
                ->with('vendorTipe')
                ->with('tenderTahap')
                ->with('tenderKualifikasi')
                ->where('id', $bid->id_tender)->get();

                if($data){
                    return response()->json(['status'=>true, 'data'=>$data]);
                }
            }
        }
        
        return response()->json(['status'=>true, 'message'=>"Can not find data", 'data'=>[]], 200);
        
    }

    public function showByID($id){
        $data = Tender::where('id', $id)
        ->with('tenderDetails.tenderCaraPembayaran')
        ->with('tenderDetails.tenderMetodePengadaan')
        ->with('tenderDetails.tenderMetodeDokumen')
        ->with('tenderDetails.tenderMetodeKualifikasi')
        ->with('tenderDetails.tenderMetodeEvaluasi')
        ->with('tenderDetails.tenderKebutuhan.tenderKebutuhanBarang')
        ->with('tenderDetails.tenderKebutuhan.tenderKebutuhanSatuan')
        ->with('vendorKategori')
        ->with('vendorTipe')
        ->with('tenderTahap')
        ->with('tenderKualifikasi')
        ->first();

        $tahap = BidTenderTahap::where('id_tahap', $data->id_tahap)->where('id_tender', $data->id)->first();
        if($tahap){
            $data->bid_tender_tahap = $tahap;
        }else{
            $data->bid_tender_tahap = null;
        }
        

        $firstTahap = TenderTahap::where('urutan', 1)->first();
        if($firstTahap){
            $tahap = BidTenderTahap::where('id_tahap', $firstTahap->id)->where('id_tender', $data->id)->first();
            $data->deadline = $tahap->waktu_selesai;
        }else{
            $data->deadline = null;
        }
        
        
        if($data){
            return response()->json(['status'=>true, 'data'=>$data]);
        }else{
            return response()->json(['status'=>false, 'message'=>"Can not find data"], 200);
        }
    }

    public function store(){
        $data = new Tender;
        $data->id_tahap = $this->request->id_tahap;
        $data->id_kualifikasi_usaha = $this->request->id_kualifikasi_usaha;
        $data->nama_tender = $this->request->nama_tender;
        $data->lokasi = $this->request->lokasi;
        $data->nilai_pagu = $this->request->nilai_pagu;
        $data->nilai_hps = $this->request->nilai_hps;

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
}