@extends('layouts.master')
@section('title', 'سجل مرتجعات البيع')
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
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">سجل مرتجعات البيع</h2>
            @can('إضافة مرتجع البيع')
            <a href="{{ route('sales-returns.create') }}" class="btn btn-blue mb-2 mb-md-0">
                <i class="fa fa-plus"></i>إضافة راجع البيع
            </a>
            @endcan
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-4 p-3 shadow-sm mb-3">
            <div class="row g-2 align-items-center mb-3">
                <div class="row g-2 align-items-center mb-3">
                    <form method="GET" action="" class="col-md-6 col-lg-4 mb-3 mt-4">
                        <div class="input-group" style="position: relative;">
                            <input
                                type="text"
                                name="search"
                                class="form-control summary-input w-100"
                                placeholder="ابحث باسم المنتج..."
                                value="{{ request('search') }}"
                                style="text-align: right; height: 43px; padding-right: 40px;"
                            >
                            <button
                                class="search-btn "
                                type="submit"
                                style="position: absolute; left:15px; top: 50%; transform: translateY(-50%); background: none; border: none; z-index: 5;"
                            >
                                <i class="fa fa-search" style="color: #fff;"></i>
                            </button>
                        </div>
                    </form>
                    <div class="d-none d-lg-flex col-lg-6"></div>
                    <div class="col-12 col-md-6 col-lg-2 mb-3 mb-md-0 d-flex justify-content-center align-items-center">
                        <!-- زر لفتح المودال -->
                        <button type="button" class="btn btn-blue w-100 w-md-auto filter-btn" data-bs-toggle="modal" data-bs-target="#filterModal">
                            <i class="fa fa-filter"></i> فلترة
                        </button>
                    </div>
                </div>

        </div>
            <div class="table-responsive ">
                <table class="table table-hover align-middle text-center table-striped custom-invoice-table" style="min-width: 900px;">
                    <thead class="table-light">
                    <tr>
                        <th>المنتج</th>
                        <th>الكمية المرجعة</th>
                        <th>السبب</th>
                        <th>تم بواسطة</th>
                        <th>التاريخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>
                                {{ $log->productVariant->product->name ?? '-' }}
                                {{ $log->productVariant->size ? ' - ' . $log->productVariant->size : '' }}
                                {{ $log->productVariant->color ? ' / ' . $log->productVariant->color : '' }}
                            </td>
                            <td>{{ $log->quantity }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->employee->name ?? '-' }}</td>
                            <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">لا توجد مرتجعات حتى الآن</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $logs->links() }}
            </div>
        </div>
    </div>
{{--mohammed's code --}}
{{--    <div class="container py-4">--}}
{{--        <h3 class="mb-4">سجل مرتجعات البيع</h3>--}}

{{--        @if(session('success'))--}}
{{--            <div class="alert alert-success">{{ session('success') }}</div>--}}
{{--        @endif--}}

{{--        <div class="table-responsive bg-white rounded-4 shadow p-3">--}}
{{--            <table class="table table-bordered text-center">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>المنتج</th>--}}
{{--                    <th>الكمية المرجعة</th>--}}
{{--                    <th>السبب</th>--}}
{{--                    <th>تم بواسطة</th>--}}
{{--                    <th>التاريخ</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @forelse($logs as $log)--}}
{{--                    <tr>--}}
{{--                        <td>--}}
{{--                            {{ $log->productVariant->product->name ?? '-' }}--}}
{{--                            {{ $log->productVariant->size ? ' - ' . $log->productVariant->size : '' }}--}}
{{--                            {{ $log->productVariant->color ? ' / ' . $log->productVariant->color : '' }}--}}
{{--                        </td>--}}
{{--                        <td>{{ $log->quantity }}</td>--}}
{{--                        <td>{{ $log->description }}</td>--}}
{{--                        <td>{{ $log->employee->name ?? '-' }}</td>--}}
{{--                        <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>--}}
{{--                    </tr>--}}
{{--                @empty--}}
{{--                    <tr>--}}
{{--                        <td colspan="5">لا توجد مرتجعات حتى الآن</td>--}}
{{--                    </tr>--}}
{{--                @endforelse--}}
{{--                </tbody>--}}
{{--            </table>--}}

{{--            {{ $logs->links() }}--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- فلترة -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content rounded-4 bg-white">
                <div class="modal-header">
                    <h5 class="modal-title text-dark-blue" id="filterModalLabel">فلترة المنتجات</h5>
                </div>
                <form method="GET" action="{{ route('sales-returns.index') }}">
                    <div class="modal-body ">
                        <div class="row g-3 text-dark-blue">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">بحث باسم المنتج</label>
                                <input
                                    type="text"
                                    id="search"
                                    name="search"
                                    class="summary-input flex-grow-1 w-100 w-md-auto"
                                    value="{{ request('search') }}"
                                    placeholder="مثال: تيشيرت"
                                    autocomplete="off"
                                />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">الترتيب</label>
                                <select name="sort" class="summary-input flex-grow-1 w-100 w-md-auto text-dark-blue">
                                    <option value="" disabled selected>اختر</option>
                                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>تصاعدي</option>
                                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>تنازلي</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-blue">إعادة تعيين</a>
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
