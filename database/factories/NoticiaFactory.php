<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Noticia::class, function (Faker $faker) {
    $faker = Faker\Factory::create('pt_BR');
    return [
        'titulo' => $faker->sentence(6, true),
        'categoria' => $faker->word(),
        'palavras_chaves' => 'key, word, world',
        'autor' => $faker->name(),
        'content' => $faker->text()
    ];
});
