@extends('layouts.master')
@section('title', 'الفواتير')
@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">قائمة الفواتير</h2>
            <a href="{{ route('invoices.create') }}" class="btn btn-new-invoice mb-2 mb-md-0">
                <i class="fa fa-plus"></i> إضافة فاتورة
            </a>
        </div>
        <div class="bg-white rounded-4 p-3 shadow-sm mb-3">
            <div class="row g-2 align-items-center mb-3">


                <div class="col-12 col-md-4">
                    <input type="text" class="form-control summary-input flex-grow-1 w-100 w-md-auto" placeholder="البحث ..." style="text-align: right;">
                </div>
                <div class="col-12 col-md-7"></div>
                <div class="col-12 col-md-1 text-center mb-2 mb-md-0">
                    <button class="summary-input flex-grow-1 w-100 w-md-auto" style="border-radius: 10px;">
                        <i class="fa fa-filter"></i>

                    </button>
                </div>
            </div>
            <div class="table-responsive ">
                <table class="table table-hover align-middle text-center table-striped custom-invoice-table" style="min-width: 900px;">
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
        </div>
    </div>

@endsection

