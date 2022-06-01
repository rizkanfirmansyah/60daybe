<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $datas = [
            [
                'name' => 'dashboard',
                'description' => 'Tidak ada',
                'created_by' => 'admin',
            ],
            [
                'name' => 'menu',
                'description' => 'Tidak ada',
                'created_by' => 'admin',
            ],
        ];

        DB::table('sections')->insert($datas);
    }
}
