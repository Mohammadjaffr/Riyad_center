@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>رواتب الموظفين</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('employee-salaries.create') }}" class="btn btn-primary mb-3">إضافة راتب</a>

        <table class="table table-bordered text-center">
            <thead class="table-light">
            <tr>
                <th>الموظف</th>
                <th>المبلغ</th>
                <th>تاريخ الدفع</th>
                <th>ملاحظات</th>
                <th>تاريخ الإدخال</th>
            </tr>
            </thead>
            <tbody>
            @foreach($salaries as $salary)
                <tr>
                    <td>{{ $salary->employee->name ?? '-' }}</td>
                    <td>{{ number_format($salary->amount, 2) }}</td>
                    <td>{{ $salary->pay_date }}</td>
                    <td>{{ $salary->notes ?? '-' }}</td>
                    <td>{{ $salary->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
