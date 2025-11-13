<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property-read \App\Models\User $user
 */
class Client extends Model
{
    protected $fillable = [
        'user_id', 'address', 'phone'
    ];

    /**
     * Relación con el usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\User>
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
        // Genera los placeholders ?, ?, ? según el número de parámetros
        $placeholders = implode(',', array_fill(0, count($params), '?'));

        // Ejecuta el procedimiento con los parámetros dados
        return DB::select("CALL {$procedureName}($placeholders)", $params);
    }
}
