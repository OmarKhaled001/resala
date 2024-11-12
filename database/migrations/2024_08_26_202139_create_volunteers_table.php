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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branche_id')
            ->nullable()
            ->references('id')
            ->on('branches')
            ->cascadeOnDelete();
            $table->foreignId('section_id')
            ->nullable()
            ->references('id')
            ->on('sections')
            ->cascadeOnDelete();
            $table->foreignId('category_id')
            ->nullable()
            ->references('id')
            ->on('categories')
            ->onDelete('set null');
            $table->string('name');
            $table->string('phone');
            $table->string('gender');
            $table->date('birthdate')->nullable();
            $table->date('voldate')->nullable();
            $table->string('address')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('notes')->nullable();
            $table->boolean('ashbal')->nullable();
            $table->boolean('tshirt')->nullable();
            $table->boolean('meni_camp')->nullable();
            $table->boolean('camp_48')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
