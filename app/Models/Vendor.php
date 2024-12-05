<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Lumen\Auth\Authorizable;


/**
 * @property int $id
 * @property int $id_kategori
 * @property int $id_tipe
 * @property int $id_pemilik
 * @property string $nama_perusahaan
 * @property string $alamat
 * @property string $telepon
 * @property string $fax
 * @property string $created_at
 * @property string $updated_at
 * @property VendorKategori $vendorKategori
 * @property User $user
 * @property VendorTipe $vendorTipe
 * @property BidTenderVendor[] $bidTenderVendors
 * @property VendorDetail[] $vendorDetails
 * @property VendorDokuman[] $vendorDokumens
 */
class Vendor extends Model
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

    protected $table = 'vendor';

    /**
     * @var array
     */
    protected $fillable = ['id_kategori', 'id_tipe', 'id_pemilik', 'nama_perusahaan', 'alamat', 'telepon', 'fax', 'created_at', 'updated_at'];

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
    public function vendorKategori()
    {
        return $this->belongsTo('App\Models\VendorKategori', 'id_kategori');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_pemilik');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendorTipe()
    {
        return $this->belongsTo('App\Models\VendorTipe', 'id_tipe');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bidTenderVendors()
    {
        return $this->hasMany('App\Models\BidTenderVendor', 'id_vendor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendorDetails()
    {
        return $this->hasMany('App\Models\VendorDetail', 'id_vendor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendorDokumens()
    {
        return $this->hasMany('App\Models\VendorDokumen', 'id_vendor');
    }
}
