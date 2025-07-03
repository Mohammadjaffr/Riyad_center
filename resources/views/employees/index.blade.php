@extends('layouts.master')
@section('title' ,'عرض الموظفين')
@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">قائمة الموظفين</h2>
            <a href="{{ route('employees.create') }}" class="btn btn-blue mb-2 mb-md-0">
                <i class="fa fa-plus"></i>إضافة موظف جديد
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-4 p-3 shadow-sm mb-3">
            <div class="row g-2 align-items-center mb-3">
                <form method="GET" action="{{ route('employees.index') }}" class="col-md-6 col-lg-4 mb-3">
                    <div class="input-group">
                        <input
                            type="text"
                            name="search"
                            class="form-control summary-input flex-grow-1 w-100 w-md-auto"
                            placeholder="ابحث برقم الموضف أو اسم الموظف..."
                            value="{{ request('search') }}"
                            style="text-align: right;height: 43px!important;"
                        >
                        <button class="btn btn-blue position-absolute rounded-circle my-1 " style="left:25px;" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>


                <div class="col-2 col-md-7"></div>
                <div class="col-4 col-md-1 text-center mb-2 mb-md-0">
                    <!-- زر لفتح المودال -->
                    <button type="button" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fa fa-filter"></i> فلترة
                    </button>
                </div>
            </div>
            <div class="table-responsive ">
                <table class="table table-hover align-middle text-center table-striped custom-invoice-table" style="min-width: 900px;">
                    <thead class="table-light">
                    <tr>
                        <th>الاسم</th>
                        <th>رقم الهاتف</th>
                        <th>الحالة</th>
                        <th>الدور</th>
                        <th>الراتب</th>
                        <th>القسم</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($employees as $emp)
                        <tr>
                            <td>{{ $emp->name }}</td>
                            <td>{{ $emp->phone }}</td>
                            <td>{{ $emp->status }}</td>
                            <td>{{ $emp->role }}</td>
                            <td>{{ $emp->salary }}</td>
                            <td>{{ $emp->department->name ?? '—' }}</td>
                            <td>
                                <a href="{{ route('employees.edit', $emp->id) }}" class="text-success me-2 ms-3" title="تعديل"><i class="fa fa-pen"></i></a>

                                <form action="{{ route('employees.destroy', $emp->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
{{--                                    <button class="btn btn-link p-0 m-0 text-danger" onclick="return confirm('هل أنت متأكد؟')"><i class="fa fa-trash"></i></button>--}}
                                    <button type="button" class="btn btn-link p-0 m-0 text-danger" title="حذف" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $emp->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 bg-white">
                <div class="modal-header">
                    <h5 class="modal-title text-dark-blue" id="filterModalLabel">فلترة الموظفين</h5>
                </div>

                <form method="GET" action="{{ route('employees.index') }}">
                    <div class="modal-body">
                        <div class="row g-3 text-dark-blue">
                            <!-- حقل البحث -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">بحث بالاسم أو رقم الهاتف</label>
                                <input
                                    type="text"
                                    id="search"
                                    name="search"
                                    class="summary-input flex-grow-1 w-100 w-md-auto"
                                    value="{{ request('search') }}"
                                    placeholder="مثال: أحمد، 775456789"
                                    autocomplete="off"
                                />
                            </div>

                            <!-- الترتيب -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">الترتيب حسب الاسم</label>
                                <select name="sort" class="summary-input flex-grow-1 w-100 w-md-auto text-dark-blue">
                                    <option value="" disabled {{ !request('sort') ? 'selected' : '' }}>اختر</option>
                                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>تصاعدي</option>
                                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>تنازلي</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- الأزرار -->
                    <div class="modal-footer justify-content-between">
                        <a href="{{ route('employees.index') }}" class="btn btn-outline-blue">
                            <i class="fa fa-undo"></i> إعادة تعيين
                        </a>
                        <button type="submit" class="btn btn-blue">
                            <i class="fa fa-search"></i> تطبيق الفلتر
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3">
                <div class="modal-header bg-danger text-white ">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                </div>
                <div class="modal-body text-center">
                    <p>هل أنت متأكد أنك تريد حذف هذا الموظف؟</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <form method="POST" id="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">نعم، حذف</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');

            const form = document.getElementById('delete-form');
            form.action = `/employees/${id}`;
        });
    </script>

@endsection

