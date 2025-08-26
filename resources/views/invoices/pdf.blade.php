{{--@extends('layouts.head')--}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>فاتورة مبيعات - {{ $invoice->invoice_num }}</title>
    <style>
        @font-face {
            font-family: 'Amiri';
            src: url('{{ resource_path('fonts/Amiri-Regular.ttf') }}') format('truetype');
        }

        body {
            font-family: 'Amiri', 'Tahoma', sans-serif;
            direction: rtl;
            text-align: right;
            font-size: 14px;
            margin: 0;
            padding: 20px;
            background: #f8f9fa;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            /*border-bottom: 2px solid #e9ecef;*/
            padding-bottom: 20px;
        }


        .store-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e9ecef;
        }
        .store-logo img {
            width: 90px;
            height: auto;
            display: block;
        }
        .store-text {
            text-align: center;
        }
        .store-name {
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 4px;
        }
        .store-details {
            font-size: 13px;
            color: #495057;
            line-height: 1.6;
        }

        .table-container {
            margin: 30px 0;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .invoice-table th {
            background: #f6f6f6;
            color: #495057;
            font-weight: bold;
            padding: 15px 10px;
            text-align: center;
            border: 1px solid #dee2e6;
            font-size: 14px;
        }

        .invoice-table td {
            padding: 12px 10px;
            text-align: center;
            border: 1px solid #dee2e6;
            font-size: 13px;
        }

        .invoice-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .invoice-table tr:hover {
            background-color: #e9ecef;
        }
        .summary-table th,
        .summary-table td {
            padding: 12px 15px;
            text-align: center;
            /*border: 1px solid #dee2e6;*/
            font-size: 14px;
        }

        .summary-table th {
            background: #f6f6f6;
            color: #495057;
            font-weight: bold;
            width: 50%;
        }

        .summary-table td {
            background: #fff;
            color: #495057;
            font-weight: bold;
        }

        .notes-section {
            margin: 30px 0;
            padding: 20px;
            border-radius: 8px;
        }

        .notes-label {
            font-weight: bold;
            color: #495057;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .notes-content {
            color: #6c757d;
            font-size: 14px;
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e9ecef;
        }

        .thank-you {
            font-size: 18px;
            color: #2c3e50;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .company-info {
            color: #6c757d;
            font-size: 12px;
            margin-top: 10px;
        }

        @media print {
            body {
                background: #fff;
                padding: 0;
            }

            .container {
                box-shadow: none;
                border-radius: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Store Header: Logo + Shop details -->
        <div class="store-header">
            <div class="store-logo">
                <img src="{{ public_path('assets/images/logo.png') }}" alt="Logo" style="width:80px;height: 80px; margin-right: 45%">
            </div>
            <div class="store-text">
                <div class="store-name">مركز الرياض للملابس الرجالية الجاهزة والأحذية والبدلات</div>
                <div class="store-details">
                    العنوان: القطن - شارع رئيسي | هاتف: 05455555
                </div>
            </div>
        </div>
        <!-- Header Section -->
        <div class="header-row" style="border-bottom: none; padding-bottom: 0;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="text-align: right; width: 33%;"><span class="fw-bold">الاسم:</span> {{ $invoice->customer_name }}</td>
                    <td style="text-align: center; width: 34%;"><span class="fw-bold">رقم الفاتورة:</span> {{ $invoice->invoice_num }}</td>
                    <td style="text-align: left; width: 33%;"><span class="fw-bold">الموظف:</span> {{ $invoice->employee->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="text-align: right; width: 33%;"><span class="fw-bold">القسم:</span> {{ $invoice->department->name ?? '-' }}</td>
                    <td style="text-align: center; width: 34%;"><span class="fw-bold">تاريخ الإصدار:</span> {{ $invoice->invoice_date }}</td>
                    <td style="text-align: left; width: 33%;"><span class="fw-bold">طريقة الدفع:</span> {{ $invoice->payment_type }}</td>
                </tr>
            </table>
        </div>

        <!-- Items Table -->
        <div class="table-container">
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>المنتج</th>
                        <th>رقم الموديل</th>
                        <th>اللون والمقاس</th>
                        <th>الكمية</th>
                        <th>السعر للوحدة</th>
                        <th>الإجمالي</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->productVariant->product->name ?? '-' }}</td>
                            <td>{{ $item->productVariant->product->model_num ?? '-' }}</td>
                            <td>{{ $item->productVariant->color ?? '-' }} - {{ $item->productVariant->size ?? '-' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->unit_price, 2) }} ريال</td>
                            <td>{{ number_format($item->total_price, 2) }} ريال</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- Notes Section -->
        @if($invoice->notes)
            <div class="notes-section">
                <div class="notes-label">ملاحظات:</div>
                <div class="notes-content">{{ $invoice->notes }}</div>
            </div>
        @endif


        <!-- Summary  -->
        <div class="header-row" style="border-bottom: none; padding-bottom: 0;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="text-align: right; width: 33%;"><b>الإجمالي: {{ number_format($invoice->items->sum('total_price'), 2) }} ريال</b></td>
                    <td style="text-align: center; width: 34%;"><b>الخصم: {{ number_format($invoice->discount_amount, 2) }} ريال</b></td>
                </tr>
                <tr>
                    <td style="text-align: right; width: 33%;"><b >المدفوع: {{ number_format($invoice->paid_amount, 2) }} ريال</b></td>
                    <td style="text-align: center; width: 34%;"><b>المتبقي: {{ number_format($invoice->rest_amount, 2) }} ريال</b></td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
         <div class="footer">
            <div class="thank-you">شكرًا لتعاملكم معنا</div>
            <div class="company-info">
                مركز الرياض للملابس الرجالية الجاهزة والأحذية والبدلات  <br>
                جميع الحقوق محفوظة © {{ date('Y') }}
            </div>
        </div>
    </div>

</body>
</html>
