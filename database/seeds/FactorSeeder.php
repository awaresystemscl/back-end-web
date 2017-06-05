<?php

use Illuminate\Database\Seeder;

class FactorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $factores = [
        	[
                'nombre' => 'Tiempo de Respuesta',
                'rango' => 10000,
                'medida' => 'ms',
        		'tipo_de_medida' => 'menor'
        	],
            [
                'nombre' => 'Disponibilidad',
                'rango' => 100,
                'medida' => '%',
                'tipo_de_medida' => 'mayor'
            ],
            [
                'nombre' => 'Rendimiento',
                'rango' => 100,
                'medida' => 'Invokes/sec',
                'tipo_de_medida' => 'mayor'
            ],
            [
                'nombre' => 'Confiabilidad',
                'rango' => 100,
                'medida' => '%',
                'tipo_de_medida' => 'mayor'
            ],
            [
                'nombre' => 'Latencia',
                'rango' => 10000,
                'medida' => 'ms',
                'tipo_de_medida' => 'menor'
            ]
        ];

        foreach ($factores as $factor){
        	\App\Modelos\Factor::create($factor);
        }
    }
}
