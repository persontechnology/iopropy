<?php

namespace iopro;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use iopro\Models\Asociacion;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    

    public function getNombreCompletoAttribute()
    {
        return $this->nombres.' '.$this->apellidos.' '.$this->identificacion;
    }


    public function periodosActivos()
    {
        return $this->belongsToMany(Asociacion::class, 'periodo', 'users_id', 'asociacion_id')
            ->as('aso')
            ->withPivot('id')
            ->wherePivot('estado',true);
    }
}
