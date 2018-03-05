<?php namespace App\Model;

use Artesaos\Defender\Traits\HasDefender;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasDefender, SoftDeletes, Notifiable;
    
    CONST superuser = 1;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dateFormat = 'Y-m-d H:i:s';
    
    protected $fillable = [
        'name', 'email', 'password', 'picture', 'profissional_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($valor)
    {
        if(!empty($valor))
            $this->attributes['password'] = $valor;
    }

    public function roleUser()
    {
        return $this->belongsToMany('App\Model\Role');
    }

    public function role()
    {
        return $this->belongsToMany('App\Model\Role');
    }

    public function online()
    {
        return $this->hasOne('App\Online', 'user_id');
    }
}
