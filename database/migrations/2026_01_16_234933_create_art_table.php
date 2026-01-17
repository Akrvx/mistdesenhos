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
        Schema::create('arts', function (Blueprint $table) {
            $table->id();
            
            // --- A LINHA QUE FALTAVA ---
            // Cria a coluna user_id e já avisa que ela liga com a tabela users
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->string('category')->default('Digital'); // Ex: Pintura, 3D, Fotografia
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->decimal('preco', 10, 2); // Campo de preço
            $table->string('imagem_caminho'); // Caminho da foto
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('art');
    }
};
