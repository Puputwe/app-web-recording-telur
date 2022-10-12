<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password','status', 'role_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function recording(){
        return $this->hasMany(Recording::class);
    }

    public function produksi(){
        return $this->hasMany(Produksi::class);
    }
}

