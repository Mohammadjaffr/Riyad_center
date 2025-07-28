@extends('layouts.master')
@section('title', 'سجل المخزون')
@section('content')
    @if(session('success') || session('error'))
        <div class="message-center" style="position: fixed;left: 50%;transform: translate(-50%, -50%);z-index: 9999;padding: 20px;border-radius: 8px;text-align: center;animation: fadeInOut 4s forwards;
        {{ session('success') ? 'background: #4CAF50; color: white;' : 'background: #F44336; color: white;' }}">
            {{ session('success') ?? session('error') }}
        </div>
    @endif

    <style>
        @keyframes fadeInOut {
            0% { opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; visibility: hidden; }
        }
    </style>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">سجل المخزون</h2>
            @can('اضافه مخزون')
            <a href="{{ route('inventory-logs.create') }}" class="btn btn-blue mb-2 mb-md-0">
                <i class="fa fa-plus"></i> إضافة تعديل يدوي
            </a>
            @endcan
        </div>



        <div class="bg-white rounded-4 p-3 shadow-sm mb-3">

            <div class="d-flex gap-2 mb-3 flex-wrap ">
                <div class="col-12 col-md-4 text-end mb-3 mb-md-0"></div>
                @can('عرض الجرد الحالي')
                <a href="{{ route('inventory-logs.report', ['type' => 'current']) }}" class="btn btn-outline-blue">📦 الجرد الحالي</a>
                @endcan
                @can('عرض الجرد الشهري')
                <a href="{{ route('inventory-logs.report', ['type' => 'monthly']) }}" class="btn btn-outline-blue">📅 الجرد الشهري</a>
                @endcan
                @can('عرض الجرد السنوي')
                <a href="{{ route('inventory-logs.report', ['type' => 'yearly']) }}" class="btn btn-outline-blue">🗓 الجرد السنوي</a>
                @endcan
            </div>

{{--            <div class="row g-2 align-items-center mb-3">--}}
{{--                <form method="GET" action="{{ route('inventory-logs.index') }}" class="col-md-6 col-lg-4 mb-3 mt-4">--}}
{{--                    <div class="input-group" style="position: relative;">--}}
{{--                        <input--}}
{{--                            type="text"--}}
{{--                            name="search"--}}
{{--                            class="form-control summary-input w-100"--}}
{{--                            placeholder="ابحث باسم المنتج أو الموظف..."--}}
{{--                            value="{{ request('search') }}"--}}
{{--                            style="text-align: right; height: 43px; padding-right: 40px;"--}}
{{--                        >--}}
{{--                        <button--}}
{{--                            class="search-btn "--}}
{{--                            type="submit"--}}
{{--                            style="position: absolute; left:15px; top: 50%; transform: translateY(-50%); background: none; border: none; z-index: 5;"--}}
{{--                        >--}}
{{--                            <i class="fa fa-search" style="color: #fff;"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}

{{--                    <div class="input-group">--}}
{{--                        <input--}}
{{--                            type="text"--}}
{{--                            name="search"--}}
{{--                            class="form-control summary-input"--}}
{{--                            placeholder="ابحث باسم المنتج أو الموظف..."--}}
{{--                            value="{{ request('search') }}"--}}
{{--                            style="text-align: right;height: 43px!important;"--}}
{{--                        >--}}
{{--                        <button class=" search-btn my-1"  type="submit">--}}
{{--                            <i class="fa fa-search"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--                <div class="d-none d-lg-flex col-lg-6"></div>--}}
{{--                <div class="col-12 col-md-6 col-lg-2 mb-3 mb-md-0 d-flex justify-content-center align-items-center">--}}
{{--                    <!-- زر لفتح المودال -->--}}
{{--                    <button type="button" class="btn btn-blue w-100 w-md-auto filter-btn" data-bs-toggle="modal" data-bs-target="#filterModal">--}}
{{--                        <i class="fa fa-filter"></i> فلترة--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}

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
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 bg-white">
                <div class="modal-header">
                    <h5 class="modal-title text-dark-blue" id="filterModalLabel">فلترة سجل الجرد</h5>
                </div>

                <form method="GET" action="{{ route('inventory-logs.index') }}">
                    <div class="modal-body">
                        <div class="row g-3 text-dark-blue">
                            <!-- حقل البحث -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">بحث باسم المنتج أو الموظف</label>
                                <input
                                    type="text"
                                    name="search"
                                    class="summary-input w-100"
                                    value="{{ request('search') }}"
                                    placeholder="مثال: قميص، خالد"
                                    autocomplete="off"
                                />
                            </div>

                            <!-- نوع الحركة -->
                            <div class="col-md-3">
                                <label class="form-label fw-bold">نوع الحركة</label>
                                <select name="type" class="summary-input w-100 text-dark-blue">
                                    <option value="" disabled {{ !request('type') ? 'selected' : '' }}>اختر</option>
                                    <option value="purchase" {{ request('type') == 'purchase' ? 'selected' : '' }}>شراء</option>
                                    <option value="sale" {{ request('type') == 'sale' ? 'selected' : '' }}>بيع</option>
                                    <option value="adjustment" {{ request('type') == 'adjustment' ? 'selected' : '' }}>تعديل</option>
                                    <option value="return" {{ request('type') == 'return' ? 'selected' : '' }}>مرتجع</option>
                                </select>
                            </div>

                            <!-- الترتيب -->
                            <div class="col-md-3">
                                <label class="form-label fw-bold">الترتيب حسب التاريخ</label>
                                <select name="sort" class="summary-input w-100 text-dark-blue">
                                    <option value="" disabled {{ !request('sort') ? 'selected' : '' }}>اختر</option>
                                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>الأقدم أولاً</option>
                                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>الأحدث أولاً</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <a href="{{ route('inventory-logs.index') }}" class="btn btn-outline-blue">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
