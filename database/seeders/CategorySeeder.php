<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Web'],
            ['name' => 'Flutter'],
            ['name' => 'Markting'],
            ['name' => 'Graphic'],
            ['name' => 'Ui/Ux'],
        ]);
    }
}
