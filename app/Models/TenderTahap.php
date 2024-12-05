<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Lumen\Auth\Authorizable;


/**
 * @property int $id
 * @property string $nama_tahap
 * @property string $created_at
 * @property string $updated_at
 * @property BidTenderTahap[] $bidTenderTahaps
 * @property Tender[] $tenders
 */
class TenderTahap extends Model
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

    protected $table = 'tender_tahap';

    /**
     * @var array
     */
    protected $fillable = ['nama_tahap', 'created_at', 'updated_at'];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bidTenderTahaps()
    {
        return $this->hasMany('App\Models\BidTenderTahap', 'id_tahap');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tenders()
    {
        return $this->hasMany('App\Models\Tender', 'id_tahap');
    }
}
