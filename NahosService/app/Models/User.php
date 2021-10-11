<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Location;
use App\Models\Permission;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'pieceIdentite',
        'noPieceIdentite',
        'telephone1',
        // 'telephone2',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function perimissions()
    {
        return $this->belongsToMany(Permission::class,"user_permission","user_id","permission_id");
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, "user_role", "user_id", "role_id");
    }

    public function hasRole($role)
    {
        return $this->roles()->where("nomRole",$role)->first() !== null;
    }

    public function hasAnyRoles($roles)
    {
        return $this->roles()->whereIn("nomRole",$roles)->first() !== null;
    }

    public function getAllRoleNamesAttribute()
    {
        return $this->roles->implode("nomRole", " | ");
    }
}
