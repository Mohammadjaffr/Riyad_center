<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Employee;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $employees = Employee::all();

        return view('admin.roles_permissions.index', compact('roles', 'permissions', 'employees'));
    }

    public function storePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name, 'guard_name' => 'employee']);

        return redirect()->back()->with('success', 'تم إضافة صلاحية جديدة بنجاح');
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        Role::create(['name' => $request->name, 'guard_name' => 'employee']);

        return redirect()->back()->with('success', 'تم إضافة دور جديد بنجاح');
    }


    public function updateRolePermissions(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::findById($request->role_id, 'employee');

        $permissionsNames = Permission::whereIn('id', $request->permissions ?? [])->pluck('name')->toArray();

        $role->syncPermissions($permissionsNames);

        return redirect()->back()->with('success', 'تم تحديث صلاحيات الدور بنجاح');
    }

    public function assignRoleToEmployee(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $employee = Employee::find($request->employee_id);
        $role = Role::findById($request->role_id, 'employee');

        $employee->syncRoles([$role]);

        return redirect()->back()->with('success', 'تم إسناد الدور للموظف بنجاح');
    }
    public function destroyPermission($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->back()->with('success', 'تم حذف الصلاحية بنجاح');
    }

    public function destroyRole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->back()->with('success', 'تم حذف الدور بنجاح');
    }


}
