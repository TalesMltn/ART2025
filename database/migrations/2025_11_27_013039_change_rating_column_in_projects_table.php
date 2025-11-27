<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // PASO 1: Poner 0 a todos los NULL (para que no falle)
        DB::statement('UPDATE projects SET rating = 0 WHERE rating IS NULL');

        // PASO 2: Ahora sí cambiar la columna a NOT NULL con default 0
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedTinyInteger('rating')->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedTinyInteger('rating')->nullable()->default(null)->change();
        });
    }
};