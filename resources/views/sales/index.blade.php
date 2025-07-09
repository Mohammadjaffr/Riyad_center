@extends('layouts.master')
@section('title' ,' المبيعات')
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
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">قائمة المشتريات</h2>
            @can('اضافه مبيعات')
            <a href="{{ route('sales.create') }}" class="btn btn-blue mb-2 mb-md-0">
                <i class="fa fa-plus"></i>إضافة عملية بيع
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
                <form method="GET" action="{{ route('sales.index') }}" class="col-md-6 col-lg-4 mb-3 mt-4">
                    <div class="input-group">
                        <input
                            type="text"
                            name="search"
                            class="form-control summary-input"
                            placeholder="ابحث برقم الفاتورة أو اسم الموظف..."
                            value="{{ request('search') }}"
                            style="text-align: right;height: 43px!important;"
                        >
                        <button class=" search-btn my-1"  type="submit">
                            <i class="fa fa-search"></i>
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
            <div class="table-responsive ">
                <table class="table table-hover align-middle text-center table-striped custom-invoice-table" style="min-width: 900px;">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>الزبون</th>
                        <th>القسم</th>
                        <th>المبلغ</th>
                        <th>الموظف</th>
                        <th>ملاحظات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($sales as $sale)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sale->customer_name ?? '-' }}</td>
                            <td>{{ $sale->department->name ?? '-' }}</td>
                            <td>{{ number_format($sale->total_amount, 2) }}</td>
                            <td>{{ $sale->employee->name ?? '-' }}</td>
                            <td>{{ $sale->notes ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">لا توجد مبيعات حتى الآن</td>
                        </tr>
                    @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 bg-white">
                <div class="modal-header">
                    <h5 class="modal-title text-dark-blue" id="filterModalLabel">فلترة المبيعات</h5>
                </div>

                <form method="GET" action="{{ route('sales.index') }}">
                    <div class="modal-body">
                        <div class="row g-3 text-dark-blue">
                            <!-- حقل البحث -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">بحث برقم الفاتورة أو اسم الموظف</label>
                                <input
                                    type="text"
                                    name="search"
                                    class="summary-input w-100"
                                    value="{{ request('search') }}"
                                    placeholder="مثال: فاتورة 245، أحمد"
                                    autocomplete="off"
                                />
                            </div>

                            <!-- الترتيب حسب التاريخ -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">الترتيب حسب التاريخ</label>
                                <select name="sort" class="summary-input w-100 text-dark-blue">
                                    <option value="" disabled {{ !request('sort') ? 'selected' : '' }}>اختر</option>
                                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>من الأقدم إلى الأحدث</option>
                                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>من الأحدث إلى الأقدم</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <a href="{{ route('sales.index') }}" class="btn btn-outline-blue">
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

@endsection
