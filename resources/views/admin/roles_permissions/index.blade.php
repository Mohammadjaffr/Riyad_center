@extends('layouts.master')
@section('title', 'إدارة الأدوار والصلاحيات')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-center align-items-center mb-3 flex-wrap">
        <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">إدارة الأدوار والصلاحيات</h2>
        </div>
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
            .nav-tabs .nav-link.active {
                color: var(--dark-blue) !important;
            }

        </style>
        <div class="bg-white rounded-4 p-3 shadow-sm mb-3">

        {{-- التابات --}}
        <ul class="nav nav-tabs mb-4  bg-dark-blue text-white rounded-2" id="rolePermissionTabs" role="tablist">
            <li class="nav-item text-dark-blue" role="presentation">
                <button class="nav-link active   text-white fw-bold" id="roles-tab" data-bs-toggle="tab" data-bs-target="#roles" type="button" role="tab" aria-controls="roles" aria-selected="true">الأدوار</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link  text-white fw-bold" id="permissions-tab" data-bs-toggle="tab" data-bs-target="#permissions" type="button" role="tab" aria-controls="permissions" aria-selected="false">الصلاحيات</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link   text-white fw-bold" id="assign-tab" data-bs-toggle="tab" data-bs-target="#assign" type="button" role="tab" aria-controls="assign" aria-selected="false">إسناد الأدوار</button>
            </li>
        </ul>

        <div class="tab-content" id="rolePermissionTabsContent">

            {{-- تبويب الأدوار --}}
            <div class="tab-pane fade show active" id="roles" role="tabpanel" aria-labelledby="roles-tab">
                {{-- إضافة دور جديد --}}

                    <div class="row g-2 align-items-center mb-3">
                <form method="POST" action="{{ route('admin.roles.store') }}" class="mb-4">
                    @csrf
                    <div class="row g-3 align-items-center">

                        <div class="col-md-8 col-lg-9">

                        <input type="text" name="name" style="text-align: right;"  class="form-control summary-input w-100 @error('name') is-invalid @enderror" placeholder="أدخل اسم الدور الجديد" required>
                        </div>
                        <div class="col-md-4 col-lg-3">
                        <button class="btn btn-blue w-100" type="submit">إضافة دور</button>
                        </div>
                    </div>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </form>

                {{-- جدول عرض الأدوار --}}
                        <div class="table-responsive ">
                            <table class="table table-hover align-middle text-center table-striped custom-invoice-table" >
                                <thead class="table-light">
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
                                        <span class=" text-dark ">({{ $perm->name }}  ) -</span>
                                    @endforeach

                                </div>
                            </td>

                            <td>
                                {{-- زر تعديل صلاحيات الدور (يفتح مودال) --}}
                                <button class="btn btn-sm btn-blue py-2 px-3" data-bs-toggle="modal" data-bs-target="#editRoleModal{{ $role->id }}">
                                    <i class="fa fa-pen"></i>
{{--                                    تعديل الصلاحيات--}}
                                </button>

                                {{-- زر حذف الدور --}}
                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn py-1  mx-2  btn-danger rounded-3" title="حذف" data-bs-toggle="modal" data-bs-target="#deleteRoleModal" data-role-id="{{ $role->id }}">
                                        <i class="fa fa-trash"></i>
{{--                                        حذف--}}
                                    </button>
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
                                            <h5 class="modal-title text-dark-blue ms-4 me-2" id="editRoleModalLabel{{ $role->id }}">تعديل صلاحيات الدور: {{ $role->name }}</h5>
                                            <div class="mx-5"></div>
                                            <button type="button" class="btn-close   me-5" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                @foreach($permissions as $permission)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm{{ $role->id }}_{{ $permission->id }}"
                                                            {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                                                        <label class="form-check-label text-dark-blue" for="perm{{ $role->id }}_{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endforeach
                    </tbody>
                </table>
                        </div>
            </div>
                </div>

            {{-- تبويب الصلاحيات --}}
            <div class="tab-pane fade" id="permissions" role="tabpanel" aria-labelledby="permissions-tab">
                {{-- إضافة صلاحية جديدة --}}
                    <form method="POST" action="{{ route('admin.permissions.store') }}" class="mb-4">
                        @csrf
                        <div class="row g-3 align-items-center">

                            <div class="col-md-8 col-lg-9">
                                <input type="text" name="name"
                                       class="form-control summary-input w-100 @error('name') is-invalid @enderror"
                                       placeholder="أدخل اسم الصلاحية الجديدة" style="text-align: right;" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-md-4 col-lg-3">
                                <button class="btn btn-blue w-100" type="submit">إضافة صلاحية</button>
                            </div>
                        </div>
                    </form>

                    {{-- جدول عرض الصلاحيات --}}
                    <div class="table-responsive ">
                        <table class="table table-hover align-middle text-center table-striped custom-invoice-table" >
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
                                    <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" style="display:inline-block;" >
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-link p-0 m-0 text-danger" title="حذف" data-bs-toggle="modal" data-bs-target="#deletePermissionsModal" data-permissions-id="{{ $permission->id }}">  <i class="fa fa-trash"></i> </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>

            </div>
            {{-- تبويب إسناد الأدوار --}}
            <div class="tab-pane fade" id="assign" role="tabpanel" aria-labelledby="assign-tab">

                    <div class="row g-2 align-items-center mb-3">
                <form method="POST" action="{{ route('admin.assign_role') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="employee_id" class="form-label fw-bold">اختر الموظف</label>
                        <select name="employee_id" id="employee_id" class="summary-input text-end flex-grow-1 w-100 w-md-auto" required>
                            <option value="" selected disabled>اختر الموظف</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }} ({{ $employee->phone }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="role_id" class="form-label fw-bold">اختر الدور</label>
                        <select name="role_id" id="role_id" class="summary-input text-end flex-grow-1 w-100 w-md-auto" required>
                            <option value="" selected disabled>اختر الدور</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-blue">إسناد الدور للموظف</button>
                    </div>
                </form>
                <hr class="my-4"/>

                        <h5 class="mb-5 mb-md-0" style="color: var(--dark-blue);"> قائمة الموظفين وأدوارهم </h5>
                <div class="table-responsive ">
                        <table class="table table-hover align-middle text-center table-striped custom-invoice-table" >
                            <thead class="table-light">
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
                                        <span>{{ $role->name }}</span>
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


    </div>
    </div>

    <!-- Delete Confirmation Permissions Modal -->
    <div class="modal fade" id="deletePermissionsModal" tabindex="-1" aria-labelledby="deletePermissionsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                </div>
                <div class="modal-body text-center">
                    <p>هل أنت متأكد أنك تريد حذف هذه الصلاحية؟</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <form method="POST" id="delete-permissions-form" action="{{route('admin.permissions.destroy', $permission->id)}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">نعم، حذف</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Role Modal -->
    <div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                </div>
                <div class="modal-body text-center">
                    <p>هل أنت متأكد أنك تريد حذف هذا الدور؟</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <form method="POST" id="delete-role-form" action="{{route('admin.roles.destroy', $role->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">نعم، حذف</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const deletePermissionsModal = document.getElementById('deletePermissionsModal');
        deletePermissionsModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const permissionsId = button.getAttribute('data-permissions-id');

            const form = document.getElementById('delete-permissions-form');
            // form.action = `/admin/permissions/${permissionsId}`;
        });

        const deleteRoleModal = document.getElementById('deleteRoleModal');
        deleteRoleModal.addEventListener('show.bs.roleModal', function (event) {
            const button = event.relatedTarget;
            const roleId = button.getAttribute('data-Role-id');

            const form = document.getElementById('delete-role-form');
            // form.action = `/admin/permissions/${permissionsId}`;
        });
    </script>

@endsection
