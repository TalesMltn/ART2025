<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedTinyInteger('rating')
                  ->default(0)
                  ->after('status'); // 0 = sin valorar, 1-5 = valorado

            $table->text('comment')
                  ->nullable()
                  ->after('rating');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['rating', 'comment']);
        });
    }
};