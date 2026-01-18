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
    Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->string('key')->unique(); // ex: 'commission_rate'
        $table->string('value')->nullable(); // ex: '15'
        $table->string('description')->nullable(); // ex: 'Porcentagem cobrada por venda'
        $table->timestamps();
    });
    
    // Vamos inserir os dados padrão logo de cara
    DB::table('settings')->insert([
        ['key' => 'site_name', 'value' => 'Duckly', 'description' => 'Nome do Marketplace'],
        ['key' => 'commission_rate', 'value' => '10', 'description' => 'Taxa de Comissão (%)'],
        ['key' => 'maintenance_mode', 'value' => '0', 'description' => 'Modo Manutenção (0=Off, 1=On)'],
    ]);
}
};
