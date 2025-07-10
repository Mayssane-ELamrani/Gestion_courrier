<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('courrier_arrives', function (Blueprint $table) {
            $table->id();

            $table->string('reference')->unique();
            $table->date('date_reception');
            $table->text('annotation')->nullable();
            $table->string('reference_courrierDepart')->nullable();

            $table->date('date_envoi')->nullable();
            
            $table->unsignedBigInteger('matricule'); // référence à personne
            $table->unsignedBigInteger('objet_id');
            $table->text('description_objet')->nullable();
            $table->unsignedBigInteger('etat_id');
            $table->unsignedBigInteger('departement_id');
            $table->unsignedBigInteger('provenance_id');
            $table->unsignedBigInteger('reponse_id')->nullable();

            // Nouveaux champs spécifiques à la provenance
            $table->string('agent_nom')->nullable();
            $table->string('agent_prenom')->nullable();
            $table->string('agent_matricule')->nullable();
            $table->string('etablissement_raison_sociale')->nullable();

            $table->string('type_espace');

            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('matricule')->references('matricule')->on('personnes')->onDelete('cascade');
            $table->foreign('objet_id')->references('id')->on('objets');
            $table->foreign('etat_id')->references('id')->on('etats')->onDelete('cascade');
            $table->foreign('departement_id')->references('id')->on('departements');
            $table->foreign('reponse_id')->references('id')->on('reponses')->onDelete('set null');
            $table->foreign('provenance_id')->references('id')->on('provenances')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courrier_arrives');
    }
};
