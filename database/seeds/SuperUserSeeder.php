<?php

use Illuminate\Database\Seeder;
use App\User;
class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=new User;
        $user->name="Super_User";
        $user->email="super@gmail.com";
        $user->password=bcrypt('password');
        $user->save();
        $user->assignRole('Super_User');
    }
}
