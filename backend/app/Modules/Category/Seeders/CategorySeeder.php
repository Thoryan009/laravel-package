<?php

namespace App\Modules\Category\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Category\Models\Category;

class CategorySeeder extends Seeder
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

        Category::insert($items);
    }
}
