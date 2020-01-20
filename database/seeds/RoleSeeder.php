<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role=new Role;
        $role->name="Super_User";
        $role->save();
        $role=new Role;
        $role->name="User";
        $role->save();
    }
}
