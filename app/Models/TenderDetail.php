<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Lumen\Auth\Authorizable;

/**
 * @property int $id
 * @property int $id_tender
 * @property int $id_metode_pengadaan
 * @property int $id_metode_dokumen
 * @property int $id_metode_kualifikasi
 * @property int $id_metode_evaluasi
 * @property int $id_cara_pembayaran
 * @property int $id_kebutuhan
 * @property string $syarat_kualifikasi
 * @property string $keterangan
 * @property string $created_at
 * @property string $updated_at
 * @property TenderCaraPembayaran $tenderCaraPembayaran
 * @property TenderKebutuhan $tenderKebutuhan
 * @property TenderMetodeDokuman $tenderMetodeDokuman
 * @property TenderMetodeEvaluasi $tenderMetodeEvaluasi
 * @property TenderMetodeKualifikasi $tenderMetodeKualifikasi
 * @property TenderMetodePengadaan $tenderMetodePengadaan
 * @property Tender $tender
 */
class TenderDetail extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    use Authenticatable, Authorizable;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    
    protected $table = 'tender_detail';

    /**
     * @var array
     */
    
    protected $fillable = ['id_tender', 'id_metode_pengadaan', 'id_metode_dokumen', 'id_metode_kualifikasi', 'id_metode_evaluasi', 'id_cara_pembayaran', 'syarat_kualifikasi', 'keterangan', 'created_at', 'updated_at'];
    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'mysql';

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenderCaraPembayaran()
    {
        return $this->belongsTo('App\Models\TenderCaraPembayaran', 'id_cara_pembayaran');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenderKebutuhan()
    {
        return $this->hasMany('App\Models\TenderKebutuhan', 'id_tender_detail');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenderMetodeDokumen()
    {
        return $this->belongsTo('App\Models\TenderMetodeDokumen', 'id_metode_dokumen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenderMetodeEvaluasi()
    {
        return $this->belongsTo('App\Models\TenderMetodeEvaluasi', 'id_metode_evaluasi');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenderMetodeKualifikasi()
    {
        return $this->belongsTo('App\Models\TenderMetodeKualifikasi', 'id_metode_kualifikasi');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenderMetodePengadaan()
    {
        return $this->belongsTo('App\Models\TenderMetodePengadaan', 'id_metode_pengadaan');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tender()
    {
        return $this->belongsTo('App\Models\Tender', 'id_tender');
    }


    
}
