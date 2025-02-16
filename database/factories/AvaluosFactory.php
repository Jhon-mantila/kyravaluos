<?php

namespace Database\Factories;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Avaluos>
 */
class AvaluosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'id' =>  (string) Uuid::uuid4(),
            'cliente_id' => \App\Models\Clientes::factory(), // Relación con el modelo Clientes, pero si se crean 10 avaluos realaciona 10 clientes y los crea
            'estado' => $this->faker->randomElement(['Nuevo', 'Pendiente', 'Finalizado', 'Proceso', 'Sin Asignar']),//$this->faker->word, // Genera una palabra aleatoria
            'observaciones' => $this->faker->sentence, // Genera una oración aleatoria
            
        ];
    }
}
