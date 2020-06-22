<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'user_id', 'name', 'email', 'payment', 'activation_token', 'active'
    ];

    // Relationships
    public function user()
    {
        return $this->hasOne(User::class);
    }

    // Scopes
    public function scopeOwnedBy($query, $value)
    {
        return $query->where('user_id', $value);
    }
}
