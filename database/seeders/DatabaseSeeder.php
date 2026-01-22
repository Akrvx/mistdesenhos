<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Art;
use App\Models\Commission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. CRIA O SEU USUÁRIO (ADMIN / ARTISTA)
        User::create([
            'name' => 'Mauricio Developer',
            'email' => 'admin@duckly.com',
            'password' => Hash::make('password'),
            'is_artist' => true,
            'commissions_open' => true, // Importante para receber pedidos
            'wallet_balance' => 50000,
            'reputation' => 999,
            'total_sales' => 150,
            'bio' => 'Fundador e Desenvolvedor da Plataforma.',
        ]);

        $this->command->info('Admin criado: admin@duckly.com / Senha: password');

        // 2. CRIA ARTISTAS FALSOS
        $nomesArtistas = [
            'Alice Paint', 'Bob Sketch', 'Carol Pixel', 'Dan Canvas', 'Eve Brush'
        ];

        $artistasIds = [];

        foreach ($nomesArtistas as $nome) {
            $artist = User::create([
                'name' => $nome,
                'email' => strtolower(str_replace(' ', '', $nome)) . '@duckly.com',
                'password' => Hash::make('password'),
                'is_artist' => true,
                'commissions_open' => (rand(0, 1) == 1), // Alguns com agenda aberta, outros fechada
                'wallet_balance' => rand(100, 5000),
                'reputation' => rand(10, 500),
                'total_sales' => rand(0, 100),
                'bio' => 'Artista digital apaixonado por criar mundos fantásticos.',
            ]);
            
            $artistasIds[] = $artist->id;

            // 3. CRIA PRODUTOS (SHOP) PARA CADA ARTISTA
            $categorias = ['Digital', 'Pintura', '3D', 'Fotografia', 'IA', 'Pixel Art'];
            $titulosArts = ['Cyber City', 'Morning Dew', 'Abstract Mind', 'Lost Soul', 'Neon Light', 'Retro Vibe', 'Duck Life'];

            for ($i = 0; $i < rand(3, 6); $i++) {
                Art::create([
                    'user_id' => $artist->id,
                    'titulo' => $titulosArts[array_rand($titulosArts)] . ' #' . rand(1, 99),
                    'descricao' => 'Uma obra incrível disponível para download imediato. Alta resolução incluída.',
                    'preco' => rand(50, 800),
                    'imagem_caminho' => 'fake_demo_' . rand(1,5) . '.jpg', // Nome genérico para não quebrar imagens
                    'is_nsfw' => (rand(1, 100) > 90),
                ]);
            }
        }

        // 4. CRIA CLIENTES FALSOS (Para fazerem os pedidos)
        $nomesClientes = ['John Doe', 'Jane Smith', 'Richie Rich', 'Fan Boy'];
        $clientesIds = [];

        foreach ($nomesClientes as $nome) {
            $client = User::create([
                'name' => $nome,
                'email' => strtolower(str_replace(' ', '', $nome)) . '@client.com',
                'password' => Hash::make('password'),
                'is_artist' => false,
                'wallet_balance' => rand(1000, 10000), // Clientes ricos
            ]);
            $clientesIds[] = $client->id;
        }

        // 5. CRIA PEDIDOS DE ENCOMENDA (COMMISSIONS)
        // Simula pedidos dos Clientes para os Artistas
        $statusPossiveis = ['pending', 'accepted', 'active', 'completed', 'rejected'];

        for ($k = 0; $k < 15; $k++) {
            $status = $statusPossiveis[array_rand($statusPossiveis)];
            $preco = rand(100, 1500);
            
            Commission::create([
                'client_id' => $clientesIds[array_rand($clientesIds)],
                'artist_id' => $artistasIds[array_rand($artistasIds)],
                'description' => 'Gostaria de um desenho do meu personagem de RPG ' . ($k + 1) . '. Detalhes: Elfo, capa verde, espada brilhante.',
                'status' => $status,
                'price' => ($status != 'pending') ? $preco : null, // Só tem preço se o artista já viu
                'prazo_desejado' => now()->addDays(rand(5, 20)),
                'created_at' => now()->subDays(rand(1, 30)),
            ]);
        }
        
        $this->command->info('Seed completo! Artistas, Clientes e Pedidos criados.');
    }
}