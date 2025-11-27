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
        return $this->belongsTo(User::class);
    }

    /**
     * ←←←←←←←←←←←←←←←← AÑADE ESTO AQUÍ ←←←←←←←←←←←←←←←←
     * Un cliente tiene muchos proyectos
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'client_id');
    }
    // ←←←←←←←←←←←←←←←← FIN ←←←←←←←←←←←←←←←←

    public static function callProcedure(string $procedureName, array $params = []): array
    {
        $placeholders = implode(',', array_fill(0, count($params), '?'));
        return DB::select("CALL {$procedureName}($placeholders)", $params);
    }
}