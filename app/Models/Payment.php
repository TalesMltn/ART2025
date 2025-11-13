<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    protected $fillable = [
        'project_id', 'amount', 'status', 'transaction_id'
    ];

    /**
     * Relación con el proyecto
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Project>
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
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
        // Genera placeholders según los parámetros (?, ?, ?)
        $placeholders = implode(',', array_fill(0, count($params), '?'));

        // Ejecuta el procedimiento almacenado
        return DB::select("CALL {$procedureName}($placeholders)", $params);
    }
}
