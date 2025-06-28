@extends('layouts.master')

@section('title', 'طباعة الفاتورة')

@section('content')
    <style>
        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
        .info {
            margin: 5px 0;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
            direction: rtl;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        tbody tr:hover {
            background-color: #f2f2f2;
        }
        div.summary {
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
        }
        div.thanks {
            margin-top: 40px;
            font-size: 18px;
            text-align: center;
            color: #333;
        }
    </style>

    <div class="header">فاتورة مبيعات</div>

    <div class="info"><strong>رقم الفاتورة:</strong> {{ $invoice->invoice_num }}</div>
    <div class="info"><strong>اسم العميل:</strong> {{ $invoice->customer_name }}</div>
    <div class="info"><strong>القسم:</strong> {{ $invoice->department->name ?? '-' }}</div>
    <div class="info"><strong>الموظف:</strong> {{ $invoice->employee->name ?? '-' }}</div>
    <div class="info"><strong>تاريخ الفاتورة:</strong> {{ $invoice->invoice_date }}</div>

    <table>
        <thead>
        <tr>
            <th>المنتج</th>
            <th>رقم الموديل</th>
            <th>الكمية</th>
            <th>السعر للوحدة</th>
            <th>الإجمالي</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($invoice->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->product->model_num }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->unit_price, 2) }}</td>
                <td>{{ number_format($item->total_price, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="summary"><strong>الإجمالي:</strong> {{ number_format($invoice->items->sum('total_price'), 2) }} ريال</div>
    <div class="summary"><strong>الخصم:</strong> {{ number_format($invoice->discount_amount, 2) }} ريال</div>
    <div class="summary"><strong>المدفوع:</strong> {{ number_format($invoice->paid_amount, 2) }} ريال</div>
    <div class="summary"><strong>المتبقي:</strong> {{ number_format($invoice->rest_amount, 2) }} ريال</div>

    <div class="thanks">شكرًا لتعاملكم معنا 🌟</div>
@endsection
