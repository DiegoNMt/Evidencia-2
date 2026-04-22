<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Customer;
use App\Models\Order;


class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'name' => 'Sales',
            'description' => 'Creates orders'
        ]);

        Department::create([
            'name' => 'Warehouse',
            'description' => 'Processes orders'
        ]);

        Department::create([
            'name' => 'Route',
            'description' => 'Delivers orders and uploads photos'
        ]);

        Department::create([
            'name' => 'Admin',
            'description' => 'Manages the system'
        ]);
    }
}
