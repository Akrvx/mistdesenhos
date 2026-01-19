<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cria a tabela de PEDIDOS DE ENCOMENDA
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            
            // Quem pediu (Cliente)
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            
            // Quem vai desenhar (Artista)
            $table->foreignId('artist_id')->constrained('users')->onDelete('cascade');
            
            // Detalhes do pedido
            $table->text('description');
            $table->decimal('price', 10, 2)->nullable(); // O Artista define depois
            $table->string('status')->default('pending'); // pending, accepted, rejected, completed
            
            // Prazo (Opcional)
            $table->date('prazo_desejado')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};