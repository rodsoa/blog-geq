<?php

use Illuminate\Database\Seeder;

class NoticiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pt_BR');

        for ($i=0; $i < 10; $i++) { 
            DB::table('noticias')->insert([
                'titulo' => $faker->sentence(6, true),
                'categoria' => $faker->word(),
                'palavras_chaves' => 'key, word, world',
                'autor' => $faker->name(),
                'conteudo' => $faker->text()
            ]);
        }
    }
}
