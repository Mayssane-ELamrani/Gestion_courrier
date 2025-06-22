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
    Schema::create('courriers_departs', function (Blueprint $table) {
        $table->increments('num_ordre_depart');
        $table->string('num_doc');
        $table->date('date_envoi');
        $table->string('destinataire');
        $table->unsignedInteger('reference_arrivee')->nullable();

        $table->timestamps();

        // Foreign key
        $table->foreign('reference_arrivee')->references('num_ordre')->on('courriers_arrivees')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courriers_departs');
    }
};
