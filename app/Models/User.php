<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property-read \App\Models\Artisan|null $artisan
 * @property-read \App\Models\Client|null $client
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // =====================
    // MÉTODOS DE ROL
    // =====================
    public function isAdmin(): bool   { return $this->role === 'admin'; }
    public function isArtisan(): bool { return $this->role === 'artisan'; }
    public function isClient(): bool  { return $this->role === 'client'; }

    // =====================
    // RELACIONES
    // =====================
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<\App\Models\Artisan>
     */
    public function artisan()
    {
        return $this->hasOne(Artisan::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<\App\Models\Client>
     */
    public function client()
    {
        return $this->hasOne(Client::class, 'user_id');
    }
}