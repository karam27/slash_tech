<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'برمجة تطبيقات الهواتف',
                'description' => 'نقوم ببناء تطبيقات أصلية وسريعة لأندرويد و iOS باستخدام أحدث التقنيات.',
                'image' => 'images/services/mobile_apps.png'
            ],
            [
                'title' => 'تصميم واجهات UX/UI',
                'description' => 'تصاميم عصرية وإبداعية تركز على توفير أفضل تجربة مستخدم ممكنة.',
                'image' => 'images/services/ui_ux.png'
            ],
            [
                'title' => 'تطوير مواقع الويب',
                'description' => 'بناء مواقع ويب تفاعلية ومتجاوبة مع جميع الشاشات، من المتاجر الإلكترونية إلى المواقع التعريفية.',
                'image' => 'images/services/web_dev.png'
            ],
            [
                'title' => 'حلول التجارة الإلكترونية',
                'description' => 'نوفر حلولاً متكاملة لإنشاء وإدارة المتاجر الإلكترونية وزيادة المبيعات.',
                'image' => 'images/services/ecommerce.png'
            ]
        ];


        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
