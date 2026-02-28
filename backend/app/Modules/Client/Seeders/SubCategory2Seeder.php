<?php

namespace App\Modules\Client\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Client\Models\SubCategory2;

class SubCategory2Seeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $items = [
            ['name' => 'Item 1', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Item 2', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Item 3', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Item 4', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Item 5', 'created_at' => $now, 'updated_at' => $now],
        ];

        SubCategory2::insert($items);
    }
}
