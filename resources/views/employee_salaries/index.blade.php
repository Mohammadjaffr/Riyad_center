@extends('layouts.master')
@section('title', 'الرواتب')
@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">رواتب الموظفين</h2>
            <a href="{{ route('employee-salaries.create') }}" class="btn btn-new-invoice mb-2 mb-md-0">
                <i class="fa fa-plus"></i>إضافة راتب
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
                        <th>الموظف</th>
                        <th>المبلغ</th>
                        <th>تاريخ الدفع</th>
                        <th>ملاحظات</th>
                        <th>تاريخ الإدخال</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salaries as $salary)
                        <tr>
                            <td>{{ $salary->employee->name ?? '-' }}</td>
                            <td>{{ number_format($salary->amount, 2) }}</td>
                            <td>{{ $salary->pay_date }}</td>
                            <td>{{ $salary->notes ?? '-' }}</td>
                            <td>{{ $salary->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

