<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
  public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        // Por padrão, é false (0). Só vira artista (1) se marcar a opção.
        $table->boolean('is_artist')->default(false); 
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('is_artist');
    });
}
};
