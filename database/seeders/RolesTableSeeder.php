<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles básicos
        $adminRole = Role::create([
            'name' => 'admin',
            'description' => 'Administrador del sistema con acceso total'
        ]);

        $userRole = Role::create([
            'name' => 'user',
            'description' => 'Usuario estándar con permisos limitados'
        ]);

        // Crear usuario administrador por defecto
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Asignar rol de administrador al usuario
        if (!$admin->hasRole('admin')) {
            $admin->roles()->attach($adminRole->id);
        }

        $this->command->info('Roles y usuario administrador creados exitosamente!');
    }
}
