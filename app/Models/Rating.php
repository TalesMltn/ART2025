<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Rating extends Model
{
    protected $fillable = [
        'project_id',
        'user_id',
        'artisan_id',
        'score',
        'comment'
    ];

    protected $casts = [
        'score' => 'integer',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function artisan(): BelongsTo
    {
        return $this->belongsTo(Artisan::class);
    }

    // ←←← AQUÍ AGREGAS EL MÉTODO SIN MIEDO ←←←
    public static function callProcedure(string $procedureName, array $params = [])
    {
        $placeholders = $params ? implode(',', array_fill(0, count($params), '?')) : '';
        $query = "CALL {$procedureName}({$placeholders})";

        return DB::select($query, $params);
    }
}