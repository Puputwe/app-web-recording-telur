<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JenisPakanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenis = [
            [
                'id' => "1",
                'jenis' => 'Starter',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => "2",
                'jenis' => 'Grower',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => "3",
                'jenis' => 'Layer',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
        ];

        \DB::table('jenis_pakan')->insert($jenis);
    }
}
