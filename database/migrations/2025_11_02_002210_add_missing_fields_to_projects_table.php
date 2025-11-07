<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Añadir client_id
            if (!Schema::hasColumn('projects', 'client_id')) {
                $table->foreignId('client_id')
                      ->after('id')
                      ->constrained('users')
                      ->onDelete('cascade');
            }

            // Añadir title
            if (!Schema::hasColumn('projects', 'title')) {
                $table->string('title')->after('client_id');
            }

            // Añadir description
            if (!Schema::hasColumn('projects', 'description')) {
                $table->text('description')->after('title');
            }

            // Añadir price
            if (!Schema::hasColumn('projects', 'price')) {
                $table->decimal('price', 10, 2)->nullable()->after('description');
            }

            // Añadir status
            if (!Schema::hasColumn('projects', 'status')) {
                $table->enum('status', ['pending', 'active', 'completed', 'cancelled'])
                      ->default('pending')
                      ->after('price');
            }
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['client_id', 'title', 'description', 'price', 'status']);
        });
    }
};