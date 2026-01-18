<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Art;
use App\Models\Commission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ---------------------------------------------------------
        // 1. CRIA O SEU USUÁRIO (ADMIN / DEV)
        // ---------------------------------------------------------
        // Vamos criar uma conta para você não precisar se registrar toda hora
        User::create([
            'name' => 'Mauricio Developer',
            'email' => 'admin@duckly.com',
            'password' => Hash::make('password'), // A senha será 'password'
            'is_artist' => true,         // Você é artista
            'wallet_balance' => 50000,   // Saldo alto para testes
            'reputation' => 999,
            'total_sales' => 150,
        ]);

        $this->command->info('Usuário Admin criado: admin@duckly.com / Senha: password');

        // ---------------------------------------------------------
        // 2. CRIA ARTISTAS FALSOS
        // ---------------------------------------------------------
        $nomesArtistas = [
            'Alice Paint', 'Bob Sketch', 'Carol Pixel', 'Dan Canvas', 
            'Eve Brush', 'Frank Line', 'Grace Palette', 'Hank Ink', 
            'Ivy Color', 'Jack Draw'
        ];

        foreach ($nomesArtistas as $index => $nome) {
            
            // Cria o Artista
            $artist = User::create([
                'name' => $nome,
                'email' => strtolower(str_replace(' ', '', $nome)) . '@duckly.com',
                'password' => Hash::make('password'),
                'is_artist' => true,
                'wallet_balance' => rand(100, 5000), // Saldo aleatório
                'reputation' => rand(10, 500),       // Reputação aleatória
                'total_sales' => rand(0, 100),       // Vendas aleatórias
            ]);

            // -----------------------------------------------------
            // 3. CRIA PRODUTOS (SHOP / ARTES PRONTAS)
            // -----------------------------------------------------
            $categorias = ['Digital', 'Pintura', '3D', 'Fotografia', 'IA', 'Pixel Art'];
            $titulosArts = ['Cyber City', 'Morning Dew', 'Abstract Mind', 'Lost Soul', 'Neon Light', 'Retro Vibe', 'Duck Life'];

            // Cada artista posta entre 3 e 6 artes na galeria
            for ($i = 0; $i < rand(3, 6); $i++) {
                Art::create([
                    'user_id' => $artist->id,
                    'titulo' => $titulosArts[array_rand($titulosArts)] . ' #' . rand(1, 99),
                    'description' => 'Uma obra incrível disponível para download imediato. Alta resolução incluída. Arte original criada com muito carinho.',
                    'category' => $categorias[array_rand($categorias)],
                    'preco' => rand(50, 800),
                    // O prefixo "fake_demo_" ativa a lógica de imagem aleatória no front-end
                    'imagem_caminho' => 'fake_demo_' . $index . '_' . $i . '.jpg', 
                    'is_nsfw' => (rand(1, 100) > 90), // 10% de chance de ser NSFW na galeria
                ]);
            }

            // -----------------------------------------------------
            // 4. CRIA SERVIÇOS (COMMISSIONS / ENCOMENDAS)
            // -----------------------------------------------------
            // Lista de serviços possíveis (Nome, Preço Base, É NSFW?)
            $tiposComissao = [
                ['Icon Sketch', 50, false],
                ['Full Body Flat', 150, false],
                ['Full Body Render', 300, false],
                ['Chibi Cute Style', 80, false],
                ['Cenário Complexo RPG', 500, false],
                ['Emotes Twitch (Pack)', 60, false],
                ['Modelo VTuber Rigged', 1200, false],
                ['NSFW Hardcore Art', 400, true], // Serviço +18
                ['NSFW Soft / Pinup', 250, true], // Serviço +18
            ];

            // Cada artista oferece entre 2 e 5 tipos de serviço
            for ($j = 0; $j < rand(2, 5); $j++) {
                // Escolhe um serviço aleatório da lista
                $servico = $tiposComissao[array_rand($tiposComissao)];
                
                Commission::create([
                    'user_id' => $artist->id,
                    'title' => $servico[0], // Título
                    'description' => 'Faço este serviço com qualidade profissional. Entre em contato para discutir os detalhes. Entrega rápida e revisões inclusas.',
                    'price' => $servico[1], // Preço
                    'days_to_complete' => rand(3, 30), // Prazo
                    'is_nsfw' => $servico[2], // Flag NSFW (true ou false)
                ]);
            }
        }
    }
}