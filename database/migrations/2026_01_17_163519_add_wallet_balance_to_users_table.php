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
    Schema::create('commissions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Dono do serviço
        
        $table->string('title');       // Ex: "Full Body Colorido"
        $table->text('description');   // Ex: "Entrego em 3 dias, fundo simples..."
        $table->decimal('price', 10, 2); // Preço base
        $table->integer('days_to_complete')->default(7); // Prazo estimado
        
        $table->boolean('is_nsfw')->default(false); // <--- O CAMPO NSFW
        
        $table->timestamps();
    });

    // APROVEITANDO A VIAGEM: Vamos adicionar is_nsfw na tabela de Artes também
    Schema::table('arts', function (Blueprint $table) {
        $table->boolean('is_nsfw')->default(false)->after('category');
    });
}

public function down(): void
{
    Schema::dropIfExists('commissions');
    
    Schema::table('arts', function (Blueprint $table) {
        $table->dropColumn('is_nsfw');
    });
}
};
