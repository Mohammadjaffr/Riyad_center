@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>سجل المخزون</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('inventory-logs.create') }}" class="btn btn-primary mb-3">إضافة تعديل يدوي</a>

        <table class="table table-bordered text-center">
            <thead class="table-light">
            <tr>
                <th>المنتج</th>
                <th>النوع</th>
                <th>الكمية</th>
                <th>الوصف</th>
                <th>الموظف</th>
                <th>التاريخ</th>
            </tr>
            </thead>
            <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->product->name ?? '-' }}</td>
                    <td>{{ $log->change_type }}</td>
                    <td>{{ $log->quantity }}</td>
                    <td>{{ $log->description ?? '-' }}</td>
                    <td>{{ $log->employee->name ?? '-' }}</td>
                    <td>{{ $log->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
