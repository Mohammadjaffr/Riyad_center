@extends('layouts.master')
@section('title', 'إضافة دفعة')
@section('content')
    <div class="container">
        <h2>إضافة دفعة جديدة</h2>

        <form action="{{ route('payments.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>اختر الفاتورة</label>
                <select name="invoice_id" class="form-select">
                    @foreach($invoices as $invoice)
                        <option value="{{ $invoice->id }}">فاتورة رقم {{ $invoice->invoice_num }} - {{ $invoice->customer_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>المبلغ</label>
                <input type="number" step="0.01" name="amount" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>تاريخ الدفع</label>
                <input type="date" name="payment_date" class="form-control" value="{{ date('Y-m-d') }}">
            </div>

            <div class="mb-3">
                <label>طريقة الدفع</label>
                <select name="payment_method" class="form-select">
                    <option value="نقدي">نقدي</option>
                    <option value="تحويل">تحويل</option>
                    <option value="آجل">آجل</option>
                </select>
            </div>

            <div class="mb-3">
                <label>ملاحظات</label>
                <textarea name="notes" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">حفظ</button>
        </form>
    </div>
@endsection
