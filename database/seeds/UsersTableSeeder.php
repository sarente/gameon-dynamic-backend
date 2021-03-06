<?php

use App\Models\UserPoint;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //First of all add permission to db then create roles thus connect the permission to related role
        //\Illuminate\Support\Facades\DB::statement('SET GLOBAL FOREIGN_KEY_CHECKS=0;');
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\User::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        //\Illuminate\Support\Facades\DB::statement('SET GLOBAL FOREIGN_KEY_CHECKS=1;');

        \App\Models\User::orderBy('id')->delete();

        $domain_name = "test.com";

        //Get the role of admin
        //$role = app(\Spatie\Permission\PermissionRegistrar::class)->getRoleClass()::findByName('admin');

        $role_admin = \App\Models\Role::findByName(\App\Models\Setting::ROLE_ADMIN, config('auth.defaults.guard'));
        $role_user = \App\Models\Role::findByName(\App\Models\Setting::ROLE_USER, config('auth.defaults.guard'));
        $role_supervisor = \App\Models\Role::findByName(\App\Models\Setting::ROLE_SUPERVISOR, config('auth.defaults.guard'));

        ///////////
        $name = app()->environment('production') ? 'Administrator' : 'Test Admin';
        $admin = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'admin@' . $domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('g@meon'),
            'name' => $name,
            'surname' => '',

        ]);
        $admin->assignRole($role_admin);

        ///////////
        $name = app()->environment('production') ? 'Supervisor' : 'Test Supervisor';
        $supervisor = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'supervisor@' . $domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => $name,
            'surname' => '',

        ]);
        $supervisor->assignRole($role_supervisor);

        ///////////
        $name = app()->environment('production') ? 'User' : 'Test User';
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user@' . $domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => $name,
            'surname' => '',

        ]);
        $user->assignRole($role_user);
        $workflows = \App\Models\CustomWorkflow::pluck('id');
        $user->workflows()->attach($workflows, ['marking' => '"the_blanks"']);

        //Add workflow to users
        $workflows = \App\Models\CustomWorkflow::pluck('id');

        $user->workflows()->attach($workflows, ['marking' => '"the_blanks"']);

    }
}
