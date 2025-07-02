@extends('layouts.master')
@section('title', 'تقرير حركات المخزون')
@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">تقرير حركات المخزون</h2>
        </div>
        <div class="bg-white rounded-4 p-3 shadow-sm mb-3">
        <div class="row g-2 align-items-center mb-3">


            <div class="col-12 col-md-4">
{{--                <input type="text" class="form-control summary-input flex-grow-1 w-100 w-md-auto" placeholder="البحث ..." style="text-align: right;">--}}
                <form method="GET" class="mb-3">
                    <select name="type" class="summary-input text-end flex-grow-1 w-md-auto  w-100 d-inline-block">
                        <option value="" {{ request('type') == '' ? 'selected' : '' }}>كل الحركات</option>
                        <option value="شراء" {{ request('type') == 'شراء' ? 'selected' : '' }}>شراء</option>
                        <option value="بيع" {{ request('type') == 'بيع' ? 'selected' : '' }}>بيع</option>
                        <option value="مرتجع شراء" {{ request('type') == 'مرتجع شراء' ? 'selected' : '' }}>مرتجع شراء</option>
                        <option value="مرتجع بيع" {{ request('type') == 'مرتجع بيع' ? 'selected' : '' }}>مرتجع بيع</option>
                        <option value="تعديل يدوي" {{ request('type') == 'تعديل يدوي' ? 'selected' : '' }}>تعديل يدوي</option>
                    </select>

                </form>
            </div>
            <div class="col-12 col-md-7"></div>
            <div class="col-4 col-md-1 text-center mb-2 mb-md-0">
                <!-- زر لفتح المودال -->
                <button type="button" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="fa fa-filter"></i> فلترة
                </button>
            </div>
        </div>

        <div class="table-responsive ">
        <table class="table table-hover align-middle text-center table-striped custom-invoice-table" style="min-width: 900px;">
            <thead>
            <tr>
                <th>#</th>
                <th>المنتج</th>
                <th>المقاس</th>
                <th>اللون</th>
                <th>النوع</th>
                <th>الكمية</th>
                <th>الوصف</th>
                <th>الموظف</th>
                <th>تاريخ العملية</th>
            </tr>
            </thead>
            <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->productVariant->product->name ?? '-' }}</td>
                    <td>{{ $log->productVariant->size ?? '-' }}</td>
                    <td>{{ $log->productVariant->color ?? '-' }}</td>
                    <td>{{ __("{$log->change_type}") }}</td>
                    <td>{{ $log->quantity }}</td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->employee->name ?? '-' }}</td>
                    <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $logs->withQueryString()->links() }}
        </div>
    </div>
    </div>

@endsection
