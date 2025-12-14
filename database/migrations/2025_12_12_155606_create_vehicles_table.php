<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id'); 

            // Informations obligatoires US8
            $table->string('plate');                    // Plaque d’immatriculation
            $table->date('first_registration');         // Date première immatriculation
            $table->string('brand');                    // Marque
            $table->string('model');                    // Modèle
            $table->string('color');                    // Couleur
            $table->integer('seats');                   // Nombre de places

            // Préférences
            $table->boolean('smoker_allowed')->default(false);
            $table->boolean('pets_allowed')->default(false);

            $table->timestamps();

            // Relation utilisateur → véhicules
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
