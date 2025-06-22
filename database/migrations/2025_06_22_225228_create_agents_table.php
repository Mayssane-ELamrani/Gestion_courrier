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
       Schema::create('agents', function (Blueprint $table) {
    $table->string('code_provenance')->primary();
    $table->foreign('code_provenance')->references('code_provenance')->on('provenances')->onDelete('cascade');
    $table->string('nom');
    $table->string('prenom');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
