<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read \App\Models\User $user
 */
class Artisan extends Model
{
    protected $fillable = [
        'user_id', 'shop_name', 'bio', 'address', 'bank_details'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\User>
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Project>
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'artisan_id');
    }
}