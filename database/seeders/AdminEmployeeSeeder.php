<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminEmployeeSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء الأدوار أولاً
        Role::firstOrCreate(['name' => 'موظف ملابس', 'guard_name' => 'employee']);
        Role::firstOrCreate(['name' => 'موظف أحذية', 'guard_name' => 'employee']);
        Role::firstOrCreate(['name' => 'المدير', 'guard_name' => 'employee']);

        // إنشاء الأقسام
        $adminDepartment = Department::updateOrCreate(['id' => 1], ['name' => 'الإدارة']);
        $clothesDepartment = Department::firstOrCreate(['name' => 'ملابس']);
        $shoesDepartment = Department::firstOrCreate(['name' => 'أحذية']);

        // إنشاء الموظفين وتعيين الأدوار
        $adminClothes = Employee::firstOrCreate([
            'name' => 'admin_clothes',
        ], [
            'phone' => '777777777',
            'password' => Hash::make('123'),
            'status' => 'نشط',
            'salary' => 0,
            'roles_name' => 'موظف ملابس',
            'department_id' => $clothesDepartment->id,
        ]);
        $adminClothes->assignRole('موظف ملابس');

        $adminShoes = Employee::firstOrCreate([
            'name' => 'admin_shoes',
        ], [
            'phone' => '888888888',
            'password' => Hash::make('123'),
            'status' => 'نشط',
            'salary' => 0,
            'roles_name' => 'موظف أحذية',
            'department_id' => $shoesDepartment->id,
        ]);
        $adminShoes->assignRole('موظف أحذية');

        $adminGeneral = Employee::firstOrCreate([
            'name' => 'admin',
        ], [
            'phone' => '999999999',
            'password' => Hash::make('123'),
            'status' => 'نشط',
            'salary' => 0,
            'roles_name' => 'المدير',
            'department_id' => $adminDepartment->id,
        ]);
        $adminGeneral->assignRole('المدير');

        echo "✅ تم إنشاء الأدوار والموظفين وتعيين الأدوار.\n";
    }
}
