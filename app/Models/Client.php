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
     */
    public function user()
    {
        return $this->belongsTo(User::class); // ← SOLO ESTA LÍNEA
        // Si quieres ser explícito, también puedes poner:
        // return $this->belongsTo(User::class, 'user_id');
    }

    public static function callProcedure(string $procedureName, array $params = []): array
    {
        $placeholders = implode(',', array_fill(0, count($params), '?'));
        return DB::select("CALL {$procedureName}($placeholders)", $params);
    }
}