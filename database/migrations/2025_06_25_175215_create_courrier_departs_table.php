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
        Schema::create('courrier_departs', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->date('date_envoi');
            $table->string('destinataire');
            $table->string('reference-courrierArrive')->nullable();
            $table->unsignedInteger('objet_id')->nullable();
            $table->foreign('objet_id')->references('id')->on('objets');
            $table->unsignedBigInteger('etat_id');
            $table->foreign('etat_id')->references('id')->on('etats');
            $table->unsignedBigInteger('departement_source_id');
            $table->foreign('departement_source_id')->references('id')->on('departements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courrier_departs');
    }
};
