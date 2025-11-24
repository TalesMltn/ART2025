<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            // 1. client_id
            if (!Schema::hasColumn('projects', 'client_id')) {
                $table->foreignId('client_id')
                      ->after('id')
                      ->constrained('clients')
                      ->onDelete('cascade');
            }

            // 2. artisan_id
            if (!Schema::hasColumn('projects', 'artisan_id')) {
                $table->foreignId('artisan_id')
                      ->nullable()
                      ->after('client_id')
                      ->constrained('artisans')
                      ->onDelete('set null');
            }

            // 3. title, description, price → igual
            if (!Schema::hasColumn('projects', 'title')) {
                $table->string('title')->after('artisan_id');
            }
            if (!Schema::hasColumn('projects', 'description')) {
                $table->text('description')->after('title');
            }
            if (!Schema::hasColumn('projects', 'price')) {
                $table->decimal('price', 10, 2)->nullable()->after('description');
            }

            // CLAVE: Modificar la columna status SIEMPRE (exista o no)
            // Forzamos el cambio del ENUM para incluir 'open' y 'pending'
            $table->enum('status', ['open', 'pending', 'active', 'completed', 'cancelled'])
                  ->default('open')
                  ->after('price')
                  ->change(); // ¡¡ESTO ES OBLIGATORIO!!
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Opcional: volver al ENUM anterior si quieres revertir
            $table->enum('status', ['pending', 'active', 'completed', 'cancelled'])
                  ->default('pending')
                  ->change();

            // O simplemente eliminar las columnas nuevas
            // $table->dropColumn(['client_id', 'artisan_id', 'title', 'description', 'price', 'status']);
        });
    }
};