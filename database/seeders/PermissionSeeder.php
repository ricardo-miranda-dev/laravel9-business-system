<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
//            'ver-categoria',
//            'crear-categoria',
//            'editar-categoria',
//            'eliminar-categoria',
//            
//            'ver-cliente',
//            'crear-cliente',
//            'editar-cliente',
//            'eliminar-cliente',
//            
//            'ver-proveedore',
//            'crear-proveedore',
//            'editar-proveedore',
//            'eliminar-proveedore',
//            
//            'ver-producto',
//            'crear-producto',
//            'editar-producto',
//            'eliminar-producto',
//            
//            'ver-presentacione',
//            'crear-presentacione',
//            'editar-presentacione',
//            'eliminar-presentacione',
//            
//            'ver-marca',
//            'crear-marca',
//            'editar-marca',
//            'eliminar-marca',
//            
//            'ver-compra',
//            'crear-compra',
//            'mostrar-compra',
//            'eliminar-compra',
//            
//            'ver-venta',
//            'crear-venta',
//            'mostrar-venta',
//            'eliminar-venta',
            
            'ver-user',
            'crear-user',
            'editar-user',
            'eliminar-user',
            
            'ver-role',
            'crear-role',
            'editar-role',
            'eliminar-role',
        ];
        
        foreach ($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
