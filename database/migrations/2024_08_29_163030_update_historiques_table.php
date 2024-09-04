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
        Schema::table('historiques', function (Blueprint $table) {
            $table->foreignId('demande_id')->constrained()->onDelete('cascade');
            $table->string('status');
            $table->text('commentaire')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historiques', function (Blueprint $table) {
            $table->dropForeign(['demande_id']);
            $table->dropColumn('demande_id');
            $table->dropColumn('status');
            $table->dropColumn('commentaire');
        });
    }
};
