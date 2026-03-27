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
    Schema::table('notes', function (Blueprint $table) {

        // Type de note
        $table->enum('type', [
            'interrogation',
            'devoir_classe',
            'devoir_niveau'
        ])->nullable();

        // Note sur combien
        $table->integer('note_sur')->nullable();

        // Coefficient
        $table->decimal('coefficient', 3, 2)->nullable();
    });
}

public function down(): void
{
    Schema::table('notes', function (Blueprint $table) {
        $table->dropColumn(['type', 'note_sur', 'coefficient']);
    });
}
};
