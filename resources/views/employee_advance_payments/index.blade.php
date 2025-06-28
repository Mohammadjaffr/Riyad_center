@extends('layouts.master')
@section('title' ,' سجل السُلف')
@section('content')

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">سجل السُلف</h2>
            <a href="{{ route('employee-advance-payments.create') }}" class="btn btn-new-invoice mb-2 mb-md-0">
                <i class="fa fa-plus"></i>إضافة سلفة
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

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
                        <th>السبب</th>
                        <th>التاريخ</th>
                        <th>الملاحظات</th>
                        <th>أدخلت بواسطة</th>
                        <th>تاريخ التسجيل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($advances as $advance)
                        <tr>
                            <td>{{ $advance->employee->name ?? '-' }}</td>
                            <td>{{ number_format($advance->amount, 2) }}</td>
                            <td>{{ $advance->reason }}</td>
                            <td>{{ $advance->payment_date }}</td>
                            <td>{{ $advance->notes ?? '-' }}</td>
                            <td>{{ $advance->creator->name ?? '-' }}</td>
                            <td>{{ $advance->created_at }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

