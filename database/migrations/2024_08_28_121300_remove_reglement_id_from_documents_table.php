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
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['reglement_id']); // Supprime la clé étrangère si elle existe
            $table->dropColumn('reglement_id'); // Supprime la colonne reglement_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->foreignId('reglement_id')->constrained()->onDelete('cascade'); // Ajoute la colonne reglement_id en cas de rollback
        });
    }
};
