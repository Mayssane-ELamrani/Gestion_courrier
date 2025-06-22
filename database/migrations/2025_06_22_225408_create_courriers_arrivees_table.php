<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('courriers_arrivees', function (Blueprint $table) {
        $table->increments('num_ordre');
        $table->string('reference');
        $table->date('date_reception');
        $table->text('annotation')->nullable();
        $table->date('date_envoi')->nullable();
        $table->boolean('a_classer')->default(false);

        $table->string('matricule');
        $table->string('code_provenance');
        $table->unsignedInteger('id_dept');
        $table->unsignedInteger('id_objet');
        $table->unsignedInteger('id_etat');
        $table->unsignedInteger('id_reponse')->nullable();

        $table->timestamps();

        // Foreign keys
        $table->foreign('matricule')->references('matricule')->on('personnes')->onDelete('cascade');
        $table->foreign('code_provenance')->references('code_provenance')->on('provenances')->onDelete('cascade');
        $table->foreign('id_dept')->references('id_dept')->on('departements')->onDelete('cascade');
        $table->foreign('id_objet')->references('id_objet')->on('objets')->onDelete('cascade');
        $table->foreign('id_etat')->references('id_etat')->on('etats')->onDelete('cascade');
        $table->foreign('id_reponse')->references('id_reponse')->on('reponses')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courriers_arrivees');
    }
};
