<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء الأدوار
        $adminRole = Role::firstOrCreate(['name' => 'المدير', 'guard_name' => 'employee']);
        $clothesRole = Role::firstOrCreate(['name' => 'موظف ملابس', 'guard_name' => 'employee']);
        $shoesRole   = Role::firstOrCreate(['name' => 'موظف أحذية', 'guard_name' => 'employee']);

        // إعطاء جميع الصلاحيات للأدمن
        $adminRole->syncPermissions(Permission::all());

        // صلاحيات موظف ملابس
        $clothesPermissions = [
            'عرض الفواتير', 'إضافة الفواتير',
            'عرض المنتجات', 'عرض المخزون',
            'عرض الجرد', 'عرض مرتجع البيع', 'إضافة مرتجع البيع',
        ];
        $clothesRole->syncPermissions(Permission::whereIn('name', $clothesPermissions)->get());

        // صلاحيات موظف أحذية
        $shoesPermissions = [
            'عرض الفواتير', 'إضافة الفواتير',
            'عرض المنتجات', 'عرض المخزون',
            'عرض الجرد', 'عرض مرتجع البيع', 'إضافة مرتجع البيع',
        ];
        $shoesRole->syncPermissions(Permission::whereIn('name', $shoesPermissions)->get());

        echo "✅ تم إنشاء الأدوار وإسناد الصلاحيات.\n";
    }
}
