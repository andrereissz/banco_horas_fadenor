<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bolsista>
 */
class BolsistaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'data_nasc' => $this->faker->date,
            'nome_mae' => $this->faker->name,
            'nome_pai' => $this->faker->name,
            'sexo' => 'M',
            'escolaridade' => rand(1, 12),
            'estado_civil' => rand(1, 7),
            'uf_nasc' => $this->faker->stateAbbr,
            'muni_nasc' => $this->faker->city,
            'raca_cor' => rand(1, 6),
            'telefone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'logradouro' => $this->faker->streetName,
            'numero' => $this->faker->buildingNumber,
            'complemento' => '',
            'bairro' => $this->faker->word,
            'uf_resid' => 'MG',
            'muni_resid' => 'Montes Claros',
            'cep' => $this->faker->postcode,
            'cpf' => $this->faker->unique()->cpf(false),
            'pis' => $this->faker->unique()->numerify('###########'),
            'rg' => $this->faker->unique()->numerify('#########'),
            'rg_orgao' => 'PC',
            'rg_orgao_uf' => 'MG',
            'rg_data_emissao' => $this->faker->date,
            'titulo_eleitor' => $this->faker->unique()->numerify('###########'),
            'titulo_zona' => $this->faker->numerify('####'),
            'titulo_secao' => $this->faker->numerify('####'),
            'certificado_reservista' => '',
            'password' => 'password'
        ];
    }
}
