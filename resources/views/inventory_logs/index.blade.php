@extends('layouts.master')
@section('title', 'سجل المخزون')
@section('content')

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">سجل المخزون</h2>
            <a href="{{ route('inventory-logs.create') }}" class="btn btn-new-invoice mb-2 mb-md-0">
                <i class="fa fa-plus"></i> إضافة تعديل يدوي
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-4 p-3 shadow-sm mb-3">
            <div class="d-flex gap-2 mb-3 flex-wrap">
                <a href="{{ route('inventory-logs.report', ['type' => 'current']) }}" class="btn btn-outline-primary">📦 الجرد الحالي</a>
                <a href="{{ route('inventory-logs.report', ['type' => 'monthly']) }}" class="btn btn-outline-secondary">📅 الجرد الشهري</a>
                <a href="{{ route('inventory-logs.report', ['type' => 'yearly']) }}" class="btn btn-outline-dark">🗓 الجرد السنوي</a>
            </div>

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

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center table-striped custom-invoice-table" style="min-width: 900px;">
                    <thead class="table-light">
                    <tr>
                        <th>الكمية الحالية</th>
                        <th>المنتج</th>
                        <th>المقاس</th>
                        <th>اللون</th>
                        <th>نوع الحركة</th>
                        <th>الكمية</th>
                        <th>الوصف</th>
                        <th>الموظف</th>
                        <th>التاريخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->productVariant->current_stock ?? '-' }}</td>
                            <td>{{ $log->productVariant->product->name ?? '-' }}</td>
                            <td>{{ $log->productVariant->size ?? '-' }}</td>
                            <td>{{ $log->productVariant->color ?? '-' }}</td>
                            <td>{{ $log->change_type }}</td>
                            <td>{{ $log->quantity }}</td>
                            <td>{{ $log->description ?? '-' }}</td>
                            <td>{{ $log->employee->name ?? '-' }}</td>
                            <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
