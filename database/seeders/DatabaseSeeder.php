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
        // 1. CRIA O SEU USUÁRIO (ADMIN)
        User::create([
            'name' => 'Mauricio Developer',
            'email' => 'admin@duckly.com',
            'password' => Hash::make('password'),
            'is_artist' => true,
            'wallet_balance' => 50000,
            'reputation' => 999,
            'total_sales' => 150,
        ]);

        $this->command->info('Usuário Admin criado: admin@duckly.com / Senha: password');

        // 2. CRIA ARTISTAS FALSOS
        $nomesArtistas = [
            'Alice Paint', 'Bob Sketch', 'Carol Pixel', 'Dan Canvas', 
            'Eve Brush', 'Frank Line', 'Grace Palette', 'Hank Ink', 
            'Ivy Color', 'Jack Draw'
        ];

        foreach ($nomesArtistas as $index => $nome) {
            
            $artist = User::create([
                'name' => $nome,
                'email' => strtolower(str_replace(' ', '', $nome)) . '@duckly.com',
                'password' => Hash::make('password'),
                'is_artist' => true,
                'wallet_balance' => rand(100, 5000),
                'reputation' => rand(10, 500),
                'total_sales' => rand(0, 100),
            ]);

            // 3. CRIA PRODUTOS (SHOP) - CORRIGIDO AQUI
            $categorias = ['Digital', 'Pintura', '3D', 'Fotografia', 'IA', 'Pixel Art'];
            $titulosArts = ['Cyber City', 'Morning Dew', 'Abstract Mind', 'Lost Soul', 'Neon Light', 'Retro Vibe', 'Duck Life'];

            for ($i = 0; $i < rand(3, 6); $i++) {
                Art::create([
                    'user_id' => $artist->id,
                    'titulo' => $titulosArts[array_rand($titulosArts)] . ' #' . rand(1, 99),
                    
                    // CORREÇÃO: Mudamos de 'description' para 'descricao'
                    'descricao' => 'Uma obra incrível disponível para download imediato. Alta resolução incluída. Arte original criada com muito carinho.',
                    
                    'category' => $categorias[array_rand($categorias)],
                    'preco' => rand(50, 800),
                    'imagem_caminho' => 'fake_demo_' . $index . '_' . $i . '.jpg', 
                    'is_nsfw' => (rand(1, 100) > 90),
                ]);
            }

            // 4. CRIA SERVIÇOS (COMMISSIONS)
            // Nas comissões mantemos 'description' pois a tabela foi criada em inglês
            $tiposComissao = [
                ['Icon Sketch', 50, false],
                ['Full Body Flat', 150, false],
                ['Full Body Render', 300, false],
                ['Chibi Cute Style', 80, false],
                ['Cenário Complexo RPG', 500, false],
                ['Emotes Twitch (Pack)', 60, false],
                ['Modelo VTuber Rigged', 1200, false],
                ['NSFW Hardcore Art', 400, true],
                ['NSFW Soft / Pinup', 250, true],
            ];

            for ($j = 0; $j < rand(2, 5); $j++) {
                $servico = $tiposComissao[array_rand($tiposComissao)];
                
                Commission::create([
                    'user_id' => $artist->id,
                    'title' => $servico[0],
                    'description' => 'Faço este serviço com qualidade profissional. Entrega rápida e revisões inclusas.',
                    'price' => $servico[1],
                    'days_to_complete' => rand(3, 30),
                    'is_nsfw' => $servico[2],
                ]);
            }
        }
    }
}