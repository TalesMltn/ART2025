<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class Message extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'content'];

    /**
     * Relación con el usuario remitente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\User>
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Relación con el usuario receptor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\User>
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
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
        // Genera los placeholders (?, ?, ?) según los parámetros
        $placeholders = implode(',', array_fill(0, count($params), '?'));

        // Ejecuta el procedimiento almacenado
        return DB::select("CALL {$procedureName}($placeholders)", $params);
    }
}
