<?php

namespace Database\Factories;

use App\Enums\BolsaTipo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bolsa>
 */
class BolsaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'user_id' => 1,
            'token' => Str::uuid(),
            'nome' => $this->faker->name(),
            'projeto_cod' => '111',
            'projeto_nome' => 'projeto teste',
            'projeto_num' => 'APQ-09512',
            'tipo' => BolsaTipo::FAPEMIG->value,
            'valor' => '100000',
            'data_inicio' => '2025-07-01',
            'data_fim' => '2026-07-01',
        ];
    }
}
