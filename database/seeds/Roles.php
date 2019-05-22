<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use iopro\User;
use Illuminate\Support\Facades\Hash;
class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
         $roleAdministrador = Role::firstOrCreate(['name' => 'Administrador']);
         $rolePresidente = Role::firstOrCreate(['name' => 'Presidente']);
         $roleSecretaria = Role::firstOrCreate(['name' => 'Secretaria']);
         $roleSecretaria = Role::firstOrCreate(['name' => 'Asociacion']);

         $user= User::firstOrCreate([
            'name' => 'Paul Sasha',
            'email' => 'info@propiedad.com',
            'password' => Hash::make('12345678'),
        ]);
         $user->assignRole('Administrador');
    }
}
