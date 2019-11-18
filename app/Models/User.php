<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Lumen\Auth\Authorizable;

/**
 * @property int $id
 * @property int $id_jenis_kelamin
 * @property string $nama_lengkap
 * @property string $email
 * @property string $password
 * @property string $tanggal_lahir
 * @property string $no_handphone
 * @property string $alamat
 * @property string $created_at
 * @property string $updated_at
 * @property UserJenisKelamin $userJenisKelamin
 * @property Vendor[] $vendors
 */
class User extends Model
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
    
    
    protected $table = 'user';

    /**
     * @var array
     */
    protected $fillable = ['id_jenis_kelamin', 'nama_lengkap', 'email', 'password', 'tanggal_lahir', 'no_handphone', 'alamat', 'created_at', 'updated_at'];

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
    public function userJenisKelamin()
    {
        return $this->belongsTo('App\Models\UserJenisKelamin', 'id_jenis_kelamin');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendors()
    {
        return $this->hasMany('App\Models\Vendor', 'id_pemilik');
    }
}
