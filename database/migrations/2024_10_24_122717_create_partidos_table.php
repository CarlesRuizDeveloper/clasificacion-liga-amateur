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
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_local_id')->constrained('equipos')->onDelete('cascade');
            $table->foreignId('equipo_visitante_id')->constrained('equipos')->onDelete('cascade');
            $table->integer('jornada'); 
            $table->integer('goles_local')->nullable(); 
            $table->integer('goles_visitante')->nullable();
            $table->integer('pts_fed_local')->nullable();
            $table->integer('pts_fed_visitante')->nullable();
            $table->date('fecha');
            $table->time('hora')->nullable();
            $table->string('estado')->default('Pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
