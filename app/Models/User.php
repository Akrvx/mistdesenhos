<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property float $wallet_balance
 * @property int $reputation
 * @property int $total_sales
 * @property bool $is_admin
 * @property bool $is_artist
 * @property bool $commissions_open
 * @property string|null $bio
 * @property string|null $specialties
 * @property string|null $socials
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

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
        ];
    }

    // --- RELACIONAMENTOS (O que faltava!) ---

    // 1. Um Usuário (Artista) tem muitas Artes
    public function arts()
    {
        return $this->hasMany(Art::class);
    }

    // 2. Um Usuário (Cliente) faz muitas encomendas
    public function commissionsAsClient()
    {
        return $this->hasMany(Commission::class, 'client_id');
    }

    // 3. Um Usuário (Artista) recebe muitas encomendas
    public function commissionsAsArtist()
    {
        return $this->hasMany(Commission::class, 'artist_id');
    }
}