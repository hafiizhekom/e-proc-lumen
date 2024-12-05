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
 * @property int $id_tahap
 * @property int $waktu_mulai
 * @property int $waktu_selesai
 * @property string $created_at
 * @property string $updated_at
 * @property TenderTahap $tenderTahap
 * @property Tender $tender
 * @property BidTenderVendor[] $bidTenderVendors
 */
class BidTenderTahap extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'bid_tender_tahap';

    /**
     * @var array
     */
    protected $fillable = ['id_tender', 'id_tahap', 'waktu_mulai', 'waktu_selesai', 'created_at', 'updated_at'];

    /**
     * The connection name for the model.
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
    
    protected $connection = 'mysql';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenderTahap()
    {
        return $this->belongsTo('App\Models\TenderTahap', 'id_tahap');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tender()
    {
        return $this->belongsTo('App\Models\Tender', 'id_tender');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bidTenderVendors()
    {
        return $this->hasMany('App\Models\BidTenderVendor', 'id_bid_tahap');
    }
}
