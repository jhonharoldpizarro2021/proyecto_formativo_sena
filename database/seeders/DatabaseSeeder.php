<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $areas = [
            ['nombre'  => 'Administrativa y Financiera'],
            ['nombre'  => 'Ingeniería'],
            ['nombre'  => 'Desarrollo de Negocio'],
            ['nombre'  => 'Proyectos'],
            ['nombre'  => 'Servicios'],
            ['nombre'  => 'Calidad']
        ];
        DB::table('areas')->insert($areas);

        $empleados = [
            [
                'nombre'        => 'Pedro Pérez',
                'email'         => 'pperez@example.co',
                'sexo'          => 'M',
                'area_id'       => '5',
                'boletin'       => '1',
                'descripcion'   => 'Hola Mundo'
            ],
            [
                'nombre'        => 'Amalia Bayona',
                'email'         => 'abayona@example.co',
                'sexo'          => 'F',
                'area_id'       => '8',
                'boletin'       => '0',
                'descripcion'   => 'Para contactar a Amalia Bayona, puede escribir al correo electrónico abayona@example.co'
            ]
        ];
        DB::table('empleado')->insert($empleados);

        $empleado_roles = [
            ['empleado_id'  => '4', 'rol_id'  => '4'],
            ['empleado_id'  => '7', 'rol_id'  => '4']
        ];
        DB::table('empleado_rol')->insert($empleado_roles);

        $roles = [
            
            ['nombre'  => 'Desarrollador'],
            ['nombre'  => 'Analista',],
            ['nombre'  => 'Tester',],
            ['nombre'  => 'Diseñador',],
            ['nombre'  => 'Profesional PMO',],
            ['nombre'  => 'Profesional de servicios',],
            ['nombre'  => 'Auxiliar administrativo',],
            ['nombre'  => 'Codirector',]
        ];
        DB::table('roles')->insert($roles);
    }
}
