<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne; // ← ESTE IMPORT ES CLAVE
use Illuminate\Support\Facades\DB;

class Project extends Model
{
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

    /**
     * Relación con el artesano
     */
    public function artisan()
    {
        return $this->belongsTo(Artisan::class);
    }

    /**
     * Relación con el cliente
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relación con los mensajes del proyecto
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * RELACIÓN NUEVA: La valoración que recibió este proyecto
     * Un proyecto → solo tiene una valoración (hasOne)
     */
    public function rating(): HasOne
    {
        return $this->hasOne(Rating::class, 'project_id');
    }

    /**
     * Ejecuta un procedimiento almacenado en la base de datos.
     */
    public static function callProcedure(string $procedureName, array $params = []): array
    {
        $placeholders = implode(',', array_fill(0, count($params), '?'));
        return DB::select("CALL {$procedureName}($placeholders)", $params);
    }
}