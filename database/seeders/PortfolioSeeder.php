<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Portfolio::create([
            'title' => 'مشروع موقع شركة',
            'category_id' => 1,
            'description' => 'موقع احترافي لشركة تقدم خدمات تقنية.',
            'image_path' => 'images/portfolio1.png',
            'project_url' => 'https://example.com/project1',
        ]);

        Portfolio::create([
            'title' => 'تطبيق موبايل',
            'category_id' => 2,
            'description' => 'تطبيق جوال لأنظمة iOS و Android.',
            'image_path' => 'images/portfolio2.png',
            'project_url' => 'https://example.com/project2',
        ]);

        Portfolio::create([
            'title' => 'لوحة تحكم',
            'category_id' => 3,
            'description' => 'لوحة تحكم لإدارة المحتوى ولوحة تحليلات.',
            'image_path' => 'images/portfolio3.png',
            'project_url' => 'https://example.com/project3',
        ]);
    }
}
