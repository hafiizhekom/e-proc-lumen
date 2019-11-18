<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Lumen\Auth\Authorizable;

/**
 * @property int $id
 * @property int $id_vendor
 * @property string $nib
 * @property string $akta_perusahaan
 * @property string $npwp_perusahaan
 * @property string $siup
 * @property string $tdp
 * @property string $created_at
 * @property string $updated_at
 * @property Vendor $vendor
 */
class VendorDetail extends Model
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
    
    
    protected $table = 'vendor_detail';

    /**
     * @var array
     */
    protected $fillable = ['id_vendor', 'nib', 'akta_perusahaan', 'npwp_perusahaan', 'siup', 'tdp', 'created_at', 'updated_at'];

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
    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'id_vendor');
    }
}
