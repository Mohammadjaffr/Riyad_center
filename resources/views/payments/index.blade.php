@extends('layouts.master')
@section('title', 'سجل الدفعات')
@section('content')
    <div class="container">
        <h2 class="mb-4">سجل الدفعات</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('payments.create') }}" class="btn btn-primary mb-3">إضافة دفعة جديدة</a>

        <table class="table table-bordered text-center">
            <thead class="table-light">
            <tr>
                <th>رقم الفاتورة</th>
                <th>اسم العميل</th>
                <th>المبلغ</th>
                <th>تاريخ الدفع</th>
                <th>طريقة الدفع</th>
                <th>ملاحظات</th>
                <th>أدخلت بواسطة</th>
                <th>تاريخ التسجيل</th>
            </tr>
            </thead>
            <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->invoice->invoice_num ?? '-' }}</td>
                    <td>{{ $payment->invoice->customer_name ?? '-' }}</td>
                    <td>{{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->payment_date }}</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ $payment->notes ?? '-' }}</td>
                    <td>{{ $payment->creator->name ?? '-' }}</td>
                    <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
