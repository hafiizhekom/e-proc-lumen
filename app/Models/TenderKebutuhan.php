<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Lumen\Auth\Authorizable;

/**
 * @property int $id_barang
 * @property int $id_satuan
 * @property int $id
 * @property int $jumlah
 * @property string $created_at
 * @property string $updated_at
 * @property TenderKebutuhanBarang $tenderKebutuhanBarang
 * @property TenderKebutuhanSatuan $tenderKebutuhanSatuan
 * @property TenderDetail[] $tenderDetails
 */
class TenderKebutuhan extends Model
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
    
    
    protected $table = 'tender_kebutuhan';

    /**
     * @var array
     */
    protected $fillable = ['id_barang', 'id_satuan', 'id_detail_tender', 'jumlah', 'created_at', 'updated_at'];

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
    public function tenderKebutuhanBarang()
    {
        return $this->belongsTo('App\Models\TenderKebutuhanBarang', 'id_barang');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenderKebutuhanSatuan()
    {
        return $this->belongsTo('App\Models\TenderKebutuhanSatuan', 'id_satuan');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tenderDetail()
    {
        return $this->belongsTo('App\Models\TenderDetail', 'id_tender_detail');
    }
}
