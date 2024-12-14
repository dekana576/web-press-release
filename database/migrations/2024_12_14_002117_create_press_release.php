<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('press_release', function (Blueprint $table) {
            $table->id();
            $table->string('press_name')->nullable();
            $table->text('description')->nullable();
            $table->string('link_kabarnusa')->nullable();
            $table->string('link_baliportal')->nullable();
            $table->string('link_updatebali')->nullable();
            $table->string('link_pancarpos')->nullable();
            $table->string('link_wartadewata')->nullable();
            $table->string('link_baliexpress')->nullable();
            $table->string('link_fajarbali')->nullable();
            $table->string('link_balitribune')->nullable();
            $table->string('link_radarbali')->nullable();
            $table->string('link_dutabali')->nullable();
            $table->string('link_baliekbis')->nullable();
            $table->string('link_other')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('press_release');
    }
};
