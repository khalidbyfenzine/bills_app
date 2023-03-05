<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service')->insert(
            [
                [
                    'Service_name' => 'testService'
                ],
                [
                    'Service_name' => 'testService2'
                ]
            ]
        );
    }
}
