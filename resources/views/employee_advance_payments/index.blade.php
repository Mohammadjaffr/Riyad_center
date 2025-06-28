@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>سجل السُلف</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('employee-advance-payments.create') }}" class="btn btn-primary mb-3">إضافة سلفة</a>

        <table class="table table-bordered text-center">
            <thead class="table-dark">
            <tr>
                <th>الموظف</th>
                <th>المبلغ</th>
                <th>السبب</th>
                <th>التاريخ</th>
                <th>الملاحظات</th>
                <th>أدخلت بواسطة</th>
                <th>تاريخ التسجيل</th>
            </tr>
            </thead>
            <tbody>
            @foreach($advances as $advance)
                <tr>
                    <td>{{ $advance->employee->name ?? '-' }}</td>
                    <td>{{ number_format($advance->amount, 2) }}</td>
                    <td>{{ $advance->reason }}</td>
                    <td>{{ $advance->payment_date }}</td>
                    <td>{{ $advance->notes ?? '-' }}</td>
                    <td>{{ $advance->creator->name ?? '-' }}</td>
                    <td>{{ $advance->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
