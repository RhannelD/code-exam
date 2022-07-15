<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'full_name',
        'email_address',
        'nominated_password',
        'confirmed_password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'nominated_password',
        'confirmed_password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function username()
    {
        return 'email_address';
    }

    public function getAuthPassword()
    {
        return $this->nominated_password;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
    
    public function scopeSearch($query, $search)
    {
        $search = trim($search);
        $query->when(!empty($search), function ($query) use ($search) {
            $query->where('full_name', 'like', "%{$search}%");
        });
    }
}
