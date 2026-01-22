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
            
            // O Dono da Arte
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->string('titulo');
            $table->text('descricao');
            $table->decimal('preco', 10, 2);
            $table->string('imagem_caminho');
            
            // --- A LINHA QUE FALTAVA ---
            $table->boolean('is_nsfw')->default(false); 
            // ---------------------------

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arts');
    }
};