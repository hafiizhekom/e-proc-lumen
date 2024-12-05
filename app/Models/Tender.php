<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Lumen\Auth\Authorizable;


/**
 * @property int $id
 * @property int $id_tahap
 * @property int $id_kualifikasi_usaha
 * @property string $nama_tender
 * @property string $lokasi
 * @property int $nilai_pagu
 * @property int $nilai_hps
 * @property string $created_at
 * @property string $updated_at
 * @property TenderKualifikasi $tenderKualifikasi
 * @property TenderTahap $tenderTahap
 * @property BidTenderTahap[] $bidTenderTahaps
 * @property BidTenderVendor[] $bidTenderVendors
 * @property TenderDetail[] $tenderDetails
 */
class Tender extends Model
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

    protected $table = 'tender';

    /**
     * @var array
     */
    protected $fillable = ['id_tahap', 'id_kategori', 'id_kualifikasi_usaha', 'nama_tender', 'lokasi', 'id_tipe', 'nilai_pagu', 'nilai_hps', 'created_at', 'updated_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    protected $connection = 'mysql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenderKualifikasi()
    {
        return $this->belongsTo('App\Models\TenderKualifikasi', 'id_kualifikasi_usaha');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenderTahap()
    {
        return $this->belongsTo('App\Models\TenderTahap', 'id_tahap');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bidTenderTahaps()
    {
        return $this->hasMany('App\Models\BidTenderTahap', 'id_tender');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bidTenderVendors()
    {
        return $this->hasMany('App\Models\BidTenderVendor', 'id_tender');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tenderDetails()
    {
        return $this->hasMany('App\Models\TenderDetail', 'id_tender');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendorKategori()
    {
        return $this->belongsTo('App\Models\VendorKategori', 'id_kategori');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendorTipe()
    {
        return $this->belongsTo('App\Models\VendorTipe', 'id_kategori');
    }
}
