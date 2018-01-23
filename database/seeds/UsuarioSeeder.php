<?php

use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios = [
        	[
        		'nombre' => 'Sebastian',
        		'email' => 'sebacav@gmail.com',
                'tipo' => 'administrador',
        		'password' => Hash::make('3116dd'),
        	],
            [
                'nombre' => 'Romina',
                'email' => 'romina.torres@unab.cl',
                'password' => Hash::make('lala123'),
            ]
        ];

        foreach ($usuarios as $usuario){
        	\App\Usuario::create($usuario);
        }
    }
}
