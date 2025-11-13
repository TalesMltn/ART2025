<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Artisan>
     */
    public function artisan()
    {
        return $this->belongsTo(Artisan::class);
    }

    /**
     * Relación con el cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Client>
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relación con los mensajes del proyecto
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Message>
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Ejecuta un procedimiento almacenado en la base de datos.
     *
     * @param string $procedureName
     * @param array $params
     * @return array
     */
    public static function callProcedure(string $procedureName, array $params = []): array
    {
        // Genera los placeholders (?, ?, ?) según la cantidad de parámetros
        $placeholders = implode(',', array_fill(0, count($params), '?'));

        // Ejecuta el procedimiento almacenado
        return DB::select("CALL {$procedureName}($placeholders)", $params);
    }
}
