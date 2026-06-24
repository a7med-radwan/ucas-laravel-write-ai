<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * الأدوار بناءً على صلاحيات المستخدمين:
     *  1. Super Admin  – كامل الصلاحيات
     *  2. Manager      – عرض + إنشاء + تعديل (بدون حذف)
     *  3. Support      – عرض + تعديل فقط
     *  4. Viewer       – عرض فقط
     */
    public function run(): void
    {
        $roles = [

            // 1. Super Admin — كل الصلاحيات
            [
                'name' => 'Super Admin',
                'abilities' => [
                    'users.view',
                    'users.create',
                    'users.update',
                    'users.delete',
                ],
            ],

            // 2. Manager — يدير المستخدمين بدون حذف
            [
                'name' => 'Manager',
                'abilities' => [
                    'users.view',
                    'users.create',
                    'users.update',
                ],
            ],

            // 3. Support — يعدّل بيانات المستخدمين فقط
            [
                'name' => 'Support',
                'abilities' => [
                    'users.view',
                    'users.update',
                ],
            ],

            // 4. Viewer — عرض فقط
            [
                'name' => 'Viewer',
                'abilities' => [
                    'users.view',
                ],
            ],

        ];

        foreach ($roles as $roleData) {
            Role::updateOrCreate(
                ['name' => $roleData['name']],
                ['abilities' => $roleData['abilities']],
            );
        }
    }
}
