<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        User::insert([
//			[
//                            'name' => 'Richard dev',
//                            'email' => 'rmiranda@datafact.com.ec',
//                            'password' => bcrypt('password')
//                        ]
//		]);
//        $user = User::create([			
//                    'name' => 'Richard dev',
//                    'email' => 'rmiranda@datafact.com.ec',
//                    'password' => bcrypt('1q2w3e4r5t')                        
//		]);
        $rol   = Role::create(['name'=>'administrador']);
        $permisos  = Permission::pluck('id','id')->all();
        $rol->syncPermissions($permisos);
        $user = User::find(1);
        $user->assignRole('administrador');
    }
}
