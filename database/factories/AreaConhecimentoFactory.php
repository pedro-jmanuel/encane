<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class AreaConhecimentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

      $optionA = 'Investigação básica e aplicada em Ciências Sociais e Humanidades' ;
      $optionB = 'Investigação básica e aplicada em Ciências Exactas e Engenharias' ;
      $optionC = 'Investigação básica e aplicada em Ciências da Vida e Saúde' ;
      $optionD = 'Investigação básica e aplicada em Ciências  Agrárias e Veterinárias' ;
        return [
              
                'nome'=>fake()->randomElement([$optionA,$optionB,$optionC,$optionD]),
                'conferencia_id'=>1
        
            
        ];
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
