<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Lumen\Auth\Authorizable;

/**
 * @property int $id
 * @property string $nama_cara_pembayaran
 * @property string $created_at
 * @property string $updated_at
 * @property TenderDetail[] $tenderDetails
 */
class TenderCaraPembayaran extends Model
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
    
    protected $table = 'tender_cara_pembayaran';

    /**
     * @var array
     */
    protected $fillable = ['nama_cara_pembayaran', 'created_at', 'updated_at'];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tenderDetails()
    {
        return $this->hasMany('App\Models\TenderDetail', 'id_cara_pembayaran');
    }
}
