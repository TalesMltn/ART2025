<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContactMessage extends Model
{
    protected $fillable = [
        'name', 'email', 'message', 'read'
    ];

    protected $casts = [
        'read' => 'boolean',
    ];

    /**
     * Marcar el mensaje como leído.
     *
     * @return void
     */
    public function markAsRead()
    {
        $this->update(['read' => true]);
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
        // Generar placeholders según la cantidad de parámetros (?, ?, ?)
        $placeholders = implode(',', array_fill(0, count($params), '?'));

        // Ejecutar el procedimiento
        return DB::select("CALL {$procedureName}($placeholders)", $params);
    }
}
