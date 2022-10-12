<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "admin";
        $user->email = "admin@mail.com";
        $user->password = bcrypt('12345678'); 
        $user->status = "aktif";
        $user->role_id = "1";
        $user->save();
    }
}
