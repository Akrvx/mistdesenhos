<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Art extends Model
{
    use HasFactory;

    // --- ADICIONE ESTA LINHA AQUI ---
    protected $table = 'arts'; 
    // --------------------------------

    protected $fillable = [
        'titulo',
        'descricao',
        'preco',
        'imagem_caminho',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}