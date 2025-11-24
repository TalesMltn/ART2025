<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // FORZAMOS el cambio del ENUM, aunque la columna ya exista
        Schema::table('projects', function (Blueprint $table) {
            $table->enum('status', ['open', 'pending', 'active', 'completed', 'cancelled'])
                  ->default('open')
                  ->change();
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->enum('status', ['pending', 'active', 'completed', 'cancelled'])
                  ->default('pending')
                  ->change();
        });
    }
};