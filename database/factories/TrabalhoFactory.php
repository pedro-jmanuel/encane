<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TrabalhoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $optionA = 1 ;
        $optionB = 2;
        $optionC = 3;
        $optionD = 4 ;

        return [
            'titulo' => fake()->name(),
            'participante_id' => rand(1,4),
            'area_conhecimento_id' =>rand(1,4),
            'resumo_pt'=>"Assets-site/testePdf/DAM-2022-23-Anotações-v0.pdf",
            'resumo_en'=>"Assets-site/testePdf/DAM-2022-23-Anotações-v0.pdf",
             'estado_cc'=>'Pendente',
             'estado_revisor'=>'Pendente',
            
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
  
}


    
    





























    