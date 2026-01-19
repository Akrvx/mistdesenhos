<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'artist_id',
        'description',
        'price',
        'status',
        'prazo_desejado'
    ];

    // Relacionamento: Quem pediu
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // Relacionamento: Quem faz
    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }
}