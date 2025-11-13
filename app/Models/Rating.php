<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rating extends Model
{
    protected $fillable = [
        'user_id', 'project_id', 'artisan_id', 'score', 'comment'
    ];

    /**
     * Relación con el usuario que realiza la calificación
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\User>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con el proyecto calificado
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Project>
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Relación con el artesano calificado
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Artisan>
     */
    public function artisan()
    {
        return $this->belongsTo(Artisan::class);
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
        // Generar los placeholders según la cantidad de parámetros (?, ?, ?)
        $placeholders = implode(',', array_fill(0, count($params), '?'));

        // Ejecutar el procedimiento almacenado
        return DB::select("CALL {$procedureName}($placeholders)", $params);
    }
}
