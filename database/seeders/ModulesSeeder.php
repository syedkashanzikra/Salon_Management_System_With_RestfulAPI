<?php

namespace Database\Seeders;

use App\Models\Modules;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $modules = [
            [
                'module_name' => 'Branch',
                'description' => '',
                'status' => 1,
                'more_permission' => json_encode(['gallery']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Booking',
                'description' => '',
                'status' => 1,
                'more_permission' => json_encode(['tableview']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Service',
                'description' => '',
                'status' => 1,
                'more_permission' => json_encode(['gallery']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ],
            [
                'module_name' => 'Category',
                'description' => '',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Subcategory',
                'description' => '',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Staff',
                'description' => '',
                'status' => 1,
                'more_permission' => json_encode(['password']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Customer',
                'description' => '',
                'status' => 1,
                'more_permission' => json_encode(['password']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Page',
                'description' => '',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Tax',
                'description' => '',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Notification',
                'description' => '',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'App Banner',
                'description' => '',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Notification Template',
                'description' => '',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Review',
                'description' => '',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];

        // if(env('IS_DUMMY_DATA')) {
        foreach ($modules as $key => $module_data) {

            $modules = Modules::create($module_data);

        }
        // }

    }
}
