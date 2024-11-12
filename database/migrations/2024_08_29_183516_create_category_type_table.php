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
        Schema::create('category_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')
            ->nullable()
            ->references('id')
            ->on('types')
            ->cascadeOnDelete();
            $table->foreignId('category_id')
            ->nullable()
            ->references('id')
            ->on('categories')
            ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_type');
    }
};
