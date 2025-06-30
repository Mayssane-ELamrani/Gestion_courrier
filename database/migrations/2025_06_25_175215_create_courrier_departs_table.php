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
            $table->string('reference_courrierArrive')->nullable();
            $table->unsignedBigInteger('objet_id')->nullable();
            $table->text('description_objet')->nullable();
            $table->unsignedBigInteger('etat_id');
            $table->unsignedBigInteger('departement_source_id');
            $table->unsignedBigInteger('matricule');
            $table->enum('type_espace', ['cmss', 'cmcas']);  
            $table->timestamps();
            $table->softDeletes();

            // Clés étrangères
            $table->foreign('objet_id')->references('id')->on('objets');
            $table->foreign('etat_id')->references('id')->on('etats');
            $table->foreign('departement_source_id')->references('id')->on('departements');
            $table->foreign('matricule')->references('matricule')->on('personnes')->onDelete('cascade');  // <-- clé étrangère matricule
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
