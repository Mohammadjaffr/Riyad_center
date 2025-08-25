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

        .logo-section {
            text-align: center;
            flex: 1;
        }

        .logo {
            max-width: 80px;
            margin-bottom: 10px;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            margin: 0;
        }

        .invoice-info {
            text-align: center;
            margin-top: -10px;
        }

        .invoice-number {
            font-size: 16px;
            font-weight: bold;
            color: #495057;
            margin: 5px 0;
        }

        .invoice-date {
            font-size: 14px;
            color: #6c757d;
            margin: 5px 0;
        }

        .customer-info {
            flex: 1;
            text-align: right;
        }

        .employee-info {
            margin-top: -110px;
            flex: 1;
            text-align: left;
        }

        .info-label {
            font-weight: bold;
            color: #495057;
            margin: 8px 0;
            font-size: 16px;
        }

        .info-value {
            color: #6c757d;
            margin: 5px 0;
            font-size: 14px;
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

        .summary-section {
            margin: 30px 0;
        }

        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #007bff;
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
            color: #28a745;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .company-info {
            color: #6c757d;
            font-size: 12px;
            margin-top: 10px;
        }

        .page-break {
            page-break-before: always;
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
        <!-- Header Section -->
        <div class="header-row">



            <div class="row align-items-center ">
            <!-- Right Info -->
            <div class="customer-info">

                <p class="mb-0 form-label fw-bold"><b>الاسم: {{ $invoice->customer_name }}</b></p>
                <p class="mb-0 form-label fw-bold"><b>القسم: {{ $invoice->department->name ?? '-' }}</b></p>

            </div>
                <!-- Logo Center -->
                <div class="invoice-info">
{{--                    <img src="{{asset('assets/images/logo.png')}}" alt="Logo" style="max-width: 100px;">--}}
                    <div class="">
                        <small  class="form-label fw-bold"><b>رقم الفاتورة: {{ $invoice->invoice_num }}</b></small><br>
                        <small  class="form-label fw-bold"><b>تاريخ الإصدار: {{ $invoice->invoice_date }}</b></small>
                    </div>
                </div>
            <!-- left Info -->
            <div class="employee-info">

                <p class="mb-0 form-label fw-bold"> <b> الموظف:{{ $invoice->employee->name ?? '-' }}</b></p>
                <p class="mb-0 form-label fw-bold"> <b> طريقة الدفع:{{ $invoice->payment_type }}</b></p>

            </div>
            </div>


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

        <!-- Summary Section -->
        <div class="summary-section">
            <table class="summary-table">
                <tr>
                    <th>الإجمالي</th>
                    <td>{{ number_format($invoice->items->sum('total_price'), 2) }} ريال</td>
                </tr>
                <tr>
                    <th>الخصم</th>
                    <td>{{ number_format($invoice->discount_amount, 2) }} ريال</td>
                </tr>
                <tr>
                    <th>المدفوع</th>
                    <td>{{ number_format($invoice->paid_amount, 2) }} ريال</td>
                </tr>
                <tr>
                    <th>المتبقي</th>
                    <td>{{ number_format($invoice->rest_amount, 2) }} ريال</td>
                </tr>
            </table>
        </div>

        <!-- Notes Section -->
        @if($invoice->notes)
            <div class="notes-section">
                <div class="notes-label">ملاحظات:</div>
                <div class="notes-content">{{ $invoice->notes }}</div>
            </div>
        @endif

        <!-- Footer -->
        <!-- <div class="footer">
            <div class="thank-you">شكرًا لتعاملكم معنا 🌟</div>
            <div class="company-info">
                مركز الرياض للملابس والأحذية<br>
                جميع الحقوق محفوظة © {{ date('Y') }}
            </div>
        </div>
    </div> -->
    </div>
</body>
</html>
