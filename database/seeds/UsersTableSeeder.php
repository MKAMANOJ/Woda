<?php

use App\EBP\Entities\Role;
use App\EBP\Entities\User;
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'admin')->first();
        if (!User::where('email', 'babubasnet@outlook.com')->exists()) {
            $user = User::create(
                [
                    'name'     => 'Babu Basnet',
                    'email'    => 'babubasnet@outlook.com',
                    'password' => bcrypt('babubasnet'),
                    'active'   => 1,
                ]
            );
            $user->roles()->sync([$role->id]);
        }
        if (!User::where('email', 'agrahari.mka123@gmail.com')->exists()) {
            $user = User::create(
                [
                    'name'     => 'Manoj Agrahari',
                    'email'    => 'agrahari.mka123@gmail.com',
                    'password' => bcrypt('Administr@tor83'),
                    'active'   => 1,
                ]
            );
            $user->roles()->sync([$role->id]);
        }
    }
}
