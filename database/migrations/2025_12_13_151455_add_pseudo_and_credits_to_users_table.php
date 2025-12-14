<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // SQLite n'accepte pas NOT NULL sans default => on met une valeur temporaire
            $table->string('pseudo')->default('Utilisateur')->after('name');
            $table->integer('credits')->default(20)->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['pseudo', 'credits']);
        });
    }
};
