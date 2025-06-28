@extends('layouts.master')
@section('title', 'الفواتير')
@section('content')

    <div class="container">
        <h2 class="mb-3">قائمة الفواتير</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">+ إضافة فاتورة</a>

        <table class="table table-bordered text-center">
            <thead class="table-light">
            <tr>
                <th>رقم الفاتورة</th>
                <th>العميل</th>
                <th>القسم</th>
                <th>الموظف</th>
                <th>الإجمالي</th>
                <th>المدفوع</th>
                <th>المتبقي</th>
                <th>تاريخ</th>
            </tr>
            </thead>
            <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_num }}</td>
                    <td>{{ $invoice->customer_name ?? '-' }}</td>
                    <td>{{ $invoice->department->name }}</td>
                    <td>{{ $invoice->employee->name }}</td>
                    <td>{{ number_format($invoice->total_amount, 2) }}</td>
                    <td>{{ number_format($invoice->paid_amount, 2) }}</td>
                    <td>{{ number_format($invoice->rest_amount, 2) }}</td>
                    <td>{{ $invoice->invoice_date }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
