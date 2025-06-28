@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2 class="mb-4">قائمة المبيعات</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3 text-end">
            <a href="{{ route('sales.create') }}" class="btn btn-primary">إضافة عملية بيع</a>
        </div>

        <table class="table table-bordered text-center">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>الزبون</th>
                <th>القسم</th>
                <th>المبلغ</th>
                <th>الموظف</th>
                <th>ملاحظات</th>
            </tr>
            </thead>
            <tbody>
            @forelse($sales as $sale)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sale->customer_name ?? '-' }}</td>
                    <td>{{ $sale->department->name ?? '-' }}</td>
                    <td>{{ number_format($sale->total_amount, 2) }}</td>
                    <td>{{ $sale->employee->name ?? '-' }}</td>
                    <td>{{ $sale->notes ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">لا توجد مبيعات حتى الآن</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection
