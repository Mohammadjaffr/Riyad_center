@extends('layouts.master')

@section('title', 'عرض الفاتورة')

@section('content')
    <div class="container my-4" style="background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.1); direction: rtl; font-family: 'Tahoma', sans-serif;">

        {{-- الشعار + عنوان الفاتورة --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="max-height: 80px;">
            </div>
            <div class="text-end">
                <h4 class="mb-0">فاتورة مبيعات</h4>
                <small>رقم الفاتورة: {{ $invoice->invoice_num }}</small><br>
                <small>تاريخ الإصدار: {{ $invoice->invoice_date }}</small>
            </div>
        </div>

        {{-- بيانات العميل --}}
        <div class="mb-4">
            <h6 class="fw-bold">معلومات العميل:</h6>
            <p class="mb-0">الاسم: {{ $invoice->customer_name }}</p>
            <p class="mb-0">القسم: {{ $invoice->department->name ?? '-' }}</p>
            <p class="mb-0">الموظف: {{ $invoice->employee->name ?? '-' }}</p>
            <p class="mb-0">طريقة الدفع: {{ $invoice->payment_type }}</p>
        </div>

        {{-- تفاصيل العناصر --}}
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead style="background: #f6f6f6;">
                <tr>
                    <th>#</th>
                    <th>المنتج</th>
                    <th>رقم الموديل</th>
                    <th>الكمية</th>
                    <th>السعر للوحدة</th>
                    <th>الإجمالي</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoice->items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->product->name ?? '' }}</td>
                        <td>{{ $item->product->model_num ?? '-' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->unit_price, 2) }}</td>
                        <td>{{ number_format($item->total_price, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{-- ملخص الحساب --}}
        <div class="row justify-content-end mt-4">
            <div class="col-md-5">
                <table class="table table-sm">
                    <tr>
                        <th>الإجمالي</th>
                        <td>{{ number_format($invoice->items->sum('total_price'), 2) }}</td>
                    </tr>
                    <tr>
                        <th>الخصم</th>
                        <td>{{ number_format($invoice->discount_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>المدفوع</th>
                        <td>{{ number_format($invoice->paid_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>المتبقي</th>
                        <td>{{ number_format($invoice->rest_amount, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- ملاحظات وتوقيع --}}
        <div class="mt-4">
            <p><strong>ملاحظات:</strong> {{ $invoice->notes ?? 'لا توجد ملاحظات' }}</p>
        </div>

        {{-- زر طباعة --}}
        <div class="text-center mt-4">
            <a   href="{{ route('invoices.print', $invoice->id) }}"class="btn btn-success">طباعة</a>
        </div>

    </div>
@endsection
