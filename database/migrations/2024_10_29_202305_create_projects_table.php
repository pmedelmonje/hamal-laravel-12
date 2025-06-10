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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_type_id')
            ->constrained('project_types')
            ->noActionOnDelete()
            ->cascadeOnUpdate();

            $table->string('name');
            $table->string('slug');
            $table->string('technologies')->nullable();
            $table->string('url')->nullable();
            $table->text('short_description');
            $table->text('description');
            $table->string('filename')->nullable();
            $table->string('filepath')->nullable();
            $table->string('is_visible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
