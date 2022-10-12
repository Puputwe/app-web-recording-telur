<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            [
                'id' => "1",
                'role' => 'admin',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => "2",
                'role' => 'anggota',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
        ];

        \DB::table('role')->insert($role);
    }
}
