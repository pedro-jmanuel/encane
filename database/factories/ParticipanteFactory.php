<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ParticipanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $optionA = "Estudante" ;
        $optionB = "Investigador" ;
        $optionC = "Docente" ;

        return [
            'user_id' =>1,
            'data_nascimento' =>now(),
            'genero' =>"M",
            'classe' =>fake()->randomElement([$optionA,$optionB,$optionC]),   
             'pais_id'=>1,
            'telefone' => '935038024'
             ]
        ;
    }
    
    
    
    
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
