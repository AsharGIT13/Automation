<?php

namespace Database\Seeders;

use App\Models\Right;
use Illuminate\Database\Seeder;

class RightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['role_id' => 1, 'rights_id' => 2],
            ['role_id' => 1, 'rights_id' => 3],
            ['role_id' => 1, 'rights_id' => 4],
            ['role_id' => 1, 'rights_id' => 5],
            ['role_id' => 1, 'rights_id' => 6],
            ['role_id' => 2, 'rights_id' => 3],
            ['role_id' => 2, 'rights_id' => 4],
            ['role_id' => 2, 'rights_id' => 5],
            ['role_id' => 2, 'rights_id' => 6],
            ['role_id' => 3, 'rights_id' => 4],
            ['role_id' => 3, 'rights_id' => 5],
            ['role_id' => 3, 'rights_id' => 6],
            ['role_id' => 4, 'rights_id' => 5],
            ['role_id' => 4, 'rights_id' => 6],
            ['role_id' => 5, 'rights_id' => 6]
        ];
        Right::insert($data);
    }
}
