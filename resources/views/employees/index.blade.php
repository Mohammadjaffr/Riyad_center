@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>قائمة الموظفين</h2>

        <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">إضافة موظف جديد</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
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
                        <a href="{{ route('employees.edit', $emp->id) }}" class="btn btn-sm btn-warning">تعديل</a>

                        <form action="{{ route('employees.destroy', $emp->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
