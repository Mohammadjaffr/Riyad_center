@extends('layouts.head')
@section('title' ,'الجرد الحالي')
{{--@section('content')--}}

    <div class="container py-4 " dir="rtl">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0 " style="color: var(--dark-blue);"> تقرير الجرد الحالي - {{ now()->format('Y/m') }}</h2>

        </div>
        <div class="bg-white rounded-4 p-3 shadow-sm">
            <div class="table-responsive">
{{--                <form method="GET" class="row g-3 mb-3">--}}
{{--                    <div class="col-md-3">--}}
{{--                        <select name="product_id" class="summary-input text-end flex-grow-1 w-100 w-md-auto">--}}
{{--                            <option value="">كل المنتجات</option>--}}
{{--                            @foreach($products as $product)--}}
{{--                                <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>--}}
{{--                                    {{ $product->name }}--}}
{{--                                </option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-3">--}}
{{--                        <select name="employee_id" class="summary-input text-end flex-grow-1 w-100 w-md-auto">--}}
{{--                            <option value="">كل الموظفين</option>--}}
{{--                            @foreach($employees as $emp)--}}
{{--                                <option value="{{ $emp->id }}" {{ request('employee_id') == $emp->id ? 'selected' : '' }}>--}}
{{--                                    {{ $emp->name }}--}}
{{--                                </option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-2">--}}
{{--                        <input type="date" name="date_from" class="summary-input text-end flex-grow-1 w-100 w-md-auto" value="{{ request('date_from') }}">--}}
{{--                    </div>--}}

{{--                    <div class="col-md-2">--}}
{{--                        <input type="date" name="date_to" class="summary-input text-end flex-grow-1 w-100 w-md-auto" value="{{ request('date_to') }}">--}}
{{--                    </div>--}}

{{--                    <div class="col-4 col-md-1 text-center mb-2 mb-md-0">--}}
{{--                        <!-- زر لفتح المودال -->--}}
{{--                        <button type="button" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#filterModal">--}}
{{--                            <i class="fa fa-filter"></i> فلترة--}}
{{--                        </button>--}}
{{--                    </div>>--}}
{{--                </form>--}}
                    <table class="table table-hover align-middle text-center table-striped custom-invoice-table" style="min-width: 900px;">
                    <thead class="table-light">
                    <tr>
                        <th>المنتج</th>
                        <th>الكمية الحالية</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stock as $item)
                        <tr>
                            <td>
                                {{ $item->productVariant->product->name ?? '-' }}
                                - {{ $item->productVariant->size ?? '' }}
                                {{ $item->productVariant->color ? ' / ' . $item->productVariant->color : '' }}
                            </td>
                            <td>{{ $item->current_stock }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ route('inventory-logs.index') }}" class="btn btn-blue mb-3"> عودة لسجل المخزون</a>
                <a href="#" onclick="window.print()" class="btn btn-outline-blue mb-3">
                     طباعة التقرير
                </a>

            </div>
        </div>
    </div>
    <!-- مودال الفلترة -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 bg-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">فلترة متقدمة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <form method="GET" action="{{ url()->current() }}">
                    <div class="modal-body">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-bold">المنتج</label>
                                <select name="product_id" class="form-select">
                                    <option value="">كل المنتجات</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">الموظف</label>
                                <select name="employee_id" class="form-select">
                                    <option value="">كل الموظفين</option>
                                    @foreach($employees as $emp)
                                        <option value="{{ $emp->id }}" {{ request('employee_id') == $emp->id ? 'selected' : '' }}>
                                            {{ $emp->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">من تاريخ</label>
                                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">إلى تاريخ</label>
                                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between ">
                        <a href="{{ url()->current() }}" class="btn btn-outline-blue">
                            <i class="fa fa-undo"></i> إعادة تعيين
                        </a>
                        <button type="submit" class="btn btn-blue">
                            <i class="fa fa-search"></i> تطبيق الفلتر
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{--@endsection--}}
