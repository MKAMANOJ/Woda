<?php

use App\EBP\Entities\Role;
use Illuminate\Database\Seeder;

/**
 * Class RolesTableSeeder
 */
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = config('userroles');

        foreach ($roles as $role) {
            if (!Role::where('name', $role['name'])->exists()) {
                Role::create($role);
            }
        }
    }
}
