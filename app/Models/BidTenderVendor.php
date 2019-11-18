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
 * @property int $id_bid_tahap
 * @property int $id_vendor
 * @property string $created_at
 * @property string $updated_at
 * @property BidTenderTahap $bidTenderTahap
 * @property Tender $tender
 * @property Vendor $vendor
 */
class BidTenderVendor extends Model
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

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $table = 'bid_tender_vendor';

    /**
     * @var array
     */
    protected $fillable = ['id_tender', 'id_bid_tahap', 'id_vendor', 'created_at', 'updated_at'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bidTenderTahap()
    {
        return $this->belongsTo('App\Models\BidTenderTahap', 'id_bid_tahap');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tender()
    {
        return $this->belongsTo('App\Models\Tender', 'id_tender');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'id_vendor');
    }
}
