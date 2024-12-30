<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; //use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable //Model 
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = ['firstname', 'lastname', 'email', 'password', 'sector_id', 'role'];

    // protected $hidden = ['password'];
    protected $hidden = ['password', 'remember_token']; // Secure sensitive data

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
    
    /**
     * Relationships
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id', 'id_sector');
    }

    public function materials()
    {
        return $this->hasMany(Material::class, 'user_id', 'id_user');
    }

    public function requests()
    {
        return $this->hasMany(Request::class, 'user_id', 'id_user');
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'user_id', 'id_user');
    }
}
