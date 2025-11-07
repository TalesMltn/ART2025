<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            
            // Cliente que publica el proyecto (OBLIGATORIO)
            $table->foreignId('client_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Artesano asignado (puede no tener aún)
            $table->foreignId('artisan_id')
                  ->nullable()
                  ->constrained('artisans')
                  ->onDelete('set null');

            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2)->nullable(); // Precio acordado
            $table->enum('status', ['pending', 'active', 'completed', 'cancelled'])
                  ->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};