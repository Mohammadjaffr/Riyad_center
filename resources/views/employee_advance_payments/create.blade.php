@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>إضافة سلفة / دفعة مقدمة لموظف</h2>

        <form method="POST" action="{{ route('employee-advance-payments.store') }}">
            @csrf

            <div class="mb-3">
                <label for="employee_id" class="form-label">الموظف</label>
                <select name="employee_id" class="form-control" required>
                    <option value="">اختر موظف</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">المبلغ</label>
                <input type="number" step="0.01" name="amount" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="payment_date" class="form-label">تاريخ الصرف</label>
                <input type="date" name="payment_date" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="mb-3">
                <label for="reason" class="form-label">سبب الصرفية</label>
                <textarea name="reason" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">ملاحظات إضافية (اختياري)</label>
                <textarea name="notes" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">حفظ السلفة</button>
        </form>
    </div>@endsection
