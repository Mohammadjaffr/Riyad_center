<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>فاتورة مبيعات</title>
    <style>
        body {
            font-family: 'amiri', DejaVu Sans, sans-serif;
            direction: rtl;
            text-align: right;
            font-size: 14px;
        }

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
        }

        table, th, td {
            border: 1px solid #999;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        .summary {
            margin-top: 25px;
            font-size: 16px;
            font-weight: bold;
        }

        .thanks {
            margin-top: 40px;
            font-size: 18px;
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>

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
        <th>اللون والمقاس</th>
        <th>الكمية</th>
        <th>سعر الوحدة</th>
        <th>الإجمالي</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($invoice->items as $item)
        <tr>
            <td>{{ $item->productVariant->product->name ?? '-' }}</td>
            <td>{{ $item->productVariant->product->model_num ?? '-' }}</td>
            <td>{{ $item->productVariant->color }} - {{ $item->productVariant->size }}</td>
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

</body>
</html>
