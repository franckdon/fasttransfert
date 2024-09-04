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
        Schema::dropIfExists('demandes_historiques');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('demandes_historiques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demande_id')->constrained()->onDelete('cascade');
            $table->string('status');
            $table->text('commentaire')->nullable();
            $table->timestamps();
        });
    }
};
