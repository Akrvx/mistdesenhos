<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'wallet_balance',
        'reputation',
        'total_sales',
        'is_admin',
        'is_artist',
        'bio',
        'specialties',
        'socials',
        'commissions_open',
        // --- NOVOS CAMPOS PARA IDADE E NSFW ---
        'birth_date',
        'show_nsfw',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'is_artist' => 'boolean',
            'commissions_open' => 'boolean',
            'wallet_balance' => 'decimal:2',
            'specialties' => 'array',
            'socials' => 'array',
            // --- CASTS DE DATA E BOOLEAN ---
            'birth_date' => 'date',
            'show_nsfw' => 'boolean',
        ];
    }

    // --- CÁLCULO DE IDADE (ATRIBUTO VIRTUAL) ---
    // Permite usar $user->age em qualquer lugar
    public function getAgeAttribute()
    {
        return $this->birth_date ? $this->birth_date->age : 0;
    }

    // --- RELACIONAMENTOS DO MARKETPLACE ---

    // 1. Um Usuário (Artista) tem muitas Artes na vitrine
    public function arts()
    {
        return $this->hasMany(Art::class);
    }

    // 2. Um Usuário (Cliente) faz muitas encomendas (pedidos)
    public function commissionsAsClient()
    {
        return $this->hasMany(Commission::class, 'client_id');
    }

    // 3. Um Usuário (Artista) recebe muitas encomendas (serviços)
    public function commissionsAsArtist()
    {
        return $this->hasMany(Commission::class, 'artist_id');
    }
}