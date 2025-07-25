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
        Schema::create('etablissements', function (Blueprint $table) {
            $table->id(); // auto-increment ID
            $table->string('raison_sociale');
            
            $table->foreignId('provenance_id')
                  ->constrained('provenances')
                  ->onDelete('cascade');

            $table->softDeletes(); // Pour suppression logique
            $table->timestamps();  // created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etablissements');
    }
};