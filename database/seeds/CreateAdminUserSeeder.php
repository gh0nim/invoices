<?php
use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{/*** Run the database seeds.** @return void*/
    public function run()
    {
        $user = User::create([
            'name' => 'ghonim',
            'roles_name' => ['owner'],
            'Status' => 'مفعل',
            'email' => 'ghonim@elgendy.com',
            'password' => bcrypt('123456')
        ]);
        $role = Role::create(['name' => 'owner']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}