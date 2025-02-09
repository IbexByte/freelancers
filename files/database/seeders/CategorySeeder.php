<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str ;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            ['name' => 'التصميم الجرافيكي', 'description' => 'خدمات تصميم الشعارات والبانرات والمزيد.', 'image' => 'categories/H2rlSpGsmvGVNC2KX3sN8AaXzCHNBoi0gGUsqQi5.jpg'],
            ['name' => 'تطوير الويب', 'description' => 'تصميم وتطوير مواقع ويب احترافية.', 'image' => 'categories/jEPketsQkkJv4JOsVvHICrP60xj7vzVod214hGWl.jpg'],
            ['name' => 'الكتابة والترجمة', 'description' => 'كتابة المقالات، الترجمة، التدقيق اللغوي.', 'image' => 'categories/0lLePX0Qrezx9AugqhFer1C2sRf3p7FVBXCXSVl4.jpg'],
            ['name' => 'التسويق الإلكتروني', 'description' => 'إدارة الحملات التسويقية والإعلانات.', 'image' => 'categories/Ogu6Zpoa10pvxmHTp07AYvYQYbojXOqDlvsvYsCc.jpg'],
            ['name' => 'التصوير والمونتاج', 'description' => 'تحرير الفيديوهات وتصميم الموشن جرافيك.', 'image' => 'categories/rWsg17WiACwRRT5RFBFn2931sVqSH6fE7rwpZtwd.jpg'],
            ['name' => 'البرمجة والتطوير', 'description' => 'تطوير تطبيقات الويب والموبايل والأنظمة.', 'image' => 'categories/jEPketsQkkJv4JOsVvHICrP60xj7vzVod214hGWl.jpg'],
            ['name' => 'الدعم الفني', 'description' => 'حلول تقنية ودعم فني لمختلف المشاريع.', 'image' => 'categories/download (8).jpeg'],
            ['name' => 'إدارة الأعمال', 'description' => 'استشارات وتخطيط للأعمال والمشاريع.', 'image' => 'categories/business.jpeg'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'description' => $category['description'],
                'slug' => Str::slug($category['name']),
                'image' => $category['image'],
                'status' => true,
            ]);
        }
    }

}
