<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajout du statut du trajet (US11)
     */
    public function up(): void
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->string('status')->default('planned');
            // planned | started | finished
        });
    }

    /**
     * Rollback
     */
    public function down(): void
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
