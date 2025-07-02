@extends('layouts.master')
@section('title' ,'الجرد السنوي')
@section('content')

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);"> تقرير الجرد السنوي - {{ now()->year }}</h2>

        </div>
        <div class="bg-white rounded-4 p-3 shadow-sm">
            <div class="table-responsive">
                <form method="GET" class="row g-3 mb-3">
                    <div class="col-md-3">
                        <select name="product_id" class="summary-input text-end flex-grow-1 w-100 w-md-auto">
                            <option value="">كل المنتجات</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="employee_id" class="summary-input text-end flex-grow-1 w-100 w-md-auto">
                            <option value="">كل الموظفين</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}" {{ request('employee_id') == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <input type="date" name="date_from" class="summary-input text-end flex-grow-1 w-100 w-md-auto" value="{{ request('date_from') }}">
                    </div>

                    <div class="col-md-2">
                        <input type="date" name="date_to" class="summary-input text-end flex-grow-1 w-100 w-md-auto" value="{{ request('date_to') }}">
                    </div>

                    <div class="col-4 col-md-1 text-center mb-2 mb-md-0">
                        <!-- زر لفتح المودال -->
                        <button type="button" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#filterModal">
                            <i class="fa fa-filter"></i> فلترة
                        </button>
                    </div>
                </form>

                    <table class="table table-hover align-middle text-center table-striped custom-invoice-table" style="min-width: 900px;">                    <thead class="table-light">
                    <tr>
                        <th>المنتج</th>
                        <th>النوع</th>
                        <th>الكمية</th>
                        <th>الوصف</th>
                        <th>الموظف</th>
                        <th>التاريخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->product->name ?? '-' }}</td>
                            <td>{{ $log->change_type }}</td>
                            <td>{{ $log->quantity }}</td>
                            <td>{{ $log->description ?? '-' }}</td>
                            <td>{{ $log->employee->name ?? '-' }}</td>
                            <td>{{ $log->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ route('inventory-logs.index') }}" class="btn btn-blue mb-3"> عودة لسجل المخزون</a>
                <a href="#" onclick="window.print()" class="btn btn-outline-blue mb-3">
                     طباعة التقرير
                </a>
                <a href="{{ route('inventory-logs.pdf', $type) }}?{{ http_build_query(request()->all()) }}" class="btn btn-outline-danger mb-3">
                     PDF
                </a>
            </div>
        </div>
    </div>
    @php
        $totalBuy = $logs->where('change_type', 'شراء')->sum('quantity');
        $totalSell = $logs->where('change_type', 'بيع')->sum('quantity');
        $profit = $totalSell - $totalBuy;
    @endphp
    <div class="container py-4">
    <div class="bg-white rounded-4 p-3 shadow-sm text-center">

        <h5 class="mb-3 mb-md-0" style="color: var(--dark-blue);"> الملخص المالي</h5>

        <div class="row justify-content-center mt-4">
            <div class="col-md-5">
                <table class="table table-hover align-middle text-center table-striped  table-sm">
                    <tr>
                        <th>مجموع المشتريات</th>
                        <td class="text-end">{{ $totalBuy }} وحدة</td>
                    </tr>
                    <tr>
                        <th>مجموع المبيعات:</th>
                        <td class="text-end">{{ $totalSell }} وحدة</td>
                    </tr>
                    <tr>
                        <th>صافي الربح:</th>
                        <td class="text-end">{{ $profit }} وحدة</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
    </div>
{{--    <div class="mt-4 alert alert-info">--}}
{{--        <strong>الملخص المالي:</strong><br>--}}
{{--        🔹 مجموع المشتريات: {{ $totalBuy }} وحدة<br>--}}
{{--        🔹 مجموع المبيعات: {{ $totalSell }} وحدة<br>--}}
{{--        🔸 صافي الربح: {{ $profit }} وحدة--}}
{{--    </div>--}}

@endsection
