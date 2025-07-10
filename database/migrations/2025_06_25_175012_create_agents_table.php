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
            $table->id(); // auto-increment ID, mieux que unsignedBigInteger + primary
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->string('matricule')->unique();

            $table->foreignId('provenance_id')
                  ->constrained('provenances')
                  ->onDelete('cascade');

            $table->softDeletes(); // Ajoute deleted_at
            $table->timestamps();  // created_at et updated_at
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