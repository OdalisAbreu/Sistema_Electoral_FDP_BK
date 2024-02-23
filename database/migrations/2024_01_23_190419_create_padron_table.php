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
        Schema::create('padron', function (Blueprint $table) {
            $table->id();
            $table->string('card_id')->unique();
            $table->string('name');
            $table->string('lastname');
            $table->string('phone')->nullable();
            $table->string('concurrencia')->nullable();
            $table->string('fp')->nullable();
            $table->unsignedBigInteger('municipio_id');
            $table->unsignedBigInteger('distrito_id');
            $table->string('mesa');
            $table->string('indice')->nullable();
            $table->integer('voto')->default(0);
            $table->text('apodo')->nullable();
            $table->text('image')->nullable();
            $table->timestamps();

            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->foreign('distrito_id')->references('id')->on('distritos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('padron');
    }
};
