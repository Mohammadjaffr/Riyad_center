@extends('layouts.master')
@section('title' ,'عرض الموظفين')
@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">قائمة الموظفين</h2>
            <a href="{{ route('employees.create') }}" class="btn btn-new-invoice mb-2 mb-md-0">
                <i class="fa fa-plus"></i>إضافة موظف جديد
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-4 p-3 shadow-sm mb-3">
            <div class="row g-2 align-items-center mb-3">


                <div class="col-12 col-md-4">
                    <input type="text" class="form-control summary-input flex-grow-1 w-100 w-md-auto" placeholder="البحث ..." style="text-align: right;">
                </div>
                <div class="col-12 col-md-7"></div>
                <div class="col-12 col-md-1 text-center mb-2 mb-md-0">
                    <button class="summary-input flex-grow-1 w-100 w-md-auto" style="border-radius: 10px;">
                        <i class="fa fa-filter"></i>

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
                                    <button class="btn btn-link p-0 m-0 text-danger" onclick="return confirm('هل أنت متأكد؟')"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

