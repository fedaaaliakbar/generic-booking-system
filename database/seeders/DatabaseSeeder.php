<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // إنشاء حساب مستخدم عادي للتجربة
        \App\Models\User::create([
            'name' => 'أحمد العميل',
            'email' => 'client@test.com',
            'password' => bcrypt('password123'),
            'role' => 'user'
        ]);

        // إنشاء حساب مدير للنظام
        \App\Models\User::create([
            'name' => 'خالد المدير',
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),
            'role' => 'admin'
        ]);

        // حساب مقدم الخدمة الأول (مثلاً كابتن ملعب أو مستشار)
        \App\Models\User::create([
            'name' => 'الكابتن محمد',
            'email' => 'provider1@test.com',
            'password' => bcrypt('password123'),
            'role' => 'provider'
        ]);

        // حساب مقدم الخدمة الثاني
        \App\Models\User::create([
            'name' => 'المستشار فهد',
            'email' => 'provider2@test.com',
            'password' => bcrypt('password123'),
            'role' => 'provider'
        ]);

        \App\Models\Service::create([
            'name' => 'حجز ملعب كرة قدم',
            'description' => 'حجز ساعة كاملة لملعب عُشبي خماسي شامل الإضاءة والخدمات ومواقف السيارات.',
            'price' => 25.00,
            'duration_minutes' => 60
        ]);

        \App\Models\Service::create([
            'name' => 'جلسة استشارة قانونية',
            'description' => 'جلسة استشارية خاصة مدتها ساعة مع مستشار قانوني متخصص لتقديم الحلول والدعم.',
            'price' => 50.00,
            'duration_minutes' => 60
        ]);

        \App\Models\Service::create([
            'name' => 'جلسة تصوير احترافية',
            'description' => 'جلسة تصوير داخل الاستوديو مخصصة للأفراد أو الشركات مع تسليم الصور معدلة رقمياً.',
            'price' => 40.00,
            'duration_minutes' => 45
        ]);
    }
}
