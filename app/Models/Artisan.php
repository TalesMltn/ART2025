<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property-read \App\Models\User $user
 */
class Artisan extends Model
{
    protected $fillable = [
        'user_id', 'shop_name', 'bio', 'address', 'bank_details'
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
     * Relación con los proyectos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Project>
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'artisan_id');
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
        // Convierte los parámetros a la forma ?, ?, ?
        $placeholders = implode(',', array_fill(0, count($params), '?'));

        // Ejecuta el procedimiento almacenado
        return DB::select("CALL {$procedureName}($placeholders)", $params);
    }
}
