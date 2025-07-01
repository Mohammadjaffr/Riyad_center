@extends('layouts.master')
@section('title' ,'الجرد الشهري')
@section('content')

    <div class="container py-4">
        <h2 class="mb-4" style="color: var(--dark-blue);">📅 تقرير الجرد الشهري - {{ now()->format('Y/m') }}</h2>

        <div class="bg-white rounded-4 p-3 shadow-sm">
            <div class="table-responsive">
                <form method="GET" class="row g-3 mb-3">
                    <div class="col-md-3">
                        <select name="product_id" class="form-control">
                            <option value="">كل المنتجات</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="employee_id" class="form-control">
                            <option value="">كل الموظفين</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}" {{ request('employee_id') == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                    </div>

                    <div class="col-md-2">
                        <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">تصفية</button>
                    </div>
                </form>

                <table class="table table-hover align-middle text-center table-striped">
                    <thead class="table-light">
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
                <a href="{{ route('inventory-logs.index') }}" class="btn btn-secondary mb-3">← عودة لسجل المخزون</a>
                <a href="#" onclick="window.print()" class="btn btn-outline-success mb-3">
                    🖨 طباعة التقرير
                </a>
                <a href="{{ route('inventory-logs.pdf', $type) }}?{{ http_build_query(request()->all()) }}" class="btn btn-outline-danger">
                    🧾 PDF
                </a>
            </div>
        </div>
    </div>
    @php
        $totalBuy = $logs->where('change_type', 'شراء')->sum('quantity');
        $totalSell = $logs->where('change_type', 'بيع')->sum('quantity');
        $profit = $totalSell - $totalBuy;
    @endphp

    <div class="mt-4 alert alert-info">
        <strong>الملخص المالي:</strong><br>
        🔹 مجموع المشتريات: {{ $totalBuy }} وحدة<br>
        🔹 مجموع المبيعات: {{ $totalSell }} وحدة<br>
        🔸 صافي الربح: {{ $profit }} وحدة
    </div>


@endsection
