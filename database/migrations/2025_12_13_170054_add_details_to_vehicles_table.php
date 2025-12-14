<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('plate')->nullable();
            $table->date('first_registration')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('color')->nullable();
            $table->integer('seats')->nullable();
            $table->boolean('smoker_allowed')->default(false);
            $table->boolean('pets_allowed')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn([
                'plate',
                'first_registration',
                'brand',
                'model',
                'color',
                'seats',
                'smoker_allowed',
                'pets_allowed',
            ]);
        });
    }
};
