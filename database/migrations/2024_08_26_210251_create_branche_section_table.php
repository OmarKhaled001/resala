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
        Schema::create('branche_section', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->nullable()
            ->references('id')
            ->on('sections')
            ->onDelete('set null');
            $table->foreignId('branche_id')->nullable()
            ->references('id')
            ->on('branches')
            ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branche_section');
    }
};
