<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // app/Models/Project.php

// app/Models/Project.php

    protected $fillable = [
        'client_id',
        'artisan_id',
        'title',
        'description',
        'price',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function artisan()
    {
        return $this->belongsTo(Artisan::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}