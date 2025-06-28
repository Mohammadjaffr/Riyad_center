@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>إضافة راتب</h2>

        <form method="POST" action="{{ route('employee-salaries.store') }}">
            @csrf

            <div class="mb-3">
                <label>الموظف</label>
                <select name="employee_id" class="form-control" required>
                    @foreach($employees as $emp)
                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>المبلغ</label>
                <input type="number" step="0.01" name="amount" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>تاريخ الدفع</label>
                <input type="date" name="pay_date" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="mb-3">
                <label>ملاحظات</label>
                <textarea name="notes" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">حفظ</button>
        </form>
    </div>@endsection
