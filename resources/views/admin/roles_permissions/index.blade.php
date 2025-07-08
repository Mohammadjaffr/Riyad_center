@extends('layouts.master')
@section('title', 'إدارة الأدوار والصلاحيات')

@section('content')
    <div class="container py-4">

        <h2 class="mb-4 text-dark-blue">إدارة الأدوار والصلاحيات</h2>

        @if(session('success') || session('error'))
            <div class="message-center" style="position: fixed;left: 50%;transform: translate(-50%, -50%);z-index: 9999;padding: 20px;border-radius: 8px;text-align: center;animation: fadeInOut 4s forwards;
        {{ session('success') ? 'background: #4CAF50; color: white;' : 'background: #F44336; color: white;' }}">
                {{ session('success') ?? session('error') }}
            </div>
        @endif

        <style>
            @keyframes fadeInOut {
                0% { opacity: 0; }
                10% { opacity: 1; }
                90% { opacity: 1; }
                100% { opacity: 0; visibility: hidden; }
            }
        </style>
        {{-- التابات --}}
        <ul class="nav nav-tabs mb-4" id="rolePermissionTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="roles-tab" data-bs-toggle="tab" data-bs-target="#roles" type="button" role="tab" aria-controls="roles" aria-selected="true">الأدوار</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="permissions-tab" data-bs-toggle="tab" data-bs-target="#permissions" type="button" role="tab" aria-controls="permissions" aria-selected="false">الصلاحيات</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="assign-tab" data-bs-toggle="tab" data-bs-target="#assign" type="button" role="tab" aria-controls="assign" aria-selected="false">إسناد الأدوار</button>
            </li>
        </ul>

        <div class="tab-content" id="rolePermissionTabsContent">

            {{-- تبويب الأدوار --}}
            <div class="tab-pane fade show active" id="roles" role="tabpanel" aria-labelledby="roles-tab">
                {{-- إضافة دور جديد --}}
                <form method="POST" action="{{ route('admin.roles.store') }}" class="mb-4">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="أدخل اسم الدور الجديد" required>
                        <button class="btn btn-primary" type="submit">إضافة دور</button>
                    </div>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </form>

                {{-- جدول عرض الأدوار --}}
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>اسم الدور</th>
                        <th>الصلاحيات</th>
                        <th>الإجراءات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td style="max-width: 250px;">
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach($role->permissions as $perm)
                                        <span class="badge bg-info text-dark">{{ $perm->name }}</span>
                                    @endforeach
                                </div>
                            </td>

                            <td>
                                {{-- زر تعديل صلاحيات الدور (يفتح مودال) --}}
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editRoleModal{{ $role->id }}">تعديل الصلاحيات</button>

                                {{-- زر حذف الدور --}}
                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الدور؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                </form>

                            </td>



                        </tr>

                        {{-- مودال تعديل صلاحيات الدور --}}
                        <div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1" aria-labelledby="editRoleModalLabel{{ $role->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('admin.roles_permissions.update') }}">
                                    @csrf
                                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editRoleModalLabel{{ $role->id }}">تعديل صلاحيات الدور: {{ $role->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                @foreach($permissions as $permission)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm{{ $role->id }}_{{ $permission->id }}"
                                                            {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="perm{{ $role->id }}_{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endforeach
                    </tbody>
                </table>
            </div>

            {{-- تبويب الصلاحيات --}}
            <div class="tab-pane fade" id="permissions" role="tabpanel" aria-labelledby="permissions-tab">
                {{-- إضافة صلاحية جديدة --}}
                <form method="POST" action="{{ route('admin.permissions.store') }}" class="mb-4">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="أدخل اسم الصلاحية الجديدة" required>
                        <button class="btn btn-primary" type="submit">إضافة صلاحية</button>
                    </div>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </form>

                {{-- جدول عرض الصلاحيات --}}
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>اسم الصلاحية</th>
                        <th>الإجراءات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>
                                {{-- زر حذف الصلاحية --}}
                                <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذه الصلاحية؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{-- تبويب إسناد الأدوار --}}
            <div class="tab-pane fade" id="assign" role="tabpanel" aria-labelledby="assign-tab">
                <form method="POST" action="{{ route('admin.assign_role') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">اختر الموظف</label>
                        <select name="employee_id" id="employee_id" class="form-select" required>
                            <option value="">اختر الموظف</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }} ({{ $employee->phone }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="role_id" class="form-label">اختر الدور</label>
                        <select name="role_id" id="role_id" class="form-select" required>
                            <option value="">اختر الدور</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">إسناد الدور للموظف</button>
                </form>
                <hr class="my-4">

                <h5 class="mb-3">قائمة الموظفين وأدوارهم</h5>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>الهاتف</th>
                        <th>الدور المسند</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>
                                @if($employee->roles->isNotEmpty())
                                    @foreach($employee->roles as $role)
                                        <span class="badge bg-primary">{{ $role->name }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">لا يوجد دور</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>

    </div>

@endsection
