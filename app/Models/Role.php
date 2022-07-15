<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'role_name',
        'role_description',
    ];
    
    protected $attributes = [
        'role_name' => '',
        'role_description' => '',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function scopeSearch($query, $search)
    {
        $search = trim($search);
        $query->when(!empty($search), function ($query) use ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('role_name', 'like', "%{$search}%")
                ->orWhereHas('user', function ($query) use ($search) {
                   $query->search($search);
                });
            });
        });
    }
}
