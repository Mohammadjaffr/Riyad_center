@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>قائمة الموردين</h2>

        <a href="{{ route('suppliers.create') }}" class="btn btn-primary mb-3">إضافة مورد جديد</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>الاسم</th>
                <th>الهاتف</th>
                <th>العنوان</th>
                <th>القسم</th>
                <th>التحكم</th>
            </tr>
            </thead>
            <tbody>
            @foreach($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->phone }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>{{ $supplier->department->name ?? '—' }}</td>
                    <td>
                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline-block;">
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
