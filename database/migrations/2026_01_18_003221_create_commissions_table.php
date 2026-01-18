<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Cria a tabela de comissões
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('days_to_complete')->default(7);
            
            $table->boolean('is_nsfw')->default(false);
            
            $table->timestamps();
        });

        // 2. Adiciona a coluna is_nsfw na tabela de artes (se ainda não existir)
        // Usamos hasColumn para evitar erros se você rodar migrate:refresh várias vezes
        if (!Schema::hasColumn('arts', 'is_nsfw')) {
            Schema::table('arts', function (Blueprint $table) {
                $table->boolean('is_nsfw')->default(false)->after('category');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('commissions');
        
        if (Schema::hasColumn('arts', 'is_nsfw')) {
            Schema::table('arts', function (Blueprint $table) {
                $table->dropColumn('is_nsfw');
            });
        }
    }
};