<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('departure');
            $table->string('arrival');
            $table->date('date');

            // Informations minimalistes du chauffeur
            $table->string('driver_name');

            // Prix et nombre de places
            $table->decimal('price', 5, 2);
            $table->integer('seats');

            // Type du véhicule (électrique / thermique)
            $table->string('vehicle_type')->default('electrique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
