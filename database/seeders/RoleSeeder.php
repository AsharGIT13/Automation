<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => "Super Admin", 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => "Admin", 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => "Admin Staff", 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => "Supplier", 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => "Supplier Staff", 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ];
        Role::insert($data);
    }
}
