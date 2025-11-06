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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            // Requisito 1: título (obrigatório, max 255)
            $table->string('title', 255);

            // Requisito 1: descrição (opcional)
            $table->text('description')->nullable();

            // Requisito 1: status (pendente ou concluída)
            $table->string('status')->default('pendente');

            // Requisito 5: Soft delete
            $table->softDeletes();

            // Requisito 1: "data de criação" é gerenciada pelos timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
