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
        Schema::create('courrier_arrives', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->date('date_reception')->automatic();
            $table->text('annotation');
            $table->date('date_envoi');
             $table->string('matricule');
            $table->foreign('matricule')->references('matricule')->on('personnes')->onDelete('cascade');
            $table->unsignedBigInteger('objet_id');
            $table->foreign('objet_id')->references('id')->on('objets');
            $table->unsignedBigInteger('etat_id');
            $table->foreign('etat_id')->references('id')->on('etats')->onDelete('cascade');
            $table->unsignedBigInteger('departement_id');
            $table->foreign('departement_id')->references('id')->on('departements');
            $table->unsignedBigInteger('reponse_id')->nullable();
            $table->foreign('reponse_id')->references('id')->on('reponses')->onDelete('CASCADE');
            $table->unsignedBigInteger('provenance_id');
            $table->foreign('provenance_id')->references('id')->on('provenances')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courrier_arrives');
    }
};
