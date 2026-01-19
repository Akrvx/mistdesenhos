<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $titulo
 * @property string $descricao
 * @property float $preco
 * @property string $imagem_caminho
 * @property bool $is_nsfw
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $user
 */
class Art extends Model
{
    use HasFactory;

    protected $table = 'arts';

    protected $fillable = [
        'titulo',
        'descricao',
        'preco',
        'imagem_caminho',
        'is_nsfw',
        'user_id'
    ];

    protected $casts = [
        'is_nsfw' => 'boolean',
        'preco' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}