<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->unique()->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('artisan_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('score')->check('score BETWEEN 1 AND 5');
            $table->text('comment')->nullable();
            $table->timestamps();
    
            // YA NO PONGAS ESTO → está duplicado
            // $table->unique('project_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};